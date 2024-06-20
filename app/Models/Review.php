<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'advantages', 'disadvantages', 'text', 'rate', 'user_id'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'entity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
