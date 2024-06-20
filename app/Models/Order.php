<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetRelationshipKey;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use GetRelationshipKey;

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | Accessors and Mutators
    |--------------------------------------------------------------------------
    |
    | In this section you will find all accessors and mutators of this model.
    |
    */

    /**
     * Get the price of the order as float.
     *
     * @return float
     */

    /**
     * Relationship with user model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with user model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Relationship with user model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Relationship with user model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliveryMethod(): BelongsTo
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

    /**
     * Relationship with user model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function sum(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (int)$value / 100,
            set: fn ($value) => (float)$value * 100,
        );
    }

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->sum
        );
    }

    public function totalText(): Attribute
    {
        return Attribute::make(
            get: function () {
                return number_format($this->total, 0, '.', ' ') . ' ₸';
            }
        );
    }
}
