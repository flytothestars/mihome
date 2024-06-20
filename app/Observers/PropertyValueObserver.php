<?php

namespace App\Observers;

use App\Models\PropertyValue;

class PropertyValueObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function creating(PropertyValue $value): void
    {
        $value->slug = \Illuminate\Support\Str::slug($value->title);
        while (PropertyValue::where('slug', $value->slug)->exists()) $value->slug .= "_";
    }
}
