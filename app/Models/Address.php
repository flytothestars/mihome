<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\GetRelationshipKey;
use App\Traits\Relationships\BelongsToUser;

class Address extends Model
{
    use SoftDeletes, GetRelationshipKey, BelongsToUser;

    protected $guarded = ['id'];
}
