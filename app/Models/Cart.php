<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuser_id'
    ];

    public function sumText(): Attribute
    {
        return Attribute::make(
            get: function () {
                return number_format($this->sum, 0, '.', ' ');
            }
        );
    }

    public function sum(): Attribute
    {
        return Attribute::make(
            get: function () {
                $sum = 0;
                foreach ($this->items as $item) {
                    $sum += $item->offer->price * $item->quantity;
                }
                return $sum;
            }
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
