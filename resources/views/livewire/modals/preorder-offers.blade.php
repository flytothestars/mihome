<div>
    <div class="product-container">
        <p>Товар:</p>
        <p class="uk-h3 uk-margin-remove">{{ $product->name }}</p>
        <p>Для оформления <b>Предзаказа</b> - выберите доступный вариант товара и нажмите на кнопку <b>Предзаказ</b></p>
        @include('livewire.modals._offers', [
            'component' => 'preorder',
        ])
    </div>
</div>
