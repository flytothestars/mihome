<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;

class OrderObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function creating(Order $order): void
    {
        // create token
        $order->token = Str::random(60);
        $order->user_id = Auth::check() ? Auth::id() : null;
        $order->status_id = 1;
    }
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function created(Order $order): void
    {
        $user = new User();
        $user->email = setting('shop.email');
        $user->notify(new OrderCreatedNotification($order));
    }
}
