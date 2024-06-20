<div>
    <div class="product-container">
        <p>Товар:</p>
        <p class="uk-h3 uk-margin-remove">{{ $product->name }}</p>
        @include('livewire.modals._offers', [
            'component' => $component,
        ])
        @if ($sign)
            <p>{{ $sign }}</p>
        @endif
    </div>
</div>
