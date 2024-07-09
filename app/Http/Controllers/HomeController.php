<?php

namespace App\Http\Controllers;

use App\Http\Resources\Banner as ResourcesBanner;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductTizer;
use App\Models\Advantage;
use App\Models\Banner;
use App\Models\OurFavorite;
use App\Models\Product;
use App\Models\ViewedProduct;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        View::share(
            'shemaBreadCumbs',
            Schema::breadcrumbList()
                ->itemListElement([
                    Schema::listItem()
                        ->position(1)
                        ->name("Магазин Xiaomi (Mi Home)")
                        ->url("https://mi-home.kz/"),
                    Schema::listItem()
                        ->position(2)
                        ->name("🏠 Товары для дома Xiaomi 🏘️")
                        ->url("https://mi-home.kz/#Xiaomi"),
                ])
        );

        $banners = Cache::rememberForever(App::getLocale() . '.banners', function () {
            $banners = Banner::all();
            return ResourcesBanner::collection($banners)->resolve();
        });
        $data['banners'] = $banners;
        $data['promotions'] = Promotion::latest()
            ->where('active_to', '>', now())
            ->where('active_from', '<', now())
            ->limit(9)->get();
        $data['advantages'] = Advantage::all();
        $data['favorites'] = OurFavorite::all();
        $data['latests'] = Product::latest()->limit(32)->get();

        $data['viewedProduct'] = ViewedProduct::where('user_id', Auth::check() ? Auth::id() : Session::getId())->get();
        
        return view('home', $data);
    }
    /**
     * Handle the incoming request.
     */
    public function populars(Request $request)
    {
        return ['populars' => ProductTizer::collection(Product::popular()->whereHas('offers', function (Builder $query) {
            $query->where('in_stock', '>', 0);
        })->limit(96)->get())];
    }
}
