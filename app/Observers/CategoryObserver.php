<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function updating(Category $model): void
    {
        Cache::forget('kz.categories');
        Cache::forget('ru.categories');
    }
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function creating(Category $model): void
    {
        Cache::forget('kz.categories');
        Cache::forget('ru.categories');
    }
}
