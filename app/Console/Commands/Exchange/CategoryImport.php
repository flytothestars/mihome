<?php

namespace App\Console\Commands\Exchange;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CategoryImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:category-import';

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
        //id, order, published, name, slug, image, description, meta_desc, meta_title, _lft, _rgt, parent_id, created_at, updated_at, icon
        foreach (DB::table('joom_virtuemart_categories')
            ->leftJoin('joom_virtuemart_categories_ru_ru', 'joom_virtuemart_categories.virtuemart_category_id', '=', 'joom_virtuemart_categories_ru_ru.virtuemart_category_id')
            ->leftJoin('joom_virtuemart_category_medias', 'joom_virtuemart_category_medias.virtuemart_category_id', '=', 'joom_virtuemart_categories.virtuemart_category_id')
            ->leftJoin('joom_virtuemart_medias', 'joom_virtuemart_medias.virtuemart_media_id', '=', 'joom_virtuemart_category_medias.virtuemart_media_id')
            ->where('category_parent_id', 0)
            ->select([
                'joom_virtuemart_categories.virtuemart_category_id',
                'joom_virtuemart_categories.ordering',
                'joom_virtuemart_categories.published',
                'joom_virtuemart_categories_ru_ru.category_name',
                'joom_virtuemart_categories_ru_ru.slug',
                'joom_virtuemart_medias.file_url',
                'joom_virtuemart_categories_ru_ru.category_description',
                'joom_virtuemart_categories_ru_ru.metadesc',
                'joom_virtuemart_categories_ru_ru.customtitle',
                'joom_virtuemart_categories.category_parent_id',
            ])
            ->get() as $cat) {
            if (!$cat->category_name) dd($cat);
            $data = [
                'order' => $cat->ordering,
                'published' => $cat->published,
                'name' => $cat->category_name,
                'slug' => $cat->slug,
                'image' => str_replace('images/virtuemart/category', 'images/categories', $cat->file_url),
                'description' => $cat->category_description,
                'meta_desc' => $cat->metadesc,
                'meta_title' => $cat->customtitle,
                'parent_id' => $cat->category_parent_id
            ];
            $category = Category::firstOrCreate([
                'id' => $cat->virtuemart_category_id,
            ], $data);
            if (!$category->wasRecentlyCreated) {
                $category->update($data);
            }
        }
        foreach (DB::table('joom_virtuemart_categories')
            ->leftJoin('joom_virtuemart_categories_ru_ru', 'joom_virtuemart_categories.virtuemart_category_id', '=', 'joom_virtuemart_categories_ru_ru.virtuemart_category_id')
            ->leftJoin('joom_virtuemart_category_medias', 'joom_virtuemart_category_medias.virtuemart_category_id', '=', 'joom_virtuemart_categories.virtuemart_category_id')
            ->leftJoin('joom_virtuemart_medias', 'joom_virtuemart_medias.virtuemart_media_id', '=', 'joom_virtuemart_category_medias.virtuemart_media_id')
            ->whereNot('category_parent_id', 0)
            ->select([
                'joom_virtuemart_categories.virtuemart_category_id',
                'joom_virtuemart_categories.ordering',
                'joom_virtuemart_categories.published',
                'joom_virtuemart_categories_ru_ru.category_name',
                'joom_virtuemart_categories_ru_ru.slug',
                'joom_virtuemart_medias.file_url',
                'joom_virtuemart_categories_ru_ru.category_description',
                'joom_virtuemart_categories_ru_ru.metadesc',
                'joom_virtuemart_categories_ru_ru.customtitle',
                'joom_virtuemart_categories.category_parent_id',
            ])
            ->get() as $cat) {
            $data = [
                'order' => $cat->ordering,
                'published' => $cat->published,
                'name' => $cat->category_name,
                'slug' => $cat->slug,
                'image' => str_replace('images/virtuemart/category', 'images/categories', $cat->file_url),
                'description' => $cat->category_description,
                'meta_desc' => $cat->metadesc,
                'meta_title' => $cat->customtitle,
                'parent_id' => $cat->category_parent_id
            ];
            $category = Category::firstOrCreate([
                'id' => $cat->virtuemart_category_id,
            ], $data);
            if (!$category->wasRecentlyCreated) {
                $category->update($data);
            }
        }
        Category::fixTree();
    }
}
