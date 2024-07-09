@if (setting('shop.kaspi0024') && ($offer ? $offer?->kaspi : $product->offers()->where('kaspi', true)->exists()))
<div class="btn-all leading-none flex items-center gap-1 lg:py-2 px-4 rounded justify-center transition bg-red-500 hover:shadow-lg min-h-[2.75rem] text-left">
    <!-- <div class="relative w-40"
        x-data='{
            init(){
                document.getElementById("dynamic_{{ $offer?->id }}").innerHTML = "<div class=\"ks-widget\" data-template=\"button\" data-merchant-sku=\"{{ $offer?->article }}\" data-merchant-code=\"VOXM\" data-city=\"750000000\" ></div>"
                window.ksWidgetInitializer.reinit()
            }
        }'
        > -->
    <a rel="nofollow"
        class="leading-none w-50 gap-1 btn-all  px-2 lg:px-4 rounded transition bg-red-500 text-white hover:shadow-lg flex justify-start text-sm items-center"
        x-on:click.prevent="Livewire.dispatch('openModal',
        { component: 'modals.kaspi' , arguments: { product: {{ $product->id }}, offer:
        {{ $offer ? $offer->id : 'null' }}, kaspi: true }})" href="{{ $offer ? $offer->kaspi_link : '#' }}" target="_blank"
        style="text-decoration: none;">
        <div class="kaspi_button_logo w-7 h-7"></div>
        <span>
            <strong>В рассрочку<br></strong>
            {{ number_format($product->price / setting('shop.kaspi0024value'), 0, ' ', ' ') }}
            x {{ setting('shop.kaspi0024value') }} мес
        </span>
    </a>
    <div id="dynamic_{{ $offer?->id }}" class="absolute top-0 left-0 right-0 z-2"></div>
</div>
@endif