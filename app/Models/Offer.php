<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetRelationshipKey;
use App\Traits\Relationships\BelongsToProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;
use App\Models\Product;

class Offer extends Model
{
    use GetRelationshipKey, BelongsToProduct, Translatable, SoftDeletes;

    protected $guarded = [];

    protected $translatable = ['name', 'decsription'];

    protected $appends = ['webp'];

    /**
     * Default sort by created_at desc.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        // static::addGlobalScope('with', function (Builder $builder) {
        //     $builder->with('images');
        // });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors and Mutators
    |--------------------------------------------------------------------------
    |
    | In this section you will find the accessors and mutators of this model.
    |
    */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (int)$value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function oldPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (int)$value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!empty($this->webp)) return $this->webp[0][0];
                return "";
            }
        );
    }

    public function thumb(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!empty($this->webp)) return $this->webp[0][1];
                return "";
            }
        );
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'entity');
    }

    public function sname(): Attribute
    {
        return Attribute::make(
            get: function () {
                $title = str_replace(['#34;', '"', chr(38)], "", $this->product->name);
                $title = trim(str_replace($title, "", str_replace(['#34;', '"', chr(38)], "", $this->name)));
                return trim($title);
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

    public function textCartButton(): Attribute // Cart Button Text
    {
        return Attribute::make(
            get: function () {
                if ($this->kaspi) {
                    return "<span>Купить со скидкой <strong>" . setting('shop.discount') . "%</strong></span>";
                } else {
                    return "<span>Купить по низкой цене</span>";
                }
            }
        );
    }

    public function kaspiButton(): Attribute // Cart Button Text
    {
        return Attribute::make(
            get: function () {
                if (setting('shop.kaspi0024') && $this->kaspi) {
                    return '<a rel="nofollow" class="py-1 px-4 rounded transition bg-red-500 text-white hover:shadow-lg flex justify-center gap-2 items-center" href="' . $this->kaspi . '" target="_blank" style="text-decoration: none;"><div class="kaspi_button_logo"></div><span><strong>В рассрочку<br></strong>' . number_format($this->price / setting('shop.kaspi0024value'), 0, ' ', ' ') . ' x ' . setting('shop.kaspi0024value') . ' мес</span>
                  </a>';
                } else {
                    //     return '{modal iframe="iframe" width="430" rel="nofollow" class="uk-flex uk-flex-middle inheritcolork" url="/kredit?form[sku]=' . $this->product_sku . '&form[name]=' . JFilterOutput::stringURLSafe($this->product_name) . '&form[price]=' . $this->prices['salesPrice'] . '&form[bank]=Kaspi" style="text-decoration: none;"}
                    //   <div class="kaspi_button_logo"></div>
                    //   <span><strong>В рассрочку<br></strong>' . number_format($this->prices['salesPrice'] / setting('shop.kaspi0024value'), 0, ' ', ' ') . ' x ' . setting('shop.kaspi0024value') . ' мес</span>
                    //   {/modal}';
                    return '<button disabled="true" class="py-1 px-4 rounded transition bg-red-500 disabled:opacity-70 text-white hover:shadow-lg flex justify-center gap-2 items-center"><div class="kaspi_button_logo"></div><span><strong>В рассрочку<br></strong>' . number_format($this->price / setting('shop.kaspi0024value'), 0, ' ', ' ') . ' x ' . setting('shop.kaspi0024value') . ' мес</span></button>';
                }
            }
        );
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
}
