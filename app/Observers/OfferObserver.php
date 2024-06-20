<?php

namespace App\Observers;

use App\Models\Offer;

class OfferObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function created(Offer $offer): void
    {
        if ($offer->product) {
            $offer->product->in_stock = $offer->product->offers()->sum('in_stock');
            $offer->product->save();
        }
    }

    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function updated(Offer $offer): void
    {
        if ($offer->product) {
            $offer->product->in_stock = $offer->product->offers()->sum('in_stock');
            $offer->product->save();
        }
    }
}
