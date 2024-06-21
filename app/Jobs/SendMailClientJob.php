<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderSuccess;
use Illuminate\Support\Facades\Mail;

class SendMailClientJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cart;
    public $order;
    public $view = 'mail.orders.success';
    /**
     * Create a new job instance.
     */
    public function __construct($cart, $order)
    {
        $this->cart = $cart;
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('crowndjoni@gmail.com')->send(new OrderSuccess($this->cart,$this->order, $this->view));
    }
}
