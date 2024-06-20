<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Models\Property;
use Illuminate\Http\Request;
use Meilisearch\Endpoints\Indexes;
use Illuminate\Support\Facades\App;
use App\Http\Resources\Property as ResourcesProperty;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->q) {
            $products = Product::search(
                $request->q,
                function (Indexes $meiliSearch, string $query, array $options) use ($request) {
                    $options['limit'] = 9;
                    $options['sort'] = ['in_stock:desc'];
                    return $meiliSearch->search($query, $options);
                }
            );
            $categories = Category::search(
                $request->q,
                function (Indexes $meiliSearch, string $query, array $options) use ($request) {
                    $options['limit'] = 5;
                    return $meiliSearch->search($query, $options);
                }
            );
            $brands = Brand::search(
                $request->q,
                function (Indexes $meiliSearch, string $query, array $options) use ($request) {
                    $options['limit'] = 5;
                    return $meiliSearch->search($query, $options);
                }
            );
            return response()->json([
                'products' => $products->raw(),
                'categories' => $categories->raw(),
                'brands' => $brands->raw(),
            ]);
        } elseif ($request->catalog) {
            $products = Product::search(
                '',
                function (Indexes $meiliSearch, string $query, array $options) use ($request) {
                    $options['sort'] = ['in_stock:desc'];
                    $options['limit'] = 11;
                    $options['filter'] = [];
                    if ($request->get('c')) $options['filter'][] = 'categories = ' . $request->get('c');
                    $options['filter'] = implode(' AND ', $options['filter']);
                    return $meiliSearch->search($query, $options);
                }
            );
            return response()->json([
                'products' => $products->raw()
            ]);
        }
    }

    public function index(Request $request, $filters = false)
    {
        $filter = [];

        $category = null;

        $minprice = Product::getMinPrice();
        $maxprice = Product::getMaxPrice();

        $searchFilters = [];
        if ($filters) {
            $filters = explode('/', $filters);
            for ($k = 0; $k < count($filters); ++$k) {
                if (!$k) {
                    if ($filters[$k] === 'no-category') {
                    } else {
                        if ($category = Category::where('slug', $filters[$k])->first()) {
                            // $searchFilters['categories'] = $category->id;
                        }
                    }
                } else {
                    $property = Property::where('slug', $filters[$k])->first();
                    if ($k == 1 && !$property) {
                        $brands = explode('_or_', $filters[$k]);
                        // $searchFilters['brand'] = $brands;
                        // $filter['categories'] = $filters[$k];
                    } else {
                        if ($property) {
                            $values = explode('_or_', $filters[$k + 1]);
                            $searchFilters[$property->slug] = $values;
                            $filter[$property->slug] = $values;
                        }
                    }
                }
            }
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

        $properties = Cache::rememberForever(App::getLocale() . '.properties', function () {
            $properties =  Property::with('values')->get();
            return ResourcesProperty::collection($properties)->resolve();
        });

        foreach ($properties as $property) {
            if ($request->{$property['slug']}) {
                dump($request->{$property['slug']});
            }
        }

        $data = [
            'category' => $category,
            'filters' => $category ? $category->filters : null,
            'minprice' => isset($category->min) ? $category->min : $minprice,
            'maxprice' => isset($category->max) ? $category->max : $maxprice,
            'filter' => $filter,
            'products' => $products->paginate(5),
        ];

        return view('search.category', $data);
    }
}
