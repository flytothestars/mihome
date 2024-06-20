<div class="mb-8">
    @if ($populars->count())
        <div class="uk-h3 uk-heading-bullet uk-margin uk-visible@m">
            Популярные товары
        </div>
        <div class="grid grid-cols-2 gap-2.5">
            @foreach ($populars as $tizer)
                @include('store._infotizer')
            @endforeach
        </div>
    @endif
</div>
