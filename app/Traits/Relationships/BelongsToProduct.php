<?php

/*
|--------------------------------------------------------------------------
| BelongsToProduct Trait
|--------------------------------------------------------------------------
|
*/

namespace App\Traits\Relationships;

trait BelongsToProduct
{
    /**
     * Relationship with product model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        $model = config('voyager-shop.models.product');
        $product_id = config('voyager-shop.foreign_keys.product');

        return $this->belongsTo($model, $product_id);
    }
}
