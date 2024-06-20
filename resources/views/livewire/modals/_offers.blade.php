@foreach ($product->offers as $offer)
    <div class="uk-alert">
        <div class="flex items-center gap-2 justify-between">
            <div class="uk-width-2-5 uk-first-column">
                <div class="uk-text-bold">{!! str_replace($product->getTranslatedAttribute('name'), '', $offer->getTranslatedAttribute('name')) !!}</div>
                <div class="uk-grid-collapse uk-grid">
                    @if ($offer->in_stock)
                        <span>🟢&nbsp;В&nbsp;наличии</span>
                    @else
                        <span>🟠&nbsp;Ожидаем</span>
                    @endif
                </div>
            </div>
            @if ($offer->in_stock)
                @if ($component === 'preorder' || $component === 'cart' || $component === 'kaspi')
                    @livewire('cart-item', [
                        'offer' => $offer->id,
                        'component' => $component,
                    ])
                    {{-- @elseif($component === 'kaspi')
                        <a rel="nofollow"
                            class="py-1 px-2 lg:px-4 leading-tight rounded transition bg-red-500 text-white hover:shadow-lg flex justify-center text-sm items-center"
                            x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.kaspi', arguments: { product: {{ $product->id }}, offer: {{ $offer ? $offer->id : 'null' }} }})"
                            href="{{ $offer ? $offer->kaspi_link : '#' }}" target="_blank"
                            style="text-decoration: none;">
                            <div class="kaspi_button_logo"></div>
                            <span>
                                <strong>В рассрочку<br></strong>
                                {{ number_format($product->price / setting('shop.kaspi0024value'), 0, ' ', ' ') }}
                                x {{ setting('shop.kaspi0024value') }} мес
                            </span>
                        </a> --}}
                @endif
            @endif
            @if (!$offer->in_stock)
                <a class="uk-button uk-button-default" href="#"
                    x-on:click.prevent="Livewire.dispatch('openModal', { 
                        component: 'modals.preorder', 
                        arguments: { 
                            product: {{ $product->id }}, 
                            offer: {{ $offer->id }} 
                        }
                    })">Предзаказ</a>
            @endif
        </div>
    </div>
@endforeach
