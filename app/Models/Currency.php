<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetRelationshipKey;

class Currency extends Model
{
    use GetRelationshipKey;

    protected $guarded = ['id'];
}
