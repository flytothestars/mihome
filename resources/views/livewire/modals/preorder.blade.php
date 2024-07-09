<div>
    <div class="prose px-5 py-4">
        <h3>Предзаказ</h3>
        <p>Товар:&nbsp;<b>{{ $offer->name }}</b></p>
        <p>Чтобы <b><ins>&nbsp;получить СМС уведомление </ins></b>&nbsp;о поступлении товара – укажите номер вашего
            сотового телефона.</p>
        <form class="" method="post" action="#" wire:submit.prevent="preorder">
            @csrf
            <label for="phone">Номер телефона</label>
            <input class="" type="text" name="phone" value="{{ old('phone', '') }}" placeholder="Номер телефона"
                title="Введите ваш номер телефона" x-mask="+7 (999) 999 99 99" wire:model="phone">
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            <button type="submit" class="notify-button uk-button uk-button-primary validate btn-all">Предзаказ</button>
        </form>
        <p><b>Обратите внимание:</b></p>
        <ul>
            <li>Предзаказ <strong>НЕ</strong> обязывает покупать товар или вносить какую-либо предоплату.</li>
            <li>Предзаказ <strong>НЕ</strong> не влияет на сроки и не гарантирует поступление товара.</li>
            <li>Предзаказ <strong>НЕ</strong> не влияет на стоимость товара.</li>
            <li>Количество товара при поступлении может быть ограниченно. В случае отказа от предзаказа, наличие товара
                в дальнейшем не гарантируется.</li>
        </ul>
    </div>
</div>
