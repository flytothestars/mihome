<x-app-layout>
    @php
        $videoreviews = json_decode($product->videoreviews);
    @endphp
    <div class="container">
        {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('product', $product, $offer) }}
    </div>
    {!! $shemaProduct !!}
    <div x-data="product({{ $product->id }})">
        <div class="sticky top-16 lg:top-16 z-20 bg-white border-b xl:mb-8">
            @include('store.product._nav')
        </div>
        <div class="" style="width: 100%;margin-right: auto;margin-left: auto;">
            <a class="relative -top-40" id="main"></a>
            <div class="flex gap-6 mb-5 mt-5 flex-col lg:flex-row">
                @include('store.product._slider')
                <div class="grow">
                    <h1 class="font-bold text-xl lg:text-2xl border-l-4 border-green-600 pl-2 mb-3 lg:mb-5">
                        {!! $offer ? $offer->getTranslatedAttribute('name') : $product->getTranslatedAttribute('name') !!}</h1>
                    @include('store.product._top')
                    @include('store.product._price')
                    @include('store.product._delivery')
                    @include('store.product._offers')
                    @include('store.product._buttons')
                </div>
                @include('store.product._sidebar')
            </div>

            <div class="flex gap-6 my-5 flex-col lg:flex-row">
                <div class="lg:w-[calc(100%-17.5rem)] xl:w-[calc(100%-32rem)] shrink-0">
                    <div class="my-12">
                        <a class="relative -top-40" id="description"></a>
                        <div class="uk-h3 uk-heading-bullet uk-margin uk-visible@m">
                            Описание товара
                        </div>
                        <div class="relative">
                            @if (!empty($product->body))
                                {!! $product->getTranslatedAttribute('body') !!}
                            @else
                                <div>Эта часть описания скоро будет добавлена</div>
                            @endif
                        </div>
                    </div>
                    <div class="my-12">
                        <a class="relative -top-40" id="characteristics"></a>
                        <h6 class="font-bold text-2xl">Характеристики</h6>
                        <div class="relative">
                            @if (!empty($product->characteristics))
                                {!! $product->getTranslatedAttribute('characteristics') !!}
                            @else
                                <div class="">Эта часть описания скоро будет добавлена</div>
                            @endif
                        </div>
                    </div>
                    <div class="my-12">
                        <a class="relative -top-40" id="video"></a>
                        <h6 class="font-bold text-2xl">Видеообзор</h6>
                        <div class="relative">
                            @if (!empty($product->videoreviews))
                                @php
                                    $videoreviews = json_decode($product->videoreviews);
                                @endphp
                                @foreach ($videoreviews as $key => $videoreview)
                                    @php
                                        $regex =
                                            '%(?:^youtube=|youtu\.be/?|youtube\.com/embed/?|youtube\.com\/watch\?v=)(?<id>[^/&\?]+)(?:\?|&amp;|&)?(?<query>.*)$%';

                                        if (preg_match($regex, trim($videoreview), $match)) {
                                            $videoreview = 'https://www.youtube.com/embed/' . $match['id'];
                                            $videoreview .= '?wmode=transparent';
                                            if ($match['query']) {
                                                $videoreview .= 'query=' . $match['query'];
                                            }
                                        }

                                    @endphp

                                    <a data-modals href="{{ $videoreview }}" rel="nofollow" data-modals-height="100%"
                                        data-modals-width="100%" data-modals-group="modalvideo"
                                        data-modals-navigation="true">
                                        <div class="uk-inline uk-width-1-1 {{ $key ? 'uk-hidden' : 'uk-visible' }}">
                                            @if (!empty($product->webp) && ($image = $product->webp[0]))
                                                @if ($image)
                                                    <picture>
                                                        <source type="image/webp" srcset="{{ $image[0] }} 732w"
                                                            sizes="(min-width: 732px) 732px">
                                                        <img class="uk-hidden@m" src="{{ $image[0] }}"
                                                            width="732" height="862" alt loading="lazy">
                                                    </picture>
                                                    <div style="height: 100px; background: url({{ $image[0] }}); background-position: center; background-size: cover;"
                                                        class="uk-visible@m"></div>
                                                @endif
                                            @endif
                                            <div class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle"
                                                style="padding: 20px;">
                                                <div class="uk-grid-small uk-child-width-expand@s uk-flex-middle uk-text-center uk-flex-center uk-text-left@m uk-dark"
                                                    uk-grid>
                                                    <div class="uk-width-auto">
                                                        <span uk-icon="icon: youtube; ratio: 2"
                                                            style="color: red;"></span>
                                                    </div>
                                                    <div>Видео<span class="uk-visible@m">обзор
                                                            на
                                                            {!! $product->getTranslatedAttribute('name') !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div>Эта часть описания скоро будет добавлена</h6>
                            @endif
                        </div>
                    </div>
                    @if (!empty($product->instruction))
                        <div class="my-12">
                            <a class="relative -top-40" id="instruction"></a>
                            <h6 class="font-bold text-2xl">Инструкция</h6>
                            <div class="relative">
                                {!! $product->getTranslatedAttribute('instruction') !!}
                            </div>
                        </div>
                    @endif
                    <div class="my-12">
                        <a class="relative -top-40" id="reviews"></a>
                        <div class="relative">
                            @include('store/product/_reviews')
                        </div>
                    </div>
                </div>
                <div class="grow">
                    @include('store.product._videoreviews')
                    @include('store.product._relatedproducts')
                    @include('store.product._populars')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
