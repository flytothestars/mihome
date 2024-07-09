<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageTizer;
use App\Models\Page;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Models\PromotionType;
use Meilisearch\Endpoints\Indexes;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Cache::rememberForever(App::getLocale() . '.pages', function () {
            $pages = Page::all();
            return PageTizer::collection($pages)->resolve();
        });

        $data = [
            'pages' => $pages
        ];

        return view('pages.index', $data);
    }

    public function whatsappPage()
    {
        return view('pages.whatsapp');
    }

    public function obratnyjZvonokPage()
    {
        return view('pages.obratnyj-zvonok');
    }

    public function kreditPage()
    {
        return view('pages.kredit');
    }

    public function bystryjZakazPage()
    {
        return view('pages.bystryj-zakaz');
    }

    public function wholesalePage()
    {
        return view('pages.wholesale');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Page $page)
    {
        $sArr = [
            'href="/search"'  => 'href="/search" x-on:click.prevent="searching=true"',
            'href="/store"'  => 'href="/store" x-on:click.prevent="catalogShow=true"',
        ];

        $text = $page->getTranslatedAttribute('fulltext');

        $data = [
            'page' => $page,
            'fulltext' => str_replace(array_keys($sArr), array_values($sArr), (string)$text)
        ];

        if ($page->alias === 'skidki') {
            $data['promotions'] = Promotion::orderBy('order')
                ->where('active_to', '>', now())
                ->where('active_from', '<', now())
                ->get();
            // dd($data);
            $data['ptypes'] = PromotionType::all();
        }
        if ($page->alias == 'xiaomi-chernaya-pyatnitsa-2023') {
            $data['products'] = Product::search(
                '',
                function (Indexes $meiliSearch, string $query, array $options) {
                    $options['sort'] = ['in_stock:desc'];
                    // $options['limit'] = 24;
                    $options['filter'] = 'discount > 0';
                    return $meiliSearch->search($query, $options);
                }
            )->get();
            $data['infiltrable'] = true;
        }

        View::share('meta_title', $page->getTranslatedAttribute('title'));
        $page->getTranslatedAttribute('metadesc') && View::share('meta_description', $page->getTranslatedAttribute('metadesc'));

        if ($page->alias === 'kontakty') return view('pages.kontakty', $data);
        return view('pages.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
