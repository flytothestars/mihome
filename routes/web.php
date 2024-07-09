<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Store\EpayController;
use App\Http\Controllers\Store\OrderController;
use App\Http\Controllers\Store\PayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\Routing;
use TCG\Voyager\Events\RoutingAdmin;
use TCG\Voyager\Events\RoutingAdminAfter;
use TCG\Voyager\Events\RoutingAfter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth/callback/google', function () {
    $user = Socialite::driver('google')->user();
})->name('callback.google');

Route::get('/auth/redirect/facebook', function () {
    return Socialite::driver('facebook')->redirect();
})->name('auth.facebook');

Route::get('/auth/callback/facebook', function () {
    $user = Socialite::driver('facebook')->user();
})->name('callback.facebook');

Route::get('/auth/redirect/vkontakte', function () {
    return Socialite::driver('vkontakte')->redirect();
})->name('auth.vkontakte');

Route::get('/auth/callback/vkontakte', function () {
    $user = Socialite::driver('vkontakte')->user();
})->name('callback.vkontakte');


Route::group(['as' => 'ru.', 'middleware' => 'locale.ru'], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/populars', [HomeController::class, 'populars'])->name('home.populars');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/create-order', [CartController::class, 'createOrder'])->name('create-order');


    // Route::get('/search/{filters?}', [SearchController::class, 'index'])->where('filters', '.*')->name('search');
    Route::get('/autocomplete', SearchController::class)->name('autocomplete');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
            Route::resource('orders', Profile\OrderController::class)->only(['index', 'show']);
            Route::get('favorites', [Profile\OrderController::class, 'favorites'])->name('favorites');
        });
    });

    Route::get('/informaciya', [PageController::class, 'index'])->name('informaciya.index');
    Route::get('/informaciya/{page}', [PageController::class, 'show'])->name('informaciya.show');

    Route::get('/whatsapp', [PageController::class, 'whatsappPage'])->name('whatsapp');
    Route::get('/obratnyj-zvonok', [PageController::class, 'obratnyjZvonokPage'])->name('obratnyj-zvonok');
    Route::get('/kredit', [PageController::class, 'kreditPage'])->name('kredit');
    Route::get('/bystryj-zakaz', [PageController::class, 'bystryjZakazPage'])->name('bystryj-zakaz');
    Route::get('/wholesale', [PageController::class, 'wholesalePage'])->name('wholesale');


    Route::resource('/manufacturers', BrandController::class)->only(['index']);
    Route::get('/manufacturers/{manufacturer}/{category?}', [BrandController::class, 'show'])->name('manufacturers.show');

    Route::get('/store', CatalogController::class)->name('store');
    Route::get('/no-category', CatalogController::class)->name('no-category');
    Route::get('/pay/{token}', PayController::class)->name('pay');

    Route::get('/order/{token}', OrderController::class)->name('order.show');
    Route::get('/order/{token}/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/{token}/failure', [OrderController::class, 'failure'])->name('order.failure');

    Route::any('/epay/check', [EpayController::class, 'check'])->name('epay.check');
    Route::any('/epay/fail', [EpayController::class, 'fail'])->name('epay.fail');


    Route::get('/store/{path}/filter/{filters}', [CatalogController::class, 'category'])->where('path', '^[a-zA-Z0-9-_\/]+$')->where('filters', '^[a-zA-Z0-9-_\/]+$')->name('category.filter');
    Route::get('/store/{path}', [CatalogController::class, 'category'])->where('path', '^[a-zA-Z0-9-_\/]+$')->name('category');
    Route::get('/product/{product}', [CatalogController::class, 'product'])->name('product');
    Route::get('/product/favorite/{product}', [CatalogController::class, 'favorite'])->name('favorite');
    Route::get('/product/unfavorite/{product}', [CatalogController::class, 'unfavorite'])->name('unfavorite');

    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/files', [ReviewController::class, 'files'])->name('reviews.files');
    Route::patch('/reviews/files/delete', [ReviewController::class, 'filesDelete'])->name('reviews.files.delete');

    require __DIR__ . '/auth.php';
});

// Route::group(['prefix' => 'kz', 'as' => 'kz.', 'middleware' => 'locale.kz'], function () {
//     Route::get('/', HomeController::class)->name('home');

//     Route::middleware('auth')->group(function () {
//         Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//         Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//         Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     });
//     Route::get('/informaciya', [PageController::class, 'index'])->name('informaciya.index');
//     Route::get('/informaciya/{page}', [PageController::class, 'show'])->name('informaciya.show');

//     Route::get('/store', [CatalogController::class, '__invoke'])->name('store');
//     Route::get('/store/{path}', [CatalogController::class, 'category'])->where('path', '^[a-zA-Z0-9-_\/]+$')->name('category');
//     Route::get('/product/{product}', [CatalogController::class, 'product'])->name('product');

//     require __DIR__ . '/auth.php';
// });

Route::get('reset-password/{token}', function (Request $request) {
    return redirect()->route(app()->getLocale() . '.password.reset');
})->name('password.reset');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['as' => 'voyager.'], function () {
        event(new Routing());

        $namespacePrefix = '\\' . config('voyager.controllers.namespace') . '\\';

        Route::group(['middleware' => 'admin.user'], function () use ($namespacePrefix) {
            event(new RoutingAdmin());
            // create routes
            Route::get('orders', $namespacePrefix . 'OrdersController@index')->name('voyager.orders.index');
            Route::get('order_items', $namespacePrefix . 'OrderItemsController@index')->name('voyager.order_items.index');
            Route::get('products', $namespacePrefix . 'ProductsController@index')->name('voyager.products.index');
            Route::get('offers', $namespacePrefix . 'OffersController@index')->name('voyager.offers.index');
            Route::get('countries', $namespacePrefix . 'CountriesController@index')->name('voyager.countries.index');
            Route::get('currencies', $namespacePrefix . 'CurrenciesController@index')->name('voyager.currencies.index');
            Route::get('taxes', $namespacePrefix . 'TaxesController@index')->name('voyager.taxes.index');
            Route::get('cards', $namespacePrefix . 'CardsController@index')->name('voyager.cards.index');
            Route::get('reviews', $namespacePrefix . 'CardsController@index')->name('voyager.reviews.index');
            event(new RoutingAdminAfter());
        });
        event(new RoutingAfter());
    });

    Voyager::routes();
});
