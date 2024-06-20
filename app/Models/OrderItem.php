<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetRelationshipKey;
use App\Traits\Relationships\BelongsToOrder;
use App\Traits\Relationships\BelongsToOffer;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderItem extends Model
{
    use GetRelationshipKey, BelongsToOrder, BelongsToOffer;

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | Accessors and Mutators
    |--------------------------------------------------------------------------
    |
    | In this section you will find the accessors and mutators of this model.
    |
    */

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (int)$value / 100,
            set: fn ($value) => (float)$value * 100,
        );
    }
}
