<footer class="text-bm font-light">
    <div class="container">
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
                                        <img loading="lazy"
                                            class="w-full transition group-hover:scale-110 duration-1000"
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
                                aria-controls="uk-accordion-{{ $key * 2 + 2 }}" aria-expanded="false"
                                aria-disabled="false">
                                <div class="flex gap-2.5">
                                    {!! $footer_info['icon'] !!}
                                    <span>{{ $footer_info['name'] }}</span>
                                </div>
                                <svg width="13" height="13" viewBox="0 0 13 13"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect fill="#444" width="13" height="1" x="0" y="6" />
                                    <rect x-show="opened !== {{ $key }}" fill="#444" width="1"
                                        height="13" x="6" y="0" style="display:none" />
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
</footer>
