<?php

namespace App\Observers;

use App\Models\Cart;

class CartObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function deleting(Cart $model): void
    {
        foreach ($model->items as $item) $item->delete();
    }
}
