<div>
    <div class="prose px-5 py-4">
        <div class="uk-panel">
            <h4 class="uk-h4 uk-text-bold"> {{ $added }} x {{ $offer->name }} добавлен в Вашу корзину.
            </h4>
            <hr>
            <div class="grid grid-col-2 gap-2.5">
                <button
                    @if ($offer->product->offers()->count() > 1) x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.cart', arguments: { product: {{ $offer->product->id }} }})" @else x-on:click.prevent="Livewire.dispatch('closeModal')" @endif
                    class="rounded-l px-1.5 lg:px-2 py-2 lg:py-3 text-white bg-green-200 hover:bg-green-250 text-sm lg:text-base">Продолжить
                    покупки</button>
                <a href="/cart"
                    class="rounded-l justify-center items-center px-1.5 lg:px-2 py-2 lg:py-3 text-white bg-green-200 hover:bg-green-250 text-sm lg:text-base flex gap-2.5">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 20 20">
                        <circle cx="7.3" cy="17.3" r="1.4" fill="currentColor"></circle>
                        <circle cx="13.3" cy="17.3" r="1.4" fill="currentColor"></circle>
                        <polyline fill="none" stroke="currentColor" points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5">
                        </polyline>
                    </svg>
                    <span>Показать корзину</span>
                </a>
            </div>
            @if ($sign)
                <p>{{ $sign }}</p>
            @endif
            @if ($offer->product && $offer->product->relatedProducts()->count())
                <hr>
                <h4 class="uk-margin-small uk-text-center uk-text-bold uk-h4">Сопутствующие товары</h4>
                <div class="grid grid-cols-2 gap-2.5">
                    @foreach ($offer->product->relatedProducts as $tizer)
                        @include('store._tizer')
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
