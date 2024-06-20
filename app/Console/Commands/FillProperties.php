<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FillProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-properties';

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
        foreach (DB::table('joom_virtuemart_customs')
            ->get() as $customfield) {
            if ($customfield->custom_title === 'Характеристики') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    if ($product) {
                        $product->characteristics = $customfieldvalue->customfield_params;
                        $product->saveQuietly();
                    }
                }
            } elseif ($customfield->custom_title === 'Модель') {
                // ---------------------------
            } elseif ($customfield->custom_title === 'Оптовые продажи') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    if ($product) {
                        $product->wholesale = $customfieldvalue->customfield_params;
                        $product->saveQuietly();
                    }
                }
            } elseif ($customfield->custom_title === 'Инструкция') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    if ($product) {
                        $product->instruction = $customfieldvalue->customfield_params;
                        $product->saveQuietly();
                    }
                }
            } elseif ($customfield->custom_title === 'Видео') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    if ($customfieldvalue->customfield_params) {
                        if ($customfieldvalue->customfield_params) {
                            $product = Product::find($customfieldvalue->virtuemart_product_id);
                            if ($product) {
                                $regex =
                                    '%src="([^"]+)"%';
                                $regex2 =
                                    '%modal url="([^"]+)"%';
                                if (preg_match($regex, trim($customfieldvalue->customfield_params), $match) || preg_match($regex2, trim($customfieldvalue->customfield_params), $match2)) {
                                    if (count($match) > 1)
                                        $videoreview = $match[1];
                                    elseif (count($match2) > 1) {
                                        $videoreview = $match2[1];
                                    }
                                    if ($videoreview) {
                                        $videoreviews = json_decode($product->videoreviews);
                                        if (!is_array($videoreviews) || !in_array($videoreview, $videoreviews)) {
                                            $videoreviews[] = $videoreview;
                                            $product->videoreviews = json_encode($videoreviews);
                                            $product->saveQuietly();
                                        }
                                    } else {
                                        dump($customfieldvalue->customfield_params);
                                    }
                                }
                            }
                        }
                    }
                }
            } elseif ($customfield->custom_title === 'Текстовый стикер') {
                // ---------------------------
            } elseif ($customfield->custom_title === 'Стикер картинка') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    $media = DB::table('joom_virtuemart_medias')->where('virtuemart_media_id', $customfieldvalue->customfield_value)
                        ->first();
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    if ($product) {
                        $product->sticker = str_replace("images/virtuemart/product/", "products/", $media->file_url);
                        $product->saveQuietly();
                    }
                }
            } elseif ($customfield->custom_title === 'Видеообзор') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    if ($product && $customfieldvalue->customfield_value) {
                        $videoreviews = json_decode($product->videoreviews);
                        if (!is_array($videoreviews) || !in_array($customfieldvalue->customfield_value, $videoreviews)) {
                            $videoreviews[] = $customfieldvalue->customfield_value;
                            $product->videoreviews = json_encode($videoreviews);
                            $product->saveQuietly();
                        }
                    }
                }
            } elseif ($customfield->custom_title === 'COM_VIRTUEMART_RELATED_CATEGORIES') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    $related = Category::find($customfieldvalue->customfield_value);
                    if ($product && $related) $product->relatedCategories()->syncWithoutDetaching($related->id);
                }
            } elseif ($customfield->custom_title === 'COM_VIRTUEMART_RELATED_PRODUCTS') {
                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $customfield->virtuemart_custom_id)
                    ->get() as $customfieldvalue) {
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    $related = Product::find($customfieldvalue->customfield_value);
                    if ($product && $related) $product->relatedProducts()->syncWithoutDetaching($related->id);
                }
            } elseif ($customfield->is_list) {
                $property = Property::updateOrCreate([
                    'id' => $customfield->virtuemart_custom_id
                ], [
                    'title' => $customfield->custom_title,
                    'slug' => Str::slug($customfield->custom_title)
                ]);

                foreach (explode(";", $customfield->custom_value) as $value) {
                    if ($value) {
                        $propertyValue = $property->values()->updateOrCreate([
                            'title' => $value,
                        ]);
                    }
                }

                foreach (DB::table('joom_virtuemart_product_customfields')->where('virtuemart_custom_id', $property->id)
                    ->get() as $customfieldvalue) {
                    $product = Product::find($customfieldvalue->virtuemart_product_id);
                    if ($product) {
                        $propertyValue = $property->values()->where('title', $customfieldvalue->customfield_value)->first();
                        if ($propertyValue) $product->propertyValues()->syncWithoutDetaching([$propertyValue->id]);
                    }
                }
            }
        }
    }
}
