<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Scout\EngineManager;
use Laravel\Scout\Engines\Engine;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;
use Laravel\Scout\Searchable;
use Meilisearch\Endpoints\Indexes;

class Category extends Model
{
    use HasFactory, NodeTrait, Translatable, Searchable {
        Searchable::usesSoftDelete insteadof \Kalnoy\Nestedset\NodeTrait;
    }

    protected $guarded = [];

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'categories_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        $filters = [];
        $min = 10000000;
        $max = 0;

        $brands = [];

        foreach ($this->products()->with('propertyValues')->get() as $product) {
            foreach ($product->propertyValues as $value) {
                if (!isset($filters[$value->property->slug])) $filters[$value->property->slug] = [];
                if (empty(array_filter($filters[$value->property->slug], function ($el) use ($value) {
                    return $el['value'] === $value->slug;
                })))
                    $filters[$value->property->slug][] = [
                        'value' => $value->slug,
                        'label' => $value->title
                    ];
            }
            foreach ($product->offers as $offer) {
                if ($offer->new_price) {
                    $max = $max > $offer->new_price ? $max : $offer->new_price;
                    $min = $min < $offer->new_price ? $min : $offer->new_price;
                } elseif ($offer->price) {
                    $max = $max > $offer->price ? $max : $offer->price;
                    $min = $min < $offer->price ? $min : $offer->price;
                }
            }
            $product->brand && $brands[] = $product->brand->slug;
        }

        foreach ($this->descendants as $descendant) {
            foreach ($descendant->products()->with('propertyValues')->get() as $product) {
                foreach ($product->propertyValues as $value) {
                    if (!isset($filters[$value->property->slug])) $filters[$value->property->slug] = [];
                    if (empty(array_filter($filters[$value->property->slug], function ($el) use ($value) {
                        return $el['value'] === $value->slug;
                    })))
                        $filters[$value->property->slug][] = [
                            'value' => $value->slug,
                            'label' => $value->title
                        ];
                }
            }
            foreach ($product->offers as $offer) {
                if ($offer->new_price) {
                    $max = $max > $offer->new_price ? $max : $offer->new_price;
                    $min = $min < $offer->new_price ? $min : $offer->new_price;
                } elseif ($offer->price) {
                    $max = $max > $offer->price ? $max : $offer->price;
                    $min = $min < $offer->price ? $min : $offer->price;
                }
            }
            $product->brand && $brands[] = $product->brand->slug;
        }


        $array = [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'url' => (string) $this->url,
            'filters' =>  $filters,
            'brands' =>  array_unique($brands),
            'min' =>  $min,
            'max' =>  $max,
        ];
        return $array;
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
        return true;
    }

    protected $translatable = ['name', 'description', 'meta_title', 'meta_desc'];

    protected $perPage = 100;

    /**
     * Scope a query to only include popular users.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                $url = [$this->slug];
                foreach ($this->ancestors as $ancestor) $url[] = $ancestor->slug;
                return route(App::getLocale() . '.category', [
                    'path' => implode('/', array_reverse($url))
                ]);
            }
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function filters(): Attribute
    {
        return Attribute::make(
            get: function () {
                $category = $this;
                $categoryScout = Category::search(
                    '',
                    function (Indexes $meiliSearch, string $query, array $options) use ($category) {
                        $options['filter'][] = 'id = ' . $category->id;
                        $options['filter'] = implode(' AND ', $options['filter']);
                        return $meiliSearch->search($query, $options);
                    }
                );
                if ($raw = $categoryScout->raw()) if (!empty($raw['hits'])) return $raw['hits'][0]['filters'];
                return [];
            }
        );
    }

    public function max(): Attribute
    {
        return Attribute::make(
            get: function () {
                $category = $this;
                $categoryScout = Category::search(
                    '',
                    function (Indexes $meiliSearch, string $query, array $options) use ($category) {
                        $options['filter'][] = 'id = ' . $category->id;
                        $options['filter'] = implode(' AND ', $options['filter']);
                        return $meiliSearch->search($query, $options);
                    }
                );
                if ($raw = $categoryScout->raw()) if (!empty($raw['hits'])) return $raw['hits'][0]['max'];
                return [];
            }
        );
    }

    public function min(): Attribute
    {
        return Attribute::make(
            get: function () {
                $category = $this;
                $categoryScout = Category::search(
                    '',
                    function (Indexes $meiliSearch, string $query, array $options) use ($category) {
                        $options['filter'][] = 'id = ' . $category->id;
                        $options['filter'] = implode(' AND ', $options['filter']);
                        return $meiliSearch->search($query, $options);
                    }
                );
                if ($raw = $categoryScout->raw()) if (!empty($raw['hits'])) return $raw['hits'][0]['min'];
                return [];
            }
        );
    }

    public function webp(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->image && is_file(Storage::path($this->image))) {
                    $pathLarge = 'resized/lg/' . dirname($this->image) . '/' . basename($this->image) . '.webp';
                    if (!is_file(Storage::path($pathLarge))) {
                        $webp = Image::make(Storage::path($this->image))->fit(366, 366, function ($constraint) {
                            $constraint->upsize();
                        })->encode('webp');
                        Storage::put($pathLarge, $webp);
                    }

                    $pathTall = 'resized/tall/' . dirname($this->image) . '/' . basename($this->image) . '.webp';
                    if (!is_file(Storage::path($pathTall))) {
                        $webp = Image::make(Storage::path($this->image))->fit(107, 144, function ($constraint) {
                            $constraint->upsize();
                        })->encode('webp');
                        Storage::put($pathTall, $webp);
                    }

                    $pathSmall = 'resized/sm/' . dirname($this->image) . '/' . basename($this->image) . '.webp';
                    if (!is_file(Storage::path($pathSmall))) {
                        $webp = Image::make(Storage::path($this->image))->fit(256, 256, function ($constraint) {
                            $constraint->upsize();
                        })->encode('webp');
                        Storage::put($pathSmall, $webp);
                    }
                    return [Storage::url($pathLarge), Voyager::image($pathSmall), Voyager::image($pathTall)];
                } else return null;
            }
        );
    }


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
