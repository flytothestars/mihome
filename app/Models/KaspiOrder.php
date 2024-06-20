<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KaspiOrder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'offer_id'];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
