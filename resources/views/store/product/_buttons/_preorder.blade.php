<button
    x-on:click="Livewire.dispatch('openModal', { component: 'modals.preorder', arguments: { product: {{ $product->id }}, offer: {{ $offer ? $offer->id : 'null' }} }})"
    class="py-2.5 px-4 rounded transition bg-white hover:shadow-lg col-span-2">
    <svg class="inline w-5 h-5" viewBox="0 0 20 20">
        <circle fill="none" stroke="currentColor" stroke-width="1.1" cx="10" cy="10" r="9">
        </circle>
        <rect x="9" y="4" width="1" height="7"></rect>
        <path fill="none" stroke="currentColor" stroke-width="1.1" d="M13.018,14.197 L9.445,10.625">
        </path>
    </svg>
    <span>Предзаказ</span>
</button>
