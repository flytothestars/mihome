<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\App;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route(App::getLocale() . '.home'));
});

// Home > store
Breadcrumbs::for('store', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('shop.allgoods'), route(App::getLocale() . '.store'));
});

// Home > store > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category = null, $filters = null, $filter = null) {
    $trail->parent('store');
    if ($category) {
        foreach ($category->ancestors->reverse() as $ancestor) {
            $trail->push($ancestor->getTranslatedAttribute('name'), $ancestor->url);
        }
        $trail->push($category->getTranslatedAttribute('name'), $category->url);
    }
    $url = ($category ? $category->url : 'no-category') . '/filter';
    foreach ($filter as $key => $fff) {
        if (isset($filters[$key])) {
            $fs = array_filter($filters[$key], function ($el) use ($fff) {
                return in_array($el['value'], $fff);
            });
            $values = array_map(function ($el) {
                return $el['value'];
            }, $fs);
            $labels = array_map(function ($el) {
                return $el['label'];
            }, $fs);
            $url .= '/' . implode('_or_', $values);
            $trail->push(implode(', ', $labels), $url);
        }
    }
});

// Home > store > [Category] > [Product]
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $product, $offer = null) {
    $trail->parent('store');
    if ($product->category) {
        foreach ($product->category->ancestors->reverse() as $ancestor) {
            $trail->push($ancestor->getTranslatedAttribute('name'), $ancestor->url);
        }
        $trail->push($product->category->getTranslatedAttribute('name'), $product->category->url);
        $trail->push($offer ? $offer->getTranslatedAttribute('name') : $product->getTranslatedAttribute('name'), $product->url);
    }
});
