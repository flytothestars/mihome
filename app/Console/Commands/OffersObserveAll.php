<?php

namespace App\Console\Commands;

use App\Models\Offer;
use App\Observers\OfferObserver;
use Illuminate\Console\Command;

class OffersObserveAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offers:observe-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Offer::all() as $offer) {
            (new OfferObserver)->updated($offer);
        }
    }
}
