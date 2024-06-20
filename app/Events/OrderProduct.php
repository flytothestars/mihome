<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\Offer;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Offer;
    public $price;
    public $description;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Offer &$Offer, int &$price, string &$description)
    {
        $this->Offer = &$Offer;
        $this->price = &$price;
        $this->description = &$description;
    }
}
