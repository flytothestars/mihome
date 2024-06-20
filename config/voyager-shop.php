<?php

/*
|--------------------------------------------------------------------------
| Voyager Shop Configuration
|--------------------------------------------------------------------------
|
| In this configuration file you will find all options for this package.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | In this section you will find all options regarding the relationshps of
    | this package.
    |
    */

    'tables' => [
        'products' => 'products',
        'taxes' => 'taxes',
        'users' => 'users',
        'offers' => 'offers',
        'orders' => 'orders',
        'countries' => 'countries',
        'cards' => 'cards',
        'addresses' => 'addresses',
        'currency' => 'currencies',
    ],

    'models' => [
        'user' => \App\Models\User::class,
        'order' => \App\Models\Order::class,
        'orderItem' => \App\Models\OrderItem::class,
        'product' => \App\Models\Product::class,
        'offer' => \App\Models\Offer::class,
        'address' => \App\Models\Address::class,
        'billingAddress' => \App\Models\Address::class,
        'shippingAddress' => \App\Models\Address::class,
        'payment' => \App\Models\Payment::class,
        'currency' => \App\Models\Currency::class,
    ],

    'foreign_keys' => [
        'user' => 'user_id',
        'country' => 'country_id',
        'tax' => 'tax_id',
        'order' => 'order_id',
        'orderItem' => 'order_item_id',
        'product' => 'product_id',
        'offer' => 'offer_id',
        'address' => 'address_id',
        'billingAddress' => 'billing_address_id',
        'shippingAddress' => 'shipping_address_id',
        'payment' => 'payment_id',
        'currency' => 'currency_id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | In this section you can set the options for your default currency.
    |
    */

    'currency' => 'kzt',

    /*
    |--------------------------------------------------------------------------
    | Order States
    |--------------------------------------------------------------------------
    |
    | In this section you can set the states of the orders.
    |
    */

    'order_states' => [
        'cart' => 'cart',
        'pending' => 'pending',
        'billed' => 'billed',
        'canceled' => 'canceled',
        'declined' => 'declined',
        'refunded' => 'refunded'
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    |
    | In this section you can overwrite the validation rules used for each
    | entity.
    |
    */

    'validation' => [

        'address' => [
            'id' => 'sometimes|exists:addresses,id',
            'name' => 'required|string|min:3',
            'street' => 'required|string|min:3',
            'zip' => 'required|string|min:4',
            'country_id' => 'sometimes|exists:countries,id',
            'country' => 'sometimes|string|size:2|exists:countries,code',
            'user_id' => 'sometimes|exists:users,id',
        ],

        'countries' => [
            'name' => 'required|min:3',
            'code' => 'required|regex:/^[A-Z]{3}$/'
        ],

        'currencies' => [
            'name' => 'required|min:3',
            'code' => 'required|regex:/^[A-Z]{3}$/',
            'sign' => 'required|min:1|max:1',
            'country_id' => 'required|exists:countries,id',
        ],

        'order_items' => [
            'order_item_belongsto_offer_relationship' => 'required|exists:offers,id',
            'quantity' => 'required|numeric|min:1',
            'order_item_belongsto_order_relationship' => 'required|exists:orders,id',
        ],

        'orders' => [
            'state' => 'required|in:cart,pending,billed,canceled,declined,refunded',
            'order_belongsto_user_relationship' => 'required|exists:users,id',
        ],

        'products' => [
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'description' => 'required|min:3'
        ],

        'offers' => [
            'name' => 'required|min:3',
            'details' => 'required|min:3',
            'price' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
        ],

        'payments' => [
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'state' => 'required|string',
            'order_id' => 'sometimes|exists:orders,id',
            'user_id' => 'sometimes|exists:users,id',
        ],

    ],

];
