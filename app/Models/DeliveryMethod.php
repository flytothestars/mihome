<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DeliveryMethod extends Model
{
    use HasFactory;

    public function paymentMethods(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'payment_delivery');
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'delivery_method_city');
    }
}
