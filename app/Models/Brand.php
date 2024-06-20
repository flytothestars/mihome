<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Laravel\Scout\EngineManager;
use Laravel\Scout\Engines\Engine;
use Laravel\Scout\Searchable;
use TCG\Voyager\Traits\Translatable;

class Brand extends Model
{
    use HasFactory, Searchable, Translatable;

    protected $translatable = ['name', 'decsription'];

    protected $perPage = 100;

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'brands_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {

        $categories = [];

        foreach ($this->products()->get() as $product) {
            if ($product->category) {
                $product->category->parent_id || array_filter($categories, fn ($val) => $val['slug'] === $product->category->slug) || $categories[] = [
                    'order' => $product->category->order,
                    'name' => $product->category->name,
                    'slug' => $product->category->slug,
                ];
                foreach ($product->category->descendants as $descendant)
                    $descendant->parent_id || array_filter($categories, fn ($val) => $val['slug'] === $descendant->slug) || $categories[] = [
                        'order' => $descendant->order,
                        'name' => $descendant->name,
                        'slug' => $descendant->slug,
                    ];
            }
        }

        usort($categories, fn ($a, $b) => $a['order'] - $b['order']);

        $array = [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'url' => (string) $this->url,
            'categories' => $categories,
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                return route(App::getLocale() . '.manufacturers.show', [
                    'manufacturer' => $this->slug
                ]);
            }
        );
    }


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
