<?php

namespace App\Observers;

use App\Models\FooterAdv;
use Illuminate\Support\Facades\Cache;

class FooterAdvObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function updating(FooterAdv $model): void
    {
        Cache::forget('kz.footerAdvs');
        Cache::forget('ru.footerAdvs');
    }
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function creating(FooterAdv $model): void
    {
        Cache::forget('kz.footerAdvs');
        Cache::forget('ru.footerAdvs');
    }
}
