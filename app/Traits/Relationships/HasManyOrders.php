<?php

/*
|--------------------------------------------------------------------------
| HasOrders Trait
|--------------------------------------------------------------------------
|
*/

namespace App\Traits\Relationships;

trait HasManyOrders
{
    /**
     * Method to establish a relationship with orders.
     *
     * @return HasMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        $key = $this->getRelationshipKey();

        $model = config('voyager-shop.models.order');
        $foreign_key = config('voyager-shop.foreign_key.'.$key);
        
        return $this->hasMany($model, $foreign_key);
    }
}
