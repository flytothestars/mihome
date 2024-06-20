<div class="flex items-center justify-between lg:grid lg:grid-cols-1 lg:grid-cols-2 gap-2 lg:gap-4 my-3 lg:my-5">
    @if ($offer)
        <div class="">
            @if ($offer->price)
                <div class="flex items-center gap-6 lg:gap-6 text-2xl">
                    @if ($offer->old_price && $offer->old_price > $offer->price)
                        <strong
                            class="block font-bold sm:font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{ number_format($offer->price, 0, '.', ' ') . ' ₸' }}</strong>
                        <del
                            class="block -tracking-[0.5px] whitespace-nowrap">{{ number_format($offer->old_price, 0, '.', ' ') . ' ₸' }}</del>
                    @else
                        <strong
                            class="block font-bold sm:font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{ number_format($offer->price, 0, '.', ' ') . ' ₸' }}</strong>
                    @endif
                </div>
            @endif
        </div>
        <div class="{{ !$offer->price ? 'col-span-2' : '' }} flex items-center">
            @if ($offer->in_stock > 0)
                @if ($offer->width > 0)
                    <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        <span class="hidden lg:inline">Товар
                        </span>Под заказ
                    </div>
                @else
                    <div class="bg-green-350 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        <span class="hidden lg:inline">Товар
                        </span>В
                        наличии
                    </div>
                @endif
            @elseif ($offer->price != 0)
                @if (false && $view != 'productdetails')
                    <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        Ожидаем
                    </div>
                @else
                    <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        Ожидаем
                        @if (!empty($offer->length) && $product->length > 0)
                            <span class="hidden lg:inline">через</span>{{ intval($product->length) }} дн.</span>
                        @else
                            <span class="hidden lg:inline">поступление</span>
                        @endif
                    </div>
                @endif
            @else
                <div class="bg-red-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">Нет в
                    наличии</div>
            @endif
        </div>
    @else
        <div class="">
            {{ $product->priceText }}
        </div>
        <div class="{{ !$product->price ? 'col-span-2' : '' }} flex items-center">
            @if ($product->in_stock > 0)
                @if ($product->width > 0)
                    <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        <span>Товар
                        </span>Под заказ
                    </div>
                @else
                    <div class="bg-green-350 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        <span>Товар
                        </span>В
                        наличии
                    </div>
                @endif
            @elseif ($product->price != 0)
                @if (false && $view != 'productdetails')
                    <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        Ожидаем
                    </div>
                @else
                    <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">
                        Ожидаем
                        @if (!empty($product->length) && $product->length > 0)
                            через</span>{{ intval($product->length) }} дн.
                        @else
                            <span>поступление</span>
                        @endif
                    </div>
                @endif
            @else
                <div class="bg-red-500 rounded px-1.5 py-1 text-xs text-white text-center self-center w-full">Нет в
                    наличии</div>
            @endif
        </div>
    @endif
</div>
