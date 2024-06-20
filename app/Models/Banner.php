<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;

class Banner extends Model
{
    use HasFactory;

    /**
     * Default sort by created_at desc.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    public function webp(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($image = $this->image) {
                    if ($image && is_file(Storage::path($image))) {
                        $pathLarge = 'resized/lg/' . dirname($image) . '/' . basename($image) . '.webp';
                        if (!is_file(Storage::path($pathLarge))) {
                            $webp = Image::make(Storage::path($image))->encode('webp');
                            Storage::put($pathLarge, $webp);
                        }

                        $pathSmall = 'resized/sm/' . dirname($image) . '/' . basename($image) . '.webp';
                        if (!is_file(Storage::path($pathSmall))) {
                            $webp = Image::make(Storage::path($image))->fit(1280, null, function ($constraint) {
                                $constraint->upsize();
                            })->encode('webp');
                            Storage::put($pathSmall, $webp);
                        }
                        return [Storage::url($pathLarge), Voyager::image($pathSmall)];
                    }
                }
                return null;
            }
        );
    }
}
