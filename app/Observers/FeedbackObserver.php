<?php

namespace App\Observers;

use App\Models\Feedback;
use App\Models\User;
use App\Notifications\FeedbackCreatedNotification;

class FeedbackObserver
{
    /**
     * Handle creating event of order model.
     * @param  Order $order The order model.
     * @return void
     */
    public function created(Feedback $feedback): void
    {
        $user = new User();
        $user->email = setting('shop.email');
        $user->notify(new FeedbackCreatedNotification($feedback));
    }
}
