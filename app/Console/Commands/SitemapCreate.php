<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Services\Combinations;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class SitemapCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function values($values, &$return = [])
    {
        for ($i = count($values) - 1; $i > 0; --$i) {
            foreach (new Combinations($values, $i) as $substring) $return[] = $substring;
        }
        return $return;
    }

    public function clue($vals, $level = -1, &$array = [], &$url = [])
    {
        ++$level;
        foreach ($vals[$level] as $v) {
            $url[$level] = $v;
            if (count($vals) - 1 === $level) $array[] = implode("/", $url);
            else $this->clue($vals, $level, $array, $url);
        }
        return $array;
    }


    public function filters($arr, &$return = [])
    {
        $slugs = [];
        for ($i = count($arr); $i > 0; --$i) {
            foreach (new Combinations(array_keys($arr), $i) as $substring) $slugs[] = $substring;
        }
        foreach ($slugs as $sl) {
            $vals = [];
            foreach ($sl as $k => $slug) {
                $values = $this->values(array_map(function ($el) {
                    return $el['value'];
                }, $arr[$slug]));
                $values = array_map(function ($el) {
                    return implode('_or_', $el);
                }, $values);
                $vals[$k] = $values;
            }
            $df = $this->clue($vals);
            $return = array_merge($return, $df);
        }
        return $return;
    }

    public function handle()
    {
        $sitemapIndex = SitemapIndex::create();
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create(route('ru.home'))
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1));

        foreach (Category::all() as $category) {
            $sitemap->add(Url::create($category->url)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1));
        }

        $sitemap->writeToFile(public_path('categories_sitemap.xml'));
        $sitemapIndex->add('/categories_sitemap.xml');

        $cnt = 0;
        $key = 0;
        $sitemap = Sitemap::create();
        foreach (Category::all() as $category) {
            if ($category->slug !== 'lighting-and-lamps') continue;
            $catfilters = $category->filters;
            if (empty($catfilters)) continue;
            $arrFilters = $this->filters($catfilters);
            foreach ($arrFilters as $arrFilter) {
                ++$cnt;
                $sitemap->add(Url::create($category->url . '/filter/' . $arrFilter)
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.1));
                if ($cnt >= 1000) {
                    $sitemap->writeToFile(public_path("filters_{$key}_sitemap.xml"));
                    $sitemapIndex->add("filters_{$key}_sitemap.xml");
                    ++$key;
                    $cnt = 0;
                    $sitemap = Sitemap::create();
                }
            }
            die;
        }
        $sitemap->writeToFile(public_path("filters_{$key}_sitemap.xml"));
        $sitemapIndex->add("filters_{$key}_sitemap.xml");

        $sitemap = Sitemap::create();

        foreach (Product::all() as $product) {
            $sitemap->add(Url::create($product->url)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1));
        }

        $sitemap->writeToFile(public_path('products_sitemap.xml'));
        $sitemapIndex->add('/products_sitemap.xml');

        $sitemap = Sitemap::create();

        foreach (Offer::all() as $offer) {
            $sitemap->add(Url::create($offer->url)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1));
        }

        $sitemap->writeToFile(public_path('offers_sitemap.xml'));
        $sitemapIndex->add('/offers_sitemap.xml');

        $sitemapIndex->writeToFile(public_path('sitemap.xml'));
    }
}
