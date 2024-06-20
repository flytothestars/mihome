<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function getOrder($token)
    {
        return Order::where('token', $token)->where(function (Builder $query) {
            $query->whereNull('user_id')->orWhere('user_id', Auth::id());
        })->firstOrFail();
    }

    public function __invoke(Request $request, $token)
    {
        $order = $this->getOrder($token);
        return view('store.order.show', [
            'order' => $order
        ]);
    }

    public function success(Request $request, $token)
    {
        $order = $this->getOrder($token);
        return view('store.order.success', [
            'order' => $order
        ]);
    }
    public function failure(Request $request, $token)
    {
        $order = $this->getOrder($token);
        return view('store.order.failure', [
            'order' => $order
        ]);
    }
}
