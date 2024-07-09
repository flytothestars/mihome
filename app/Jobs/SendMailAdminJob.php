<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccess;

class SendMailAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cart;
    public $order;
    public $admin;
    public $view = 'mail.admin.success';
    /**
     * Create a new job instance.
     */
    public function __construct($cart, $order, $admin)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->admin->email)->send(new OrderSuccess($this->cart,$this->order,$this->view));
    }
}
