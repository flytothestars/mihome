<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\HBepay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PayController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $token)
    {
        $order = Order::where('token', $token)->firstOrFail();
        $pay_order = new HBepay();

        return $pay_order->gateway(
            config('halyk.env'),
            config('halyk.client'),
            config('halyk.secret'),
            config('halyk.shop'),
            str_pad($order->id, 9, '0', STR_PAD_LEFT),
            $order->total,
            "KZT",
            config('app.url') . "/order/" . $order->token . "/success",
            config('app.url') . "/order/" . $order->token . "/failure",
            config('app.url') . "/epay/check",
            config('app.url') . "/epay/fail",
            "RU",
            "HB payment gateway",
            Auth::check() ? Auth::id() : Session::getId(),
            $order->phone,
            $order->email
        );
    }
}
