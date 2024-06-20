<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category as ResourcesCategory;
use App\Http\Resources\CategoryTizer;
use App\Http\Resources\FooterInfo as ResourcesFooterInfo;
use App\Http\Resources\Property as ResourcesProperty;
use App\Models\Adv;
use App\Models\Category;
use App\Models\FooterAdv;
use App\Models\FooterInfo;
use App\Models\Property;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\Schema;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function callAction($method, $parameters)
    {
        View::share(
            'shemaOrganization',
            Schema::organization()
                ->name('Магазин Xiaomi (Mi Home)')
                ->url("https://mi-home.kz/")
                ->logo("https://mi-home.kz/images/oneplus-logo-new-s.svg")
        );

        View::share('shemaBreadCumbs', '');

        $advs = [];
        if (!request()->is('/') && request()->is('/cart')) {
            $advs = DB::table('advs')->where(function (Builder $query) {
                $query->where('include', !0);
                $query->whereRaw('"' . request()->fullUrl() . '" LIKE CONCAT("%", url ,"%")');
            })->orWhere(function (Builder $query) {
                $query->where('include', !1);
                $query->whereRaw('"' . request()->fullUrl() . '" NOT LIKE CONCAT("%", url ,"%")');
            })->pluck('id');
            $advs = Adv::whereIn('id', $advs)->limit(3)->get();
        }
        View::share('advs', $advs);

        // Cache::flush();
        View::share('meta_title', setting('site.title-' . app()->getLocale()));
        View::share('meta_description', setting('site.description-' . app()->getLocale()));

        View::share('footer_contacts', setting('site.footer-contacts-' . app()->getLocale()));
        View::share('footer_req', setting('site.footer-req-' . app()->getLocale()));

        $categories = Cache::rememberForever(App::getLocale() . '.categories', function () {
            $categories =  Category::published()->whereNot('slug', 'featured')->orderBy('order')->get()->toTree();
            return ResourcesCategory::collection($categories)->resolve();
        });
        View::share('categories', $categories);

        $catalog = Cache::rememberForever(App::getLocale() . '.catalog', function () {
            $catalog =  Category::published()->whereNot('slug', 'featured')->orderBy('order')->get()->toTree();
            return CategoryTizer::collection($catalog)->resolve();
        });
        View::share('catalog', $catalog);

        $properties = Cache::rememberForever(App::getLocale() . '.properties', function () {
            $properties =  Property::with('values')->get();
            return ResourcesProperty::collection($properties)->resolve();
        });
        View::share('properties', $properties);

        $footerInfos = Cache::rememberForever(App::getLocale() . '.footerInfos', function () {
            $footerInfos =  FooterInfo::all();
            $footerInfos->load('translations');
            return ResourcesFooterInfo::collection($footerInfos)->resolve();
        });
        View::share('footer_infos', $footerInfos);

        $footerAdvs = Cache::rememberForever(App::getLocale() . '.footerAdvs', function () {
            $footerAdvs =  FooterAdv::all();
            $footerAdvs->load('translations');
            return ResourcesFooterInfo::collection($footerAdvs)->resolve();
        });
        View::share('footer_advs', $footerAdvs);

        return parent::callAction($method, $parameters);
    }
}
