<?php

/*
|--------------------------------------------------------------------------
| BelongsToOffer Trait
|--------------------------------------------------------------------------
|
| Trait to add to models that should have a relationship with offer model.
|
*/

namespace App\Traits\Relationships;

trait BelongsToOffer
{
    /**
     * Relationship with product variant model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        $model = config('voyager-shop.models.offer');
        $offer_id = config('voyager-shop.foreign_keys.offer');

        return $this->belongsTo($model, $offer_id);
    }
}
