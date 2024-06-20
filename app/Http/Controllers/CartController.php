<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function index(Request $request)
    {

        return view('store.cart.index');
    }


    public function createOrder(Request $request)
    {
        if (Auth::check()) {
            $order = Order::create([
                "user_id" => Auth::user()->id,
                "billing_address_id" => null,
                "shipping_address_id" => null,
                "sum" => 5000
            ]);
            return response()->json([
                'success' => true
            ]);
        } else {
            $request->validate([
                'form.first_name' => ['required', 'string', 'max:255'],
                'form.email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')],
            ]);
            $request = $request->all();
            $user = User::create([
                'name' => $request['form']['first_name'],
                'email' => $request['form']['email'],
                'password' => Hash::make(Str::random(60)),
            ]);
            event(new Registered($user));
            Auth::login($user);
            $order = Order::create([
                "user_id" => Auth::getUser()->id,
                "billing_address_id" => null,
                "shipping_address_id" => null,
                "sum" => 5000
            ]);


            return response()->json([
                'success' => true
            ]);
        }
    }

    // public function createOrderAuth(Request $request)
    // {
    //     if (Auth::check()) {
    //         $request->validate([
    //             'form.address' => ['required'],
    //             'form.city' => ['required'],
    //             'form.delivery' => ['required'],
    //             'form.region' => ['required'],
    //             'form.billing_address_id' => ['required'],
    //             'form.shipping_address_id' => ['required'],
    //         ]);
    //         $order = Order::create([
    //             "user_id" => Auth::user()->id,
    //             "billing_address_id" => null,
    //             "shipping_address_id" => null,
    //             "sum" => 5000
    //         ]);
    //         return response()->json([
    //             'success' => true
    //         ]);
    //     } else {
    //         $request->validate([
    //             'form.first_name' => ['required', 'string', 'max:255'],
    //             'form.email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')],
    //         ]);
    //         $request = $request->all();
    //         $user = User::create([
    //             'name' => $request['form']['first_name'],
    //             'email' => $request['form']['email'],
    //             'password' => Hash::make(Str::random(60)),
    //         ]);
    //         event(new Registered($user));
    //         Auth::login($user);
    //         $order = Order::create([
    //             "user_id" => Auth::getUser()->id,
    //             "billing_address_id" => null,
    //             "shipping_address_id" => null,
    //             "sum" => 5000
    //         ]);


    //         return response()->json([
    //             'success' => true
    //         ]);
    //     }
    // }

    // public function createOrderAuth(Request $request)
    // {
    //     $request->validate([
    //         'form.first_name' => ['required', 'string', 'max:255'],
    //         'form.email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')],
    //     ]);
    //     $request = $request->all();
    //     $order = Order::create([]);


    //     return response(json_encode(''));
    // }
}
