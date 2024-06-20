<?php

namespace App\Observers;

use App\Models\FooterInfo;
use Illuminate\Support\Facades\Cache;

class FooterInfoObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function updating(FooterInfo $model): void
    {
        Cache::forget('kz.footerInfos');
        Cache::forget('ru.footerInfos');
    }
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function creating(FooterInfo $model): void
    {
        Cache::forget('kz.footerInfos');
        Cache::forget('ru.footerInfos');
    }
}
