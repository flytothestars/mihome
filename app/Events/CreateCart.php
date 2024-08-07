<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateCart
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order &$Order)
    {
        $this->Order = &$Order;
    }
}
