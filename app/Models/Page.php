<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Facades\Voyager;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Traits\Translatable;

class Page extends Model
{
    use HasFactory, Translatable;

    protected $translatable = ['name', 'introtext', 'fulltext', 'metakey', 'metadesc'];

    protected $perPage = 100;

    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                return "/informaciya/" . $this->alias;
            }
        );
    }

    public function webp(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($images = json_decode($this->images)) {
                    return array_map(function ($image) {
                        if ($image && is_file(Storage::path($image))) {
                            $pathLarge = 'resized/lg/' . dirname($image) . '/' . basename($image) . '.webp';
                            if (!is_file(Storage::path($pathLarge))) {
                                $webp = Image::make(Storage::path($image))->encode('webp');
                                Storage::put($pathLarge, $webp);
                            }

                            $pathSmall = 'resized/sm/' . dirname($image) . '/' . basename($image) . '.webp';
                            if (!is_file(Storage::path($pathSmall))) {
                                $webp = Image::make(Storage::path($image))->fit(256, 256, function ($constraint) {
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
}
