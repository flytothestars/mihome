<?php

/*
|--------------------------------------------------------------------------
| HasManyOffers Trait
|--------------------------------------------------------------------------
|
| Trait to add to models that should have a has many relationship with the
| product variants. Eg. the user model.
|
*/

namespace App\Traits\Relationships;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\GetRelationshipKey;

trait HasManyOffers
{
    use GetRelationshipKey;
    /**
     * Relationship with offers model.
     * @return HasMany
     */
    public function offers(): HasMany
    {
        $key = $this->getRelationshipKey();

        $model = config('voyager-shop.models.offer');
        $id = config('voyager-shop.foreign_keys.' . $key);

        return $this->hasMany($model, $id)->orderBy('price');
    }
}
