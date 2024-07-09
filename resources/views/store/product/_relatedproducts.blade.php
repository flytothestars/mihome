<div class="mb-8">
    <div class="uk-h3 uk-heading-bullet uk-margin uk-visible@m">
        Подобные товары
    </div>
    <div class="grid grid-cols-2 gap-2.5 p-1">
        @if ($product->relatedProducts()->count())
            @foreach ($product->relatedProducts as $tizer)
                @include('store._infotizer')
            @endforeach
        @endif
        @if ($products->count())
            @foreach ($products as $tizer)
                @include('store._infotizer')
            @endforeach
        @endif
    </div>
</div>
