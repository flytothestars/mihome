<div>
    <form wire:submit.prevent="addtocart" class="addtocart-bar flex items-stretch gap-4">
        <div class="hidden sm:flex gap-2">
            <input type="hidden" wire:model="offer" name="offer" value="{{ $offer->id }}">
            <span class="quantity-box">
                <input type="text" wire:model="quantity" class="quantity-input js-recalculate uk-input" name="quantity"
                    style="width: 40px !important;" data-step="1">
            </span>
            <span class="quantity-controls js-recalculate uk-button-group">
                <button type="button" x-on:click="$wire.quantity++"
                    class="quantity-controls quantity-plus uk-button uk-button-default">
                    +
                </button>
                <button type="button" x-on:click="$wire.quantity > 1 ? $wire.quantity-- : null"
                    class="quantity-controls quantity-minus uk-button uk-button-default">
                    -
                </button>
            </span>
        </div>
        @if ($component === 'kaspi')
            {{-- <button type="submit" class="addtocart-button  uk-button uk-button-danger">Рассрочка</button> --}}
            <div class="relative w-40" style="height: 44px; width: 160px;"
                x-data='{
                    init(){
                        document.getElementById("dynamic_{{ $offer->id }}").innerHTML = "<div class=\"ks-widget\" data-template=\"button\" data-merchant-sku=\"{{ $offer->article }}\" data-merchant-code=\"VOXM\" data-city=\"750000000\" ></div>"
                        window.ksWidgetInitializer.reinit()
                    }
                }'>
                <button
                    class="leading-none w-40 gap-1 p-2 rounded transition bg-red-500 text-white hover:shadow-lg inline-flex justify-start text-sm items-center"
                    type="submit">
                    <div class="kaspi_button_logo w-7 h-7"></div>
                    <span>
                        <strong>В рассрочку<br></strong>
                        {{ number_format($offer->price / setting('shop.kaspi0024value'), 0, ' ', ' ') }}
                        x {{ setting('shop.kaspi0024value') }} мес
                    </span>
                </button>
                <div id="dynamic_{{ $offer->id }}" class="absolute top-0 left-0 right-0 z-2"></div>
            </div>
        @else
            <button type="submit" class="addtocart-button  uk-button uk-button-primary">В
                корзину</button>
        @endif
    </form>
</div>
