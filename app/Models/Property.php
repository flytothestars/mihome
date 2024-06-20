<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use TCG\Voyager\Traits\Translatable;

class Property extends Model
{
    use HasFactory, Translatable;

    protected $guarded = [];

    protected $translatable = ['title'];

    protected $perPage = 100;

    /**
     * Relationship with offers model.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(PropertyValue::class);
    }
}
