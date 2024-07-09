<div>
    <div class="prose px-5 py-4">
        <h2>Рассрочка / Кредит</h2>
        <p>Товар:&nbsp;<b>{{ $offer->name }}</b></p>
        <p>Цена:&nbsp;<b>{{ $offer->price }}</b></p>
        <ol>
            <li>Нажмите на кнопку <strong>Оформить рассрочку</strong></li>
            <li>Введите <span style="text-decoration: underline;">стоимость товара</span> и нажмите
                <strong>Продолжить</strong>
            </li>
            <li>В поле <strong>Сообщение продавцу</strong> укажите <span style="text-decoration: underline;">ваш номер
                    телефона</span></li>
            <li>Нажмите <strong>Оплатить в Рассрочку</strong></li>
        </ol>
        <ol start="5">
            <li>После,&nbsp;<span style="text-decoration: underline;">вернитесь на сайт</span> <strong>Mi Home</strong>
            </li>
            <li>Заполните поля <span style="text-decoration: underline;">Ваше имя и номер телефона</span></li>
            <li>Нажмите <strong>Подтвердить заказ</strong></li>
        </ol>
        <a rel="nofollow"
            class="py-1 px-4 rounded transition bg-red-500 text-white hover:shadow-lg flex justify-center gap-2 items-center"
            href="https://pay.kaspi.kz/pay/bk2pl4ny" target="_blank" style="text-decoration: none;">
            <div class="kaspi_button_logo"></div>
            <strong>Оформить рассрочку</strong>
        </a>

        <form class="my-4" method="post" action="#" wire:submit.prevent="order">
            @csrf
            <div class="my-3">
                <div class="flex flex-wrap gap-3">
                    <label for="name" class="shrink-0">Ваше имя*</label>
                    <input class="grow" type="text" name="name" value="{{ old('name', '') }}" wire:model="name">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="my-3">
                <div class="flex flex-wrap gap-3">
                    <label for="phone" class="shrink-0">Ваш номер телефона*</label>
                    <input class="grow" type="text" name="phone" value="{{ old('phone', '') }}"
                        x-mask="+7 (999) 999 99 99" wire:model="phone">
                </div>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <button type="submit" class="notify-button uk-button uk-button-primary validate btn-all">Подтвердить заказ</button>
        </form>
    </div>
</div>
