<button
    x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.cart', arguments: { product: {{ $product->id }}, offer: {{ $offer ? $offer->id : 'null' }} }})"
    class="btn-all leading-none flex items-center gap-1 lg:py-2 px-4 rounded justify-center transition bg-white hover:shadow-lg min-h-[2.75rem] text-left {{ setting('shop.kaspi0024') && ($offer ? $offer->kaspi : $product->offers()->where('kaspi', true)->exists()) ? '' : 'col-span-2' }}">
    <svg class="w-7 h-7 shrink-0" viewBox="0 0 20 20">
        <circle cx="7.3" cy="17.3" r="1.4">
        </circle>
        <circle cx="13.3" cy="17.3" r="1.4">
        </circle>
        <polyline fill="none" stroke="currentColor" points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5">
        </polyline>
    </svg>
    <span class="max-w-[calc(8rem)]">{!! $product->textCartButton !!}</span>
</button>
