<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Meilisearch\Endpoints\Indexes;
use Spatie\SchemaOrg\Schema;
use TCG\Voyager\Facades\Voyager;

class CatalogController extends Controller
{

    public function __invoke(Request $request)
    {
        return $this->category($request, '/no-category');
    }

    public function category(Request $request, $path, $filters = null)
    {

        View::share('meta_title', "Все товары Магазин Xiaomi (Mi Home) - цены, купить в кредит, рассрочку в Алматы");
        View::share('meta_description', "【Все товары Магазин Xiaomi (Mi Home)】#️⃣ Каталог товаров Xiaomi. Подробнее ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы");


        $pagetitle = "Все товары Магазин Xiaomi (Mi Home)";

        $path = explode('/filter', $path);
        $catSlugs = explode('/', trim($path[0], '/'));

        $filter = [];
        $minprice = Product::getMinPrice();
        $maxprice = Product::getMaxPrice();

        $category = null;
        $tree = [];

        foreach ($catSlugs as $catSlug) {
            if ($catSlug === 'no-category') continue;
            $category = $category ? $category->children()->whereSlug($catSlug)->firstOrFail() : Category::whereNull('parent_id')->whereSlug($catSlug)->firstOrFail();
            $tree[] = $category;
        }

        if ($category) $pagetitle = $category->getTranslatedAttribute('name');

        $searchFilters = [];

        if (isset($filters) || isset($path[1])) {
            $filters = $filters ?: trim($path[1], '/');
            if ($filters) {
                foreach (explode('/', $filters) as $ff) {
                    $filterValues = explode('_or_', $ff);
                    $labels = [];
                    foreach ($filterValues as $filterValue) {
                        $propertyValue = PropertyValue::where('slug', $filterValue)->first();
                        if ($propertyValue) {
                            $searchFilters[$propertyValue->property->slug][] = $propertyValue->slug;
                            $filter[$propertyValue->property->slug][] = $propertyValue->slug;
                            $labels[] = $propertyValue->title;
                        }
                    }
                    $pagetitle .= ' - ' . implode(', ', $labels);
                }
            }
        }

        if ($category) {
            View::share('meta_title', $pagetitle . " - цены, купить в кредит, рассрочку в Алматы");
            View::share('meta_description', '【' . $pagetitle . '】#️⃣ ' . $category->getTranslatedAttribute('meta_desc') . ' ' .  "❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы");
        } else {
            View::share('meta_title', $pagetitle . " - цены, купить в кредит, рассрочку в Алматы");
            View::share('meta_description', "【' . $pagetitle . '】#️⃣ Каталог товаров Xiaomi. Подробнее ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы");
        }

        $filter['minprice'] = (float)$request->minprice ? (float)$request->minprice : (isset($category->min) ? $category->min : $minprice);
        $filter['maxprice'] = (float)$request->maxprice ? (float)$request->maxprice : (isset($category->max) ? $category->max : $maxprice);

        $products = Product::search(
            '',
            function (Indexes $meiliSearch, string $query, array $options) use ($request, $category, $searchFilters) {
                $options['sort'] = ['in_stock:desc'];
                // $options['limit'] = 24;
                $options['filter'] = [];
                if ($category) $options['filter'][] = 'categories = ' . $category->id;
                foreach ($searchFilters as $filterKey => $searchFilter) {
                    $filterOptions = [];
                    foreach ($searchFilter as $fo)  $filterOptions[] = "filters = '" . $filterKey . "=" . $fo . "'";
                    $options['filter'][] = "(" . implode(" OR ", $filterOptions) . ")";
                }
                if ((float)$request->minprice) $options['filter'][] = ("maxprice >= " . (float)$request->minprice);
                if ((float)$request->maxprice) $options['filter'][] = ("minprice <= " . (float)$request->maxprice);
                $options['filter'] = implode(' AND ', $options['filter']);
                return $meiliSearch->search($query, $options);
            }
        );

        $countProducts =  $products->raw()['estimatedTotalHits'];
        $products = $products->paginate(40);

        if ($category) {
            $shemaCategory = Schema::product()
                ->name($category->getTranslatedAttribute('name'))
                ->description($category->getTranslatedAttribute('meta_desc'))
                ->url($category->url);
            $category->image && $shemaCategory->image(url(Storage::url($category->image)));

            $rating = 0;
            $ratingcount = 0;
            $offers = [];

            foreach ($products as $product) {
                $offers[] = Schema::offer()->url($product->url);
                $ratingcount += $product->ratingcount;
                $rating += ($product->ratingcount * $rating);
            }

            $shemaCategory->aggregateRating(
                Schema::aggregateRating()
                    ->bestRating(5)
                    ->ratingCount($ratingcount)
                    ->ratingValue($ratingcount ? round($rating / $ratingcount, 1) : 0)
            );

            $shemaCategory->offers(
                Schema::aggregateOffer()
                    ->offerCount($countProducts)
                    ->lowPrice($filter['minprice'])
                    ->lowPrice($filter['maxprice'])
                    ->priceCurrency('KZT')
                    ->offers($offers)
            );

            View::share(
                'shemaCategory',
                $shemaCategory
            );
        } else {
        }

        $data = [
            'tree' => $tree,
            'pagetitle' => $pagetitle,
            'category' => $category,
            'filter' => $filter,
            'filters' => $category ? $category->filters : null,
            'minprice' => $category && isset($category->min) ? $category->min : $minprice,
            'maxprice' => $category && isset($category->max) ? $category->max : $maxprice,
            'products' => $products,
        ];

        return view('store.category', $data);
    }

    public function product($product)
    {
        Storage::deleteDirectory('tmp/' . Session::getId());

        $productModel = Product::where('slug', $product)->withTrashed()->first();

        $offer = null;
        if (!$productModel) {
            $offer = Offer::where('slug', $product)->withTrashed()->firstOrFail();
            $productModel = $offer->product;
        }

        $productModel->viewed += $productModel->viewed;
        $productModel->hits += $productModel->hits;
        $productModel->save();

        if (!$offer && $productModel->offers->count() === 1) $offer = $productModel->offers()->first();

        View::share('meta_title', $productModel->meta_title ?: ($productModel->getTranslatedAttribute('name') . " - цена, купить в кредит, рассрочку в Алматы"));


        if ($productModel->metadesc) {
            View::share('meta_description', $productModel->metadesc);
        } elseif ($productModel->short_metadesc) {
            View::share('meta_description', "【" . $productModel->category->name . "】#️⃣ " . $productModel->short_metadesc . " ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Характеристики 3️⃣ Отзывы");
        } else {
            View::share('meta_description', "【{$productModel->getTranslatedAttribute('name')}】#️⃣ {$productModel->getTranslatedAttribute('description')} ✳️ Модель: {$productModel->article} ❤️ Гарантия 1 год ⭐ Доставка по Алматы и РК ✴️ Скидки и подарки ⛪ Адрес: пр. Абая 62А 1️⃣ Описание 2️⃣ Xарактеристики 3️⃣ Отзывы");
        }

        $shemaProduct = Schema::product()
            ->productID($productModel->id)
            ->name($productModel->getTranslatedAttribute('name'))
            ->description($productModel->getTranslatedAttribute('description'))
            ->url($productModel->url)
            ->sku($productModel->article)
            ->mpn($productModel->article);

        $productModel->brand && $shemaProduct->brand(Schema::brand()->name($productModel->brand->getTranslatedAttribute('name')));
        if ($productModel->advimage) {
            $shemaProduct->image(url(Storage::url($productModel->advimage)));
        } else {
            $productModel->images()->count() && $shemaProduct->image(url(Storage::url($productModel->images[0]->link)));
        }


        if ($offer || $productModel->offers()->count() === 1) {
            if (!$offer) $shemaOffers = $this->getShemaOffer($productModel->offers[0]);
            else $shemaOffers = $this->getShemaOffer($offer);
        } else {
            $shemaOffers = [];
            foreach ($productModel->offers as $o)
                $shemaOffers[] = $this->getShemaOffer($o);
        }

        $shemaProduct->offers($shemaOffers);

        if ($productModel->rating) $shemaProduct
            ->aggregateRating(
                Schema::aggregateRating()
                    ->ratingValue($productModel->rating)
                    ->reviewCount($productModel->ratingcount)
            );

        View::share(
            'shemaProduct',
            $shemaProduct
        );

        $data = [
            'product' => $productModel,
            'products' => $productModel->categoryProducts()->limit(10)->get(),
            'populars' => $productModel->popular()->limit(10)->get(),
            'offer' => $offer,
        ];

        return view('store.product', $data);
    }

    private function getShemaOffer($o)
    {
        return Schema::offer()
            ->price($o->price)
            ->priceCurrency('KZT')
            ->name($o->getTranslatedAttribute('name'))
            ->url($o->url)
            ->itemCondition(Schema::offerItemCondition("NewCondition"))
            ->availability(Schema::itemAvailability("InStock"))
            ->priceValidUntil((new Carbon())->endOfYear()->addYear()->format("Y-m-d"))
            ->shippingDetails(
                Schema::OfferShippingDetails()
                    ->shippingRate(
                        Schema::monetaryAmount()
                            ->value(0)
                            ->currency('KZT')
                    )->shippingDestination([
                        Schema::definedRegion()
                            ->addressCountry('KZ')
                    ])->deliveryTime(
                        Schema::shippingDeliveryTime()
                            ->handlingTime(
                                Schema::quantitativeValue()
                                    ->unitCode('day')
                                    ->minValue(0)
                                    ->maxValue(1)
                            )->transitTime(
                                Schema::quantitativeValue()
                                    ->unitCode('day')
                                    ->minValue(1)
                                    ->maxValue(15)
                            )
                    )
            )->seller(
                Schema::organization()->name("Магазин Xiaomi (Mi Home)")
            );
    }
}
