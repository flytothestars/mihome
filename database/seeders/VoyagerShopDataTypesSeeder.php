<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\DB;

class VoyagerShopDataTypesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->orders();
            $this->orderItems();
            $this->products();
            $this->offers();
            $this->countries();
            $this->currencies();
            $this->taxes();
            $this->cards();
            $this->addresses();
            $this->payments();
        });
    }

    /**
     * Create orders data types.
     *
     * @return void
     */
    private function orders(): void
    {
        $orders = DataType::updateOrCreate([
            'slug' => 'orders',
        ], [
            'name' => 'orders',
            'display_name_singular' => trans('orders.label_singular'),
            'display_name_plural' => trans('orders.label_plural'),
            'icon' => 'voyager-basket',
            'model_name' => \App\Models\Order::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\OrdersController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create order items data types.
     *
     * @return void
     */
    private function orderItems(): void
    {
        $orders = DataType::updateOrCreate([
            'slug' => 'order_items',
        ], [
            'name' => 'order_items',
            'display_name_singular' => trans('order-items.label_singular'),
            'display_name_plural' => trans('order-items.label_plural'),
            'icon' => 'voyager-bag',
            'model_name' => \App\Models\OrderItem::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\OrderItemsController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create products data types.
     *
     * @return void
     */
    private function products(): void
    {
        $products = DataType::updateOrCreate([
            'slug' => 'products',
        ], [
            'name' => 'products',
            'display_name_singular' => trans('products.label_singular'),
            'display_name_plural' => trans('products.label_plural'),
            'icon' => 'voyager-star',
            'model_name' => \App\Models\Product::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\ProductsController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create prodict variants data type.
     *
     * @return void
     */
    private function offers(): void
    {
        $offers = DataType::updateOrCreate([
            'slug' => 'offers',
        ], [
            'name' => 'offers',
            'display_name_singular' => trans('offers.label_singular'),
            'display_name_plural' => trans('offers.label_plural'),
            'icon' => 'voyager-star-half',
            'model_name' => \App\Models\Offer::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\OffersController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create countries data type.
     *
     * @return void
     */
    private function countries(): void
    {
        // countries
        $countries = DataType::updateOrCreate([
            'slug' => 'countries',
        ], [
            'name' => 'countries',
            'display_name_singular' => trans('countries.label_singular'),
            'display_name_plural' => trans('countries.label_plural'),
            'icon' => 'voyager-world',
            'model_name' => \App\Models\Country::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\CountriesController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create currencies data type.
     *
     * @return void
     */
    private function currencies(): void
    {
        $currencies = DataType::updateOrCreate([
            'slug' => 'currencies',
        ], [
            'name' => 'currencies',
            'display_name_singular' => trans('currencies.label_singular'),
            'display_name_plural' => trans('currencies.label_plural'),
            'icon' => 'voyager-dollar',
            'model_name' => \App\Models\Currency::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\CurrenciesController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create taxes data type.
     *
     * @return void
     */
    private function taxes(): void
    {
        $taxes = DataType::updateOrCreate([
            'slug' => 'taxes',
        ], [
            'name' => 'taxes',
            'display_name_singular' => trans('taxes.label_singular'),
            'display_name_plural' => trans('taxes.label_plural'),
            'icon' => 'voyager-pie-chart',
            'model_name' => \App\Models\Tax::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\TaxesController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create cards data type.
     *
     * @return void
     */
    private function cards(): void
    {
        $cards = DataType::updateOrCreate([
            'slug' => 'cards',
        ], [
            'name' => 'cards',
            'display_name_singular' => trans('cards.label_singular'),
            'display_name_plural' => trans('cards.label_plural'),
            'icon' => 'voyager-credit-cards',
            'model_name' => \App\Models\Card::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\CardsController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Create addresses data type.
     *
     * @return void
     */
    private function addresses(): void
    {
        $addresses = DataType::updateOrCreate([
            'slug' => 'addresses'
        ], [
            'name' => 'addresses',
            'display_name_singular' => trans('addresses.label_singular'),
            'display_name_plural' => trans('addresses.label_plural'),
            'icon' => 'voyager-book',
            'model_name' => \App\Models\Address::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\AddressController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }

    /**
     * Method to create payments data type.
     *
     * @return void
     */
    private function payments(): void
    {
        $payments = DataType::updateOrCreate([
            'slug' => 'payments'
        ], [
            'name' => 'payments',
            'display_name_singular' => trans('payments.label_singular'),
            'display_name_plural' => trans('payments.label_plural'),
            'icon' => 'voyager-dollar',
            'model_name' => \App\Models\Payment::class,
            'policy_name' => null,
            'controller' => \App\Http\Controllers\Backend\PaymentsController::class,
            'description' => '',
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
        ]);
    }
}
