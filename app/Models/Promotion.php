<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;
use Intervention\Image\Facades\Image;

class Promotion extends Model
{
    use HasFactory, Translatable;

    protected $translatable = ['title'];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(PromotionType::class);
    }

    /**
     * Scope a query to only include popular users.
     */
    public function scopeLatest(Builder $query): void
    {
        $query->orderByDesc('active_from')->orderByDesc('active_to')->orderByDesc('created_at');
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
}
