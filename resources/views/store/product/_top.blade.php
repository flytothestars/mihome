<div class="grid grid-cols-2 gap-4 text-xs lg:text-sm my-3 lg:my-5">
    <div class="whitespace-nowrap overflow-hidden text-ellipsis">
        {{ $product->getTranslatedAttribute('description') }}</div>
    <div class="whitespace-nowrap overflow-hidden text-ellipsis">Модель: <span
            class="">{{ $offer ? $offer->article : $product->article }}</span>
    </div>
</div>
