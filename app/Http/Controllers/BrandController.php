<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Meilisearch\Endpoints\Indexes;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        View::share('meta_title', "Все бренды - цены, купить в кредит, рассрочку в Алматы");
        View::share('meta_description', "【Все бренды】#️⃣ Каталог товаров Xiaomi. Подробнее ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы");

        return view('brands.index', [
            'brands' => Brand::all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $manufacturer, Category $category = null)
    {

        $pagetitle = $manufacturer->getTranslatedAttribute('name');

        View::share('meta_title', $pagetitle . " - цены, купить в кредит, рассрочку в Алматы");
        View::share('meta_description', '【' . $pagetitle . '】#️⃣ ' . $manufacturer->getTranslatedAttribute('metadesc') . ' ' .  "Каталог товаров Xiaomi. Подробнее ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы");

        $products = Product::withTranslations();

        $products = Product::withTranslations()->whereHas('brand', function (Builder $query) use ($manufacturer) {
            $query->where('brand_id', $manufacturer->id);
        });

        if ($category) {
            $products->whereHas('category', function (Builder $query) use ($category) {
                $query->where('_lft', '>=', $category->_lft);
                $query->where('_rgt', '<=', $category->_rgt);
            });
        }

        $ct = Brand::search(
            '',
            function (Indexes $meiliSearch, string $query, array $options) use ($manufacturer) {
                $options['limit'] = 1;
                $options['filter'] = ['id=' . $manufacturer->id];
                return $meiliSearch->search($query, $options);
            }
        )->raw();

        $categories = $ct && isset($ct['hits']) ? $ct['hits'][0]['categories'] : [];

        return view('brands.show', [
            'category' => $category,
            'categories' => $categories,
            'brand' => $manufacturer,
            'products' => $products->orderBy('in_stock', 'desc')->paginate(40)
        ]);
    }
}
