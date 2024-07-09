<x-app-layout>
    <div class="" x-data="home">
        <section class="container lg:mb-16">
            <div class="xl:flex xl:gap-4">
                <div class="">
                    <div class="grid-cols-3 w-[22rem] hidden xl:grid gap-2.5 shrink-0">
                        @foreach ($promotions as $promotion)
                            {{-- @dump($promotion); --}}
                            <div class="overflow-hidden">
                                <div class="break-words rounded-lg overflow-hidden">
                                    <a class="relative block no-underline group rounded-lg" href="{{ $promotion->link }}">
                                        @if (!empty($promotion->webp))
                                            <picture class="">
                                                <source type="image/webp"
                                                    srcset="{{ $promotion->webp[1] }} 256w, {{ $promotion->webp[2] }} 500w"
                                                    sizes="(min-width: 256px) 256px">
                                                <img loading="lazy" class="w-full transition duration-1000"
                                                    src="{{ $promotion->webp[2] }}" alt="">
                                            </picture>
                                        @endif
                                        <div
                                            class="opacity-0 group-hover:opacity-100 transition duration-300 absolute top-0 left-0 right-0 bottom-0 font-medium text-sm text-center bg-[rgba(58,71,114,.8)] text-white flex items-center justify-center">
                                            <div class="p-4 max-w-full">{{ $promotion->title }}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="xl:grow xl:max-w-[calc(100%-23rem)] relative flex flex-col">
                    <a class="swiper-prev absolute top-1/2 -translate-y-full left-6 z-10 hidden lg:flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                        href="#">
                        <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                            <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                            </polyline>
                        </svg>
                    </a>
                    <div class="relative lg:rounded-lg overflow-hidden grow">
                        <div class="swiper h-full" x-ref="banners">
                            <div class="swiper-wrapper pb-4">
                                @foreach ($banners as $banner)
                                    <div class="swiper-slide">
                                        <a href="{{ $banner['link'] }}" class="block h-full min-h-[26.5rem] bg-cover bg-center"
                                            style="background-image:url('{{ isset($banner['webp'][0]) ? $banner['webp'][0] : '' }}')">
                                            <img class="w-full xl:hidden"
                                                src="{{ isset($banner['webp'][0]) ? $banner['webp'][0] : '' }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <a class="swiper-next absolute top-1/2 -translate-y-full right-6 z-10 hidden lg:flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                        href="#">
                        <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                            <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                            </polyline>
                        </svg>
                    </a>
                    <div class="swiper-pagination hidden lg:block" style="bottom:-2rem"></div>
                </div>

            </div>
        </section>
        <section class="container mb-5 lg:mt-5">
            <div class="text-2xl mb-5 font-bold text-center uk-heading-line text-gray-500"> <span>Популярные
                    товары</span> </div>
            <ul class="m-0 p-0 mb-5 flex gap-2.5 items-center justify-center flex-wrap text-sm">
                <li class="rounded py-0.5 px-1.5 btn-all pt-2"
                    :class="!popularCategory ? 'bg-green-400 text-white' : 'bg-gray-200 hover:bg-gray-300'">
                    <a class="subnavstyle" href="#" role="button" x-on:click.prevent="popularCategory=null">Все
                        товары</a>
                </li>
                <template x-for="(cat,cdx) in popularCategories">
                    <li class="rounded py-0.5 px-1.5 btn-all pt-2"
                        :class="popularCategory && popularCategory.slug === cat.slug ? 'bg-green-400 text-white' :
                            'bg-gray-200 hover:bg-gray-300'">
                        <a class="subnavstyle" href="#" x-on:click.prevent="popularCategory=cat" role="button"
                            x-text="cat.name.replace(/xiaomi/ig, '')"></a>
                    </li>
                </template>
            </ul>

            <div class="relative">
                <a class="swiper-prev2 absolute top-1/2 -translate-y-full -left-2 lg:left-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                        </polyline>
                    </svg>
                </a>
                <div class="relative rounded-lg overflow-hidden grow">
                    <div class="swiper h-full" x-ref="populars">
                        <div class="swiper-wrapper pb-4">
                            <template x-for="(tizer,tdx) in popularsFiltered">
                                <div class="swiper-slide">
                                    @include('store._tizerjs')
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <a class="swiper-next2 absolute top-1/2 -translate-y-full -right-2 lg:right-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                        </polyline>
                    </svg>
                </a>
            </div>
        </section>

        <section class="container my-5">
            <div class="text-2xl mb-5 font-bold text-center uk-heading-line text-gray-500"> <span>Наши
                    преимущества</span> </div>
            <div class="relative">
                <a class="swiper-prev3 absolute top-1/2 -translate-y-full left-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                        </polyline>
                    </svg>
                </a>
                <div class="relative rounded-lg overflow-hidden grow">
                    <div class="swiper h-full" x-ref="advantages">
                        <div class="swiper-wrapper py-4">
                            @foreach ($advantages as $tizer)
                                <div class="swiper-slide text-center">
                                    <a href="{{ $tizer->link }}"
                                        class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-remove-first-child uk-link-toggle"
                                        href="{{ $tizer->link }}">
                                        <img src="{{ Voyager::image($tizer->image) }}" alt=""
                                            class="mx-auto" />
                                        <h3 class="el-title uk-card-title uk-margin-top uk-margin-remove-bottom">
                                            {{ $tizer->title }} </h3>
                                        <div class="el-meta uk-text-lead uk-text-primary uk-margin-top">
                                            {{ $tizer->intro }}</div>
                                        <div class="el-content uk-panel uk-margin-top min-h-[2.75rem]">
                                            {{ $tizer->text }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a class="swiper-next3 absolute top-1/2 -translate-y-full right-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                        </polyline>
                    </svg>
                </a>
            </div>
        </section>


        <section class="container my-5">
            <div class="text-2xl mb-5 font-bold text-center uk-heading-line text-gray-500"> <span>Наши любимые
                    товары</span> </div>

            @foreach ($favorites as $key => $favorite)
                <div class="my-5">
                    <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-3">

                        <a class="col-span-2 lg:col-span-1 flex items-center justify-center bg-gray-100 bg-no-repeat bg-center bg-cover p-6 mb-4 rounded-lg"
                            style="background-image:url('{{ Storage::url($favorite->category->image) }}')"
                            href="{{ $favorite->category->url }}">
                            <div class="bg-white bg-opacity-30 text-center p-4">
                                <div class="mt-5 font-semibold text-lg">{{ $favorite->category->name }}</div>
                                <div class="uk-margin-top">
                                    <div class="bg-white py-3 px-4">Все товары</div>
                                </div>
                            </div>
                        </a>
                        <div
                            class="relative col-span-2 @if ($favorite->product) lg:col-span-2 xl:col-span-4 @else lg:col-span-3 xl:col-span-5 @endif ">
                            <a class="{{ 'swiper-prev-favorite-' . $key }} absolute top-1/2 -translate-y-full -left-2 lg:left-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                                href="#">
                                <svg width="14" height="24" viewBox="0 0 14 24"
                                    class="-translate-x-px stroke-green-500">
                                    <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                                    </polyline>
                                </svg>
                            </a>
                            <div class="relative rounded-lg overflow-hidden grow">
                                <div class="swiper h-full @if ($favorite->product) with-product @endif "
                                    x-ref="favorites[{{ $key }}]">
                                    <div class="swiper-wrapper pb-4">
                                        @foreach ($favorite->category->products()->limit(20)->get() as $tizer)
                                            <div class="swiper-slide">
                                                @include('store._tizer')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <a class="{{ 'swiper-next-favorite-' . $key }} absolute top-1/2 -translate-y-full -right-2 lg:right-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                                href="#">
                                <svg width="14" height="24" viewBox="0 0 14 24"
                                    class="translate-x-px stroke-green-500">
                                    <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                                    </polyline>
                                </svg>
                            </a>
                        </div>
                        @if ($tizer = $favorite->product)
                            <div class="col-span-2 lg:col-span-1 hidden lg:block">
                                @include('store._tizer')
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </section>


        <section class="container my-5">
            <div class="text-2xl mb-5 font-bold text-center uk-heading-line text-gray-500"> <span>Новинки на
                    сайте</span> </div>
            <div class="relative">
                <a class="swiper-prev-latest absolute top-1/2 -translate-y-full -left-2 lg:left-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                        </polyline>
                    </svg>
                </a>
                <div class="relative rounded-lg overflow-hidden grow">
                    <div class="swiper h-full" x-ref="latests">
                        <div class="swiper-wrapper pb-4">
                            @foreach ($latests as $tizer)
                                <div class="swiper-slide">
                                    @include('store._tizer')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a class="swiper-next-latest absolute top-1/2 -translate-y-full -right-2 lg:right-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                        </polyline>
                    </svg>
                </a>
            </div>
        </section>

    </div>
</x-app-layout>
