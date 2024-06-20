<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetRelationshipKey;
use App\Traits\Relationships\HasManyOffers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\EngineManager;
use Laravel\Scout\Engines\Engine;
use TCG\Voyager\Traits\Translatable;
use Laravel\Scout\Searchable;
use Meilisearch\Endpoints\Indexes;
use TCG\Voyager\Facades\Voyager;

class Product extends Model
{
    use GetRelationshipKey,
        HasManyOffers,
        Translatable,
        Searchable,
        SoftDeletes;

    /**
     * Default sort by created_at desc.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('with', function (Builder $builder) {
            $builder->with('images');
            $builder->orderByDesc('in_stock');
        });
    }
    /**
     * Scope a query to only include active users.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published', 1);
    }

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'products_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        $images = [];
        foreach ($this->images as $image) {
            $images[] = str_replace(config('app.url'), "", Voyager::image($image->link));
        }

        $categories = [];
        if ($this->category) {
            $categories = [$this->category->id];
            foreach ($this->category->ancestors as $c) $categories[]  = $c->id;
        }

        $filters = [];
        foreach ($this->propertyValues as $value) $filters[] =  $value->property->slug . '=' . $value->slug;

        $minprice = null;
        $maxprice = null;
        $discount = 0;
        $articles = [];
        foreach ($this->offers as $offer) {
            $ofdesc = floor($offer->old_price ? ($offer->old_price - $offer->price) * 100 / $offer->old_price : 0);
            $discount = $ofdesc > $discount ? $ofdesc : $discount;
            $articles[] = $offer->article;
            if ($offer->price) {
                $minprice = $minprice === null || $offer->price < $minprice ? $offer->price : $minprice;
                $maxprice = $maxprice === null || $offer->price > $maxprice ? $offer->price : $maxprice;
            }
        }

        $array = [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'description' => (string) $this->description,
            'kaspi' => $this->kaspi,
            'discount' => $discount,
            'in_stock' => $this->in_stock,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'price_formatted' => $this->price_formatted,
            'old_price_formatted' => $this->old_price_formatted,
            'pre_order' => $this->pre_order,
            'rating' => $this->rating,
            'ratingcount' => $this->ratingcount,
            'image' => $this->image,
            'name' => $this->name,
            'brand' => $this->brand ? (string) $this->brand->slug : null,
            'articles' => $articles,
            'categories' => $categories,
            'minprice' => $minprice,
            'maxprice' => $maxprice,
            'url' => (string) str_replace(config('app.url'), "", $this->url),
            'images' => $images,
            'filters' => $filters,
        ];
        return $array;
    }

    /**
     * Get the engine used to index the model.
     */
    public static function getMinPrice(): float
    {
        $minprice = 0;
        $pr = self::search(
            '',
            function (Indexes $meiliSearch, string $query, array $options) {
                $options['limit'] = 1;
                $options['sort'] = ['minprice:asc'];
                return $meiliSearch->search($query, $options);
            }
        )->raw();
        if (isset($pr['hits'][0]['minprice'])) $minprice = (float)$pr['hits'][0]['minprice'];
        return $minprice;
    }

    /**
     * Get the engine used to index the model.
     */
    public function discount(): Attribute
    {
        return Attribute::make(
            get: function () {
                $discount = 0;
                $id = $this->id;
                $pr = self::search(
                    '',
                    function (Indexes $meiliSearch, string $query, array $options) use ($id) {
                        $options['filter'] = 'id=' . $id;
                        return $meiliSearch->search($query, $options);
                    }
                )->raw();
                if (isset($pr['hits'][0]['discount'])) $discount = (float)$pr['hits'][0]['discount'];
                return $discount;
            }
        );
    }

    /**
     * Get the engine used to index the model.
     */
    public static function getMaxPrice(): float
    {
        $maxprice = 0;
        $pr = self::search(
            '',
            function (Indexes $meiliSearch, string $query, array $options) {
                $options['limit'] = 1;
                $options['sort'] = ['maxprice:desc'];
                return $meiliSearch->search($query, $options);
            }
        )->raw();
        if (isset($pr['hits'][0]['maxprice'])) $maxprice = (float)$pr['hits'][0]['maxprice'];
        return $maxprice;
    }

    /**
     * Get the engine used to index the model.
     */
    public function searchableUsing(): Engine
    {
        return app(EngineManager::class)->engine('meilisearch');
    }

    /**
     * Get the engine used to index the model.
     */
    public function shouldBeSearchable(): bool
    {
        return !!$this->published && !$this->deleted_at;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];

    protected $with = ['offers'];

    protected $translatable = ['name', 'decsription'];

    /*
    |--------------------------------------------------------------------------
    | Accessors and Mutators
    |--------------------------------------------------------------------------
    |
    | In this section you will find the accessors and mutators of this model.
    | Feel free to overwrite them as needed.
    |
    */


    /**
     * Scope a query to only include popular users.
     */
    public function scopePopular(Builder $query): void
    {
        $query->where('popular', false)->orderByDesc('viewed');
    }


    /**
     * Scope a query to only include popular users.
     */
    public function scopeLatest(Builder $query): void
    {
        $query->orderByDesc('created_at');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                return route(App::getLocale() . '.product', [
                    'product' => $this->slug
                ]);
            }
        );
    }

    public function priceFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->price, 0, '.', ' ') . ' ₸'
        );
    }

    public function oldPriceFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->old_price, 0, '.', ' ') . ' ₸'
        );
    }

    public function preOrder(): Attribute
    {
        return Attribute::make(
            get: function () {
                $offer = $this->offers()->where('pre_order', '>', 0)->orderBy('pre_order', 'desc')->first();
                return $offer ? $offer->pre_order : 0;
            }
        );
    }

    public function kaspi(): Attribute
    {
        return Attribute::make(
            get: function () {
                $offer = $this->offers()->where('kaspi', '>', 0)->orderBy('kaspi', 'desc')->first();
                return $offer ? $offer->kaspi : 0;
            }
        );
    }

    public function discountText(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->in_stock) return '';
                if ($this->discontinued)
                    return '<svg viewBox="0 0 20 20" class="w-3 lg:w-5 h-3 lg:h-5 inline"><polyline fill="none" stroke="currentColor" stroke-width="1.03" points="7 4 13 10 7 16"></polyline></svg><strong uk-tooltip="' . number_format($this->price * 0.05, 0, ',', ' ') . ' ₸"></span>' . setting('shop.discount') . '%</strong> - Ваша дополни<wbr>тельная<span class="whitespace-nowrap">скидка <svg class="inline cursor-pointer w-4 h-4 text-green-500 hover:text-green-800" onclick="Livewire.dispatch(\'openModal\', { component: \'modals.delivery\' })" width="16" height="16" viewBox="0 0 20 20"><path d="M12.13,11.59 C11.97,12.84 10.35,14.12 9.1,14.16 C6.17,14.2 9.89,9.46 8.74,8.37 C9.3,8.16 10.62,7.83 10.62,8.81 C10.62,9.63 10.12,10.55 9.88,11.32 C8.66,15.16 12.13,11.15 12.14,11.18 C12.16,11.21 12.16,11.35 12.13,11.59 C12.08,11.95 12.16,11.35 12.13,11.59 L12.13,11.59 Z M11.56,5.67 C11.56,6.67 9.36,7.15 9.36,6.03 C9.36,5 11.56,4.54 11.56,5.67 L11.56,5.67 Z" fill="currentColor"></path><circle fill="none" stroke="currentColor" stroke-width="1.1" cx="10" cy="10" r="9"></circle></svg></span>';
                else
                    return '<div> <svg viewBox="0 0 20 20" class="w-3 lg:w-5 h-3 lg:h-5 inline"><polyline fill="none" stroke="currentColor" stroke-width="1.03" points="7 4 13 10 7 16"></polyline></svg><strong uk-tooltip="Только в магазине Mi Home"></span> Акция</strong> - Цена ниже чем в других магазинах</div>';
            }
        );
    }

    public function priceText(): Attribute
    {
        return Attribute::make(
            get: function () {
                $prices = [];
                foreach ($this->offers as $offer) if ($offer->price) $prices[] = $offer->price;
                if (empty($prices)) return "";
                if (min($prices) < max($prices)) {
                    echo '<strong class="block font-semibold text-green-300 -tracking-[0.5px] text-2xl whitespace-nowrap">' . number_format(min($prices), 0, '.', ' ') . ' - ' . number_format(max($prices), 0, '.', ' ') . ' ₸</strong>';
                } else {
                    echo '<strong class="block font-semibold text-green-300 -tracking-[0.5px] text-2xl whitespace-nowrap">' .  number_format(min($prices), 0, '.', ' ') . ' ₸</strong>';
                }
            }
        );
    }

    public function rating(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (int)$value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: function () {
                $minPrice = null;
                foreach ($this->offers as $offer) {
                    $minPrice = $minPrice === null ? $offer->price : min($offer->price, $minPrice);
                }
                return $minPrice;
            }
        );
    }

    public function oldPrice(): Attribute
    {
        return Attribute::make(
            get: function () {
                $minPrice = null;
                foreach ($this->offers as $offer) {
                    $minPrice = $minPrice === null ? $offer->oldPrice : min($offer->oldPrice, $minPrice);
                }
                return $minPrice;
            }
        );
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'entity');
    }

    public function textCartButton(): Attribute // Cart Button Text
    {
        return Attribute::make(
            get: function () {
                if ($this->offers()->where('kaspi', true)->exists()) {
                    return "<span>Купить со скидкой <strong>" . setting('shop.discount') . "%</strong></span>";
                } else {
                    return "<span>Купить по низкой цене</span>";
                }
            }
        );
    }

    public function webp(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($images = json_decode($this->images)) {
                    return array_map(function ($image) {
                        if ($image->link && is_file(Storage::path($image->link))) {
                            $pathLarge = 'resized/lg/' . dirname($image->link) . '/' . basename($image->link) . '.webp';
                            if (!is_file(Storage::path($pathLarge))) {
                                $webp = \Intervention\Image\Facades\Image::make(Storage::path($image->link))->encode('webp');
                                Storage::put($pathLarge, $webp);
                            }

                            $pathSmall = 'resized/sm/' . dirname($image->link) . '/' . basename($image->link) . '.webp';
                            if (!is_file(Storage::path($pathSmall))) {
                                $webp = \Intervention\Image\Facades\Image::make(Storage::path($image->link))->fit(256, 302, function ($constraint) {
                                    $constraint->upsize();
                                })->encode('webp');
                                Storage::put($pathSmall, $webp);
                            }
                            return [Storage::url($pathLarge), Voyager::image($pathSmall)];
                        }
                    }, $images);
                }
                return null;
            }
        );
    }


    public function propertyValues()
    {
        return $this->belongsToMany(PropertyValue::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function relatedCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'related_category', 'product_id', 'related_id');
    }

    public function relatedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'related_product', 'product_id', 'related_id');
    }

    public function categoryProducts()
    {
        return Product::where('category_id', $this->category_id);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
