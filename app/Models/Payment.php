<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetRelationshipKey;
use App\Traits\Relationships\BelongsToUser;
use App\Traits\Relationships\BelongsToOrder;
use App\Traits\Relationships\BelongsToCurrency;
use App\Traits\Relationships\BelongsToOffer;

class Payment extends Model
{
    use GetRelationshipKey,
        BelongsToUser,
        BelongsToOrder,
        BelongsToCurrency,
        BelongsToOffer;

    protected $guarded = ['id'];
}
