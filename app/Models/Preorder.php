<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preorder extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'offer_id'];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
