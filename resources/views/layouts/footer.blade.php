<footer class="text-bm font-light">
    <div class="container">

        @if(isset($viewedProduct))
        <div class="text-2xl mb-5 font-bold text-center uk-heading-line text-gray-500">
            <span>Недавно просмотренные товары</span>
        </div>
        <div class="relative">
            <a class="swiper-prevfooter absolute top-1/2 -translate-y-full -left-2 lg:left-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                href="#">
                <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                    <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                    </polyline>
                </svg>
            </a>
            <div class="relative rounded-lg overflow-hidden grow">
                <div class="swiper4  h-full" x-ref="footers">
                    <div class="swiper-wrapper pb-4">
                        @foreach($viewedProduct as $tizer)
                        <div class="swiper-slide">
                            <div class="flex flex-col bg-white rounded-lg overflow-hidden shadow-lg"
                                @if(isset($infiltrable) && $tizer->product->category) x-show="!category || category.id==={{
                                $tizer->product->category->id }}"
                                x-init="categories && categories.find(el => el.id === {{ $tizer->product->category->id
                                }}) || categories.push({
                                id: {{ $tizer->product->category->id }},
                                name: '{{ $tizer->product->category->name }}',
                                slug: '{{ $tizer->product->category->slug }}'
                                })" @endif>
                                <div class="relative flex">
                                    <div
                                        class="absolute w-full p-2 flex flex-wrap gap-2 text-xs text-white -translate-x-1/2 left-1/2 whitespace-nowrap">
                                        @if ($tizer->product->kaspi && $tizer->product->in_stock)
                                        <span class="rounded bg-red-400 px-1 py-0.5">0-0-12</span>
                                        @endif
                                        @if ($tizer->product->old_price && $tizer->product->price &&
                                        $tizer->product->price < $tizer->product->old_price)
                                            <span class="rounded bg-yellow-500 px-1 py-0.5">{{
                                                round(($tizer->product->price / $tizer->product->old_price - 1) * 100) .
                                                '%' }}</span>
                                            @elseif(!$tizer->product->in_stock && $tizer->product->pre_order)
                                            <span class="rounded bg-yellow-500 px-1 py-0.5">Ожидаем через
                                                {{ intval($tizer->product->pre_order) }} дн.</span>
                                            @endif
                                            @if ($tizer->product->discount && $tizer->product->discount)
                                            <span class="rounded bg-yellow-400 px-1 py-0.5">-{{
                                                $tizer->product->discount }}%</span>
                                            @endif
                                            @if ($tizer->product->rating)
                                            <span class="rounded bg-green-350 px-1 py-0.5">⭐ {{ $tizer->product->rating
                                                }} /
                                                {{ $tizer->product->ratingcount }}</span>
                                            @else
                                            <span class="rounded bg-green-350 px-1 py-0.5">Новинка</span>
                                            @endif
                                    </div>
                                    <a href="{{ $tizer->product->url }}"
                                        class="bg-slate-100 w-full block pt-[117.5%] bg-cover bg-center"
                                        style="background-image:url('{{ $tizer->product->images && $tizer->product->images->count() ? Voyager::image($tizer->product->images[0]->link) : 'no-photo' }}')">
                                    </a>
                                </div>
                                <div class="pt-5 lg:p-2.5 text-center grow" style="padding: 5px;">
                                    <a href="{{ $tizer->product->url }}"
                                        class="block h-18 mb-3 text-ellipsis line-clamp-3">{{
                                        $tizer->product->getTranslatedAttribute('name') }}</a>
                                    <div class="mb-3 h-5 text-sm text-ellipsis overflow-hidden whitespace-nowrap">
                                        {{ $tizer->product->getTranslatedAttribute('description') }}</div>
                                    <div class="flex items-center justify-center lg:justify-center gap-1 lg:gap-6">
                                        @if ($tizer->product->old_price && $tizer->product->old_price >
                                        $tizer->product->price)
                                        <strong
                                            class="block mb-3 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{
                                            number_format($tizer->product->price, 0, '.', ' ') . ' ₸' }}</strong>
                                        <del class="block mb-3 -tracking-[0.5px] whitespace-nowrap">{{
                                            number_format($tizer->product->old_price, 0, '.', ' ') . ' ₸' }}</del>
                                        @else
                                        <strong
                                            class="block mb-3 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{
                                            number_format($tizer->product->price, 0, '.', ' ') . ' ₸' }}</strong>
                                        @endif
                                    </div>
                                    @if ($tizer->product->in_stock)
                                    <div class="bg-green-350 rounded px-1.5 py-1 text-xs text-white mb-3"
                                        style="margin-left: 5px; margin-right: 5px;">В наличии</div>
                                    @else
                                    <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white mb-3"
                                        style="margin-left: 5px; margin-right: 5px;">Ожидаем</div>
                                    @endif
                                    @if ($tizer->product->in_stock)
                                    <div class="flex btn-all">
                                        <a style="margin-left: 5px; margin-bottom: 5px; @if (!$tizer->product->kaspi) margin-right: 5px; @endif"
                                            class="@if ($tizer->product->kaspi)  w-2/5 rounded-l @else w-full rounded @endif px-1.5 lg:px-2 pt-2 lg:pt-3 text-white bg-green-200 hover:bg-green-250 text-sm lg:text-base"
                                            x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.cart', arguments: { product: {{ $tizer->product->id }} }})"
                                            href="#">Купить</a>
                                        @if ($tizer->product->kaspi)
                                        <a style="margin-right: 5px; margin-bottom: 5px;"
                                            class="w-3/5 px-1.5 lg:px-2 pt-2 lg:pt-3 rounded-r text-white bg-rg hover:bg-rgh text-sm lg:text-base"
                                            x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.kaspi', arguments: { product: {{ $tizer->product->id }} }})"
                                            href="#">Рассрочка</a>
                                        @endif
                                    </div>
                                    @else
                                    <a style="margin-left: 5px; margin-right: 5px; margin-bottom: 5px;" href="#"
                                        x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.preorder', arguments: { product: {{ $tizer->product->id }} }})"
                                        class="btn-all shadow rounded flex gap-2 items-center px-1.5 lg:px-2 pt-2 lg:pt-3 justify-center text-sm lg:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 lg:w-6 lg:h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <span>Предзаказ</span>
                                    </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <a class="swiper-nextfooter absolute top-1/2 -translate-y-full -right-2 lg:right-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                href="#">
                <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                    <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                    </polyline>
                </svg>
            </a>
        </div>
        @endif
        <div class="text-2xl mb-5 font-bold text-center uk-heading-line text-gray-500">
            <span class="">Каталог товаров Xiaomi</span>
        </div>
        <div class="uk-margin uk-text-center">
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3">
                @foreach ($categories as $category)
                <div class="overflow-hidden">
                    <div class="">
                        <a class="relative block no-underline group" href="{{ $category['url'] }}">
                            @if (!empty($category['webp']))
                            <picture class="">
                                <source type="image/webp"
                                    srcset="{{ $category['webp'][1] }} 256w, {{ $category['webp'][0] }} 500w"
                                    sizes="(min-width: 256px) 256px">
                                <img loading="lazy" class="w-full transition group-hover:scale-110 duration-1000"
                                    src="{{ $category['webp'][0] }}" alt="">
                            </picture>
                            @endif
                            <div
                                class="m-4 absolute max-w-[calc(100%-2rem)] top-[calc(50%-1rem)] left-[calc(50%-1rem)] -translate-x-1/2 -translate-y-1/2 w-max text-center p-4 bg-gray-450">
                                <div class="text-lg"> {{ $category['name'] }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-10 mt-10">
            <div class="">
                <div class="text-2xl mb-5 font-bold text-gray-500">Информация</div>
                <div class="flex flex-col gap-5 font-light mb-5" x-data="{ opened: null }">
                    @foreach ($footer_infos as $key => $footer_info)
                    <div class="@if ($key) pt-5 border-t @endif">
                        <a class="flex gap-2.5 justify-between" href="#"
                            x-on:click.prevent="opened=opened==={{ $key }} ? null:{{ $key }}"
                            id="uk-accordion-{{ $key * 2 + 1 }}" role="button"
                            aria-controls="uk-accordion-{{ $key * 2 + 2 }}" aria-expanded="false" aria-disabled="false">
                            <div class="flex gap-2.5">
                                {!! $footer_info['icon'] !!}
                                <span>{{ $footer_info['name'] }}</span>
                            </div>
                            <svg width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                                <rect fill="#444" width="13" height="1" x="0" y="6" />
                                <rect x-show="opened !== {{ $key }}" fill="#444" width="1" height="13" x="6" y="0"
                                    style="display:none" />
                            </svg>
                        </a>
                        <div x-show="opened === {{ $key }}" style="display:none" x-collapse.duration.300ms
                            id="uk-accordion-{{ $key * 2 + 2 }}" role="region"
                            aria-labelledby="uk-accordion-{{ $key * 2 + 1 }}">
                            <div class="prose">
                                {!! $footer_info['description'] !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{ menu('footer-1', 'menu.footer') }}
            <div class="uk-panel uk-margin">
                <div class="prose">{!! $footer_contacts !!}</div>
                {{ menu('footer-2', 'menu.footer') }}
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-10 mt-10">
            @foreach ($footer_advs as $key => $footer_adv)
            <div class=" flex flex-col items-center text-center">
                <div class="text-2xl font-bold fttl mx-auto">{{ $footer_adv['name'] }}</div>
                <div class="my-5">
                    {!! $footer_adv['description'] !!}
                </div>
            </div>
            @endforeach
        </div>
        <div class="flex justify-center my-5">
            <div class="prose">
                {!! $footer_req !!}
            </div>
        </div>
        <div class="mt-5 pb-10 flex justify-center">
            {{ menu('footer-3', 'menu.footer3') }}
        </div>
    </div>
    <script>

    </script>
</footer>