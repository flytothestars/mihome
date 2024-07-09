<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\ViewedProduct;
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
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

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
            $maxPrice = [];
            foreach ($products as $key => $product) {
                $offers[] = Schema::offer()->url($product->url);
                $ratingcount += $product->ratingcount;
                $rating += ($product->ratingcount * $product->rating);
                $maxPrice[$key] = $product->getMaxPrice();
            }

            $shemaCategory->aggregateRating(
                Schema::aggregateRating()
                    ->bestRating(5)
                    ->ratingCount($ratingcount)
                    ->ratingValue($ratingcount ? round($rating / $ratingcount, 1) : 0)
                    ->highPrice($maxPrice)
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

        $brand_array = [];
        if(!empty($category->products)){
        foreach($category->products as $product)
        {
            if(!empty($product->brand->slug))
            {
                $brand_array['brands'][] = [
                    'value' => $product?->brand?->slug,
                    'label' => $product?->brand?->name,
                ];   
            }
        }
        }
        $uniqueBrands = []; // Массив для хранения уникальных значений по ключу "value"
        if(!empty($brand_array)){
            foreach ($brand_array['brands'] as $brand) {
                $value = $brand['value'];
                if (!isset($uniqueBrands[$value])) {
                    // Если такого значения еще нет в $uniqueBrands, добавляем его
                    $uniqueBrands[$value] = $brand;
                }    
                $uniqueArray = array_values($uniqueBrands);
                $brands['brands'] = $uniqueArray;
                $all_filters = array_merge($brands,$category->filters);
            }
        }else {
            $all_filters = $category?->filters;
        }

        $data = [
            'tree' => $tree,
            'pagetitle' => $pagetitle,
            'category' => $category,
            'filter' => $filter,
            'filters' => $category ? $all_filters : null,
            'minprice' => $category && isset($category->min) ? $category->min : $minprice,
            'maxprice' => $category && isset($category->max) ? $category->max : $maxprice,
            'minpricetext' => $category && isset($category->min) ? number_format($category->min, 0, '.', ' ') : number_format($minprice, 0, '.', ' '),
            'maxpricetext' => $category && isset($category->max) ? number_format($category->max, 0, '.', ' ') : number_format($maxprice, 0, '.', ' '),
            'products' => $products,
        ];
        return view('store.category', $data);
    }

    public function product($product)
    {
        Storage::deleteDirectory('tmp/' . Session::getId());
        $productModel = Product::where('slug', $product)->withTrashed()->first();

        ViewedProduct::create([
            'user_id' => Auth::check() ? Auth::id() : Session::getId(),
            'product_id' => $productModel->id
        ]);

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
        View::share('meta_url', $productModel->url);
        View::share('meta_image', request()->getSchemeAndHttpHost() . '/storage/' . $productModel->images[0]->link);
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
        $favorite = Favorite::where('user_id', Auth::id())->where('product_id',$productModel->id)->first();
        
        $data = [
            'favorite' => $favorite,
            'product' => $productModel,
            'products' => $productModel->categoryProducts()->limit(10)->get(),
            'populars' => $productModel->popular()->limit(10)->get(),
            'offer' => $offer,
        ];
        // dd($data);
        return view('store.product', $data);
    }

    public function favorite($product)
    {
        Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $product
        ]);
        return redirect()->back();
    }

    public function unfavorite($product)
    {
        $favorite = Favorite::where('user_id', Auth::id())
                        ->where('product_id', $product)
                        ->first();

        if ($favorite) {
            $favorite->delete();
        }
        return redirect()->back();
    }
    
    private function getShemaOffer($o)
    {
        $validFrom = new \DateTime('2 days ago');
        $validFrom->setTime(0, 0, 0);
        $validThrough = new \DateTime('now');
        $validThrough->add(new \DateInterval('P3D'));
        $validThrough->setTime(23, 59, 59);

        if($o->in_stock > 0)	{
            $stock = "https://schema.org/InStock";
        }
        else if($o->price > 100)    {
            $stock = "https://schema.org/OutOfStock";
        }
        else    {
            $stock = "https://schema.org/SoldOut";
        }
        return Schema::offer()
            ->price($o->price)
            ->priceCurrency('KZT')
            ->sale_price($o->old_price)
            ->validFrom($validFrom->format('Y-m-d H:i:s') . PHP_EOL)
            ->validThrough($validThrough->format('Y-m-d H:i:s') . PHP_EOL)
            ->name($o->getTranslatedAttribute('name'))
            ->url($o->url)
            ->itemCondition('https://schema.org/NewCondition')
            ->availability($stock)
            ->priceValidUntil((new Carbon())->endOfYear()->addYear()->format("Y-m-d"))
            ->hasMerchantReturnPolicy(
                Schema::MerchantReturnPolicy()
                    ->merchantReturnLink('https://rent2go.kz/informaciya/vozvrat-tovarov')
		            ->applicableCountry('KZ')
		            ->merchantReturnDays(14)
		            ->returnPolicyCategory('https://schema.org/MerchantReturnFiniteReturnWindow')
		            ->returnMethod('https://schema.org/ReturnByMail')
		            ->returnFees('https://schema.org/FreeReturn')
            )
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
