<x-app-layout>
    <div x-data="page">
        <div class="container">
            <h1 class="uk-heading-line text-center text-2xl lg:text-4xl mb-5">
                {{ $page->getTranslatedAttribute('title') }}</h1>
        </div>
        @if ($page->webp)
            <div class="container relative">
                <a class="swiper-prev absolute top-1/2 -translate-y-full left-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#" uk-slidenav-previous="" uk-slideshow-item="previous" role="button"
                    aria-controls="uk-slideshow-1" aria-label="Previous slide">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                        </polyline>
                    </svg>
                </a>
                <div class="swiper my-5" x-ref="banners">
                    <div class="swiper-wrapper">
                        @foreach ($page->webp as $image)
                            <div class="swiper-slide">
                                <a data-fancybox href="{{ isset($image[0]) ? $image[0] : '' }}">
                                    <img class="w-full" src="{{ isset($image[0]) ? $image[0] : '' }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a class="swiper-next absolute top-1/2 -translate-y-full right-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#" uk-slidenav-previous="" uk-slideshow-item="previous" role="button"
                    aria-controls="uk-slideshow-1" aria-label="Previous slide">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                        </polyline>
                    </svg>
                </a>
                <div class="swiper-pagination relative"></div>
            </div>
        @endif
        <div class="container">
            <div class="prose max-w-none">
                {!! $fulltext !!}
            </div>
        </div>
        @if (isset($promotions) && isset($ptypes))
            <div class="container my-5" x-data='promotions({!! json_encode(\App\Http\Resources\PromotionType::collection($ptypes), JSON_UNESCAPED_UNICODE) !!})'>
                <ul class="m-0 p-0 mb-5 flex gap-2.5 items-center justify-center flex-wrap text-sm">
                    <li class="rounded py-0.5 px-1.5 "
                        :class="!ptype ? 'bg-green-400 text-white' : 'bg-gray-200 hover:bg-gray-300'">
                        <a class="subnavstyle" href="#" role="button" x-on:click.prevent="ptype=null">Все</a>
                    </li>
                    <template x-for="(t,cdx) in ptypes">
                        <li class="rounded py-0.5 px-1.5 "
                            :class="ptype && ptype.id === t.id ? 'bg-green-400 text-white' :
                                'bg-gray-200 hover:bg-gray-300'">
                            <a class="subnavstyle" href="#" x-on:click.prevent="ptype=t" role="button"
                                x-text="t.title.replace(/xiaomi/ig, '')"></a>
                        </li>
                    </template>
                </ul>
                <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-2.5">
                    @foreach ($promotions as $tizer)
                        @include('promotions._tizer')
                    @endforeach
                </div>
            </div>
        @endif
        @if (isset($products))
            <div class="container my-5" x-data="products">
                <ul class="m-0 p-0 mb-5 flex gap-2.5 items-center justify-center flex-wrap text-sm">
                    <li class="rounded py-0.5 px-1.5 "
                        :class="!category ? 'bg-green-400 text-white' : 'bg-gray-200 hover:bg-gray-300'">
                        <a class="subnavstyle" href="#" role="button" x-on:click.prevent="category=null">Все
                            товары</a>
                    </li>
                    <template x-for="(cat,cdx) in categories">
                        <li class="rounded py-0.5 px-1.5 "
                            :class="category && category.slug === cat.slug ? 'bg-green-400 text-white' :
                                'bg-gray-200 hover:bg-gray-300'">
                            <a class="subnavstyle" href="#" x-on:click.prevent="category=cat" role="button"
                                x-text="cat.name.replace(/xiaomi/ig, '')"></a>
                        </li>
                    </template>
                </ul>
                <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-2.5">
                    @foreach ($products as $tizer)
                        @include('store._tizer')
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
