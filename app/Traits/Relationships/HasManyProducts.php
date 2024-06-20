<?php

/*
|--------------------------------------------------------------------------
| HasManyProducts Trait
|--------------------------------------------------------------------------
|
*/

namespace App\Traits\Relationships;

trait HasManyProducts
{
    /**
     * Method to establish a relationship with products.
     *
     * @return HasMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        $model = config('voyager-shop.models.product');
        $foreign_key = config('voyager-shop.foreign_key.product');
        return $this->hasMany($model, $foreign_key);
    }
}
