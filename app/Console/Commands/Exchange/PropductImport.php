<?php

namespace App\Console\Commands\Exchange;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PropductImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:propduct-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (DB::table('joom_virtuemart_products')
            ->leftJoin('joom_virtuemart_products_ru_ru', 'joom_virtuemart_products.virtuemart_product_id', '=', 'joom_virtuemart_products_ru_ru.virtuemart_product_id')
            ->where('product_parent_id', 0)
            ->select([
                'joom_virtuemart_products.virtuemart_product_id as id', //id
                'joom_virtuemart_products.product_sku as article', // article
                'joom_virtuemart_products.product_weight as weight', // weight
                'joom_virtuemart_products.product_special as special', // special
                'joom_virtuemart_products.hits as hits', // hits
                'joom_virtuemart_products.published as published', // published
                'joom_virtuemart_products.created_on as created_at', // created_at
                'joom_virtuemart_products.modified_on as updated_at', // created_at
                'joom_virtuemart_products_ru_ru.product_name as name', // name
                'joom_virtuemart_products_ru_ru.slug as slug', // slug
                'joom_virtuemart_products_ru_ru.product_desc as body', // body
                'joom_virtuemart_products_ru_ru.product_s_desc as description', // description
                'joom_virtuemart_products_ru_ru.customtitle as metatitle', // metatitle
                'joom_virtuemart_products_ru_ru.metadesc as metadesc', // metadesc
                'joom_virtuemart_products_ru_ru.metakey as metakey', // metakey
            ])
            ->get() as $data) {

            $pattern = '/src=([\'"])images/i';
            $replacement = 'src=$1/images';
            $data->body = preg_replace($pattern, $replacement, $data->body);
            $data->hits = 0;

            $product = Product::where('id', (int)$data->id)->withTrashed()->first();
            $dataArray = (array)$data;
            try {
                if ($product) {
                    unset($dataArray['id']);
                    $product->update($dataArray);
                } else  $product = Product::create($dataArray);
            } catch (\Throwable $e) {
                dump($e->getMessage());
                continue;
            }

            $prcaArr = [];
            foreach (DB::table('joom_virtuemart_product_categories')->where('virtuemart_product_id', $product->id)->orderBy('virtuemart_product_id', 'asc')->get() as $prcat) {
                $prcaArr[] = $prcat->virtuemart_category_id;
            }

            $depth = [];
            foreach ($prcaArr as $catId) {
                if ($catId === 46) {
                    $product->popular = 1;
                    continue;
                }
                $category = Category::withDepth()->find($catId);
                if ($category) {
                    $depth[$category->depth] =  $catId;
                }
            }
            $product->category_id = array_pop($depth);


            $brand = DB::table('joom_virtuemart_product_manufacturers')->where('virtuemart_product_id', $product->id)->orderBy('virtuemart_product_id', 'asc')->first();
            $product->brand_id = $brand ? $brand->virtuemart_manufacturer_id : null;
            $product->save();



            foreach (DB::table('joom_virtuemart_ratings')->where('virtuemart_product_id', $product->id)->get() as $prate) {
                $product->rating = $prate->rating;
                $product->ratingcount = $prate->ratingcount;
                $product->save();
            }

            $sort = 0;
            foreach (DB::table('joom_virtuemart_product_medias')->where('joom_virtuemart_product_medias.virtuemart_product_id', $product->id)->leftJoin('joom_virtuemart_medias', 'joom_virtuemart_medias.virtuemart_media_id', '=', 'joom_virtuemart_product_medias.virtuemart_media_id')->get() as $im) {
                ++$sort;
                if (strstr($im->file_url, "images/virtuemart/product/"))
                    $product->images()->firstOrCreate([
                        'link' => str_replace("images/virtuemart/product", "images/products", $im->file_url)
                    ], [
                        'sort' => $im->ordering * 100,
                    ]);
                else
                    dump($im->file_url);
            }

            $sort = 0;
            foreach (DB::table('joom_virtuemart_products')->where('product_parent_id', $product->id)
                ->leftJoin('joom_virtuemart_products_ru_ru', 'joom_virtuemart_products.virtuemart_product_id', '=', 'joom_virtuemart_products_ru_ru.virtuemart_product_id')
                ->get() as $im) {
                ++$sort;

                $data = [
                    'name' => $im->product_name,
                    'slug' => $im->slug,
                    'kaspi' => $im->product_discontinued,
                    'kaspi_link' => $im->product_url,
                    'order' => $sort * 100,
                    'article' => $im->product_sku,
                    'metatitle' => $im->customtitle,
                    'metadesc' => $im->metadesc,
                    'gtin' => $im->product_gtin,
                    'halyk' => $im->product_mpn,
                    'in_stock' => $im->product_in_stock,
                    'pre_order' => $im->product_length,
                    'ordered' => $im->product_ordered,
                    'available_date' => $im->product_available_date === '0000-00-00 00:00:00' ? now() : $im->product_available_date,
                    'pordering' => $im->pordering,
                ];

                $price = DB::table('joom_virtuemart_product_prices')->where('virtuemart_product_id', $im->virtuemart_product_id)
                    ->where('joom_virtuemart_product_prices.virtuemart_shoppergroup_id', 0)->first();

                if ($price) {
                    $data = array_merge($data, [
                        'old_price' => $price->product_price,
                        'price' => $price->product_override_price ?: $price->product_price,
                    ]);
                }

                try {
                    $offer = $product->offers()->withTrashed()->updateOrCreate([
                        'id' => $im->virtuemart_product_id,
                    ], $data);
                } catch (\Throwable $e) {
                    dump($e->getMessage());
                    continue;
                }

                foreach (DB::table('joom_virtuemart_product_medias')->where('joom_virtuemart_product_medias.virtuemart_product_id', $offer->id)->leftJoin('joom_virtuemart_medias', 'joom_virtuemart_medias.virtuemart_media_id', '=', 'joom_virtuemart_product_medias.virtuemart_media_id')->get() as $im) {
                    if (strstr($im->file_url, "images/virtuemart/product/"))
                        $offer->images()->firstOrCreate([
                            'link' => str_replace("images/virtuemart/product", "images/offers", $im->file_url)
                        ], [
                            'sort' => $im->ordering * 100,
                        ]);
                    else
                        dump($im->file_url);
                }
            }

            if (!$sort) {
                foreach (DB::table('joom_virtuemart_products')->where('joom_virtuemart_products.virtuemart_product_id', $product->id)
                    ->leftJoin('joom_virtuemart_products_ru_ru', 'joom_virtuemart_products.virtuemart_product_id', '=', 'joom_virtuemart_products_ru_ru.virtuemart_product_id')
                    ->get() as $im) {

                    $data = [
                        'name' => $im->product_name,
                        'slug' => $im->slug,
                        'kaspi' => $im->product_discontinued,
                        'kaspi_link' => $im->product_url,
                        'order' => 100,
                        'article' => $im->product_sku,
                        'metatitle' => $im->customtitle,
                        'metadesc' => $im->metadesc,
                        'gtin' => $im->product_gtin,
                        'halyk' => $im->product_mpn,
                        'in_stock' => $im->product_in_stock,
                        'pre_order' => $im->product_length,
                        'ordered' => $im->product_ordered,
                        'available_date' => $im->product_available_date === '0000-00-00 00:00:00' ? now() : $im->product_available_date,
                        'pordering' => $im->pordering,
                    ];

                    $price = DB::table('joom_virtuemart_product_prices')->where('virtuemart_product_id', $im->virtuemart_product_id)
                        ->where('joom_virtuemart_product_prices.virtuemart_shoppergroup_id', 0)->first();

                    if ($price) {
                        $data = array_merge($data, [
                            'old_price' => $price->product_price,
                            'price' => $price->product_override_price ?: $price->product_price,
                        ]);
                    }

                    try {
                        $product->offers()->withTrashed()->firstOrCreate([
                            'id' => $im->virtuemart_product_id,
                        ], $data);
                    } catch (\Throwable $e) {
                        dump($e->getMessage());
                        continue;
                    }
                }
            }
        }
    }
}
