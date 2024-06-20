<form class="px-6 py-6 bg-white rounded-xl shadow border relative" wire:submit="save">
    <div class="px-5 py-4">
        <h3>Задать вопрос</h3>

        <div class="mb-4">
            <x-input-label value="Ваше имя" />
            <x-text-input class="block mt-1 w-full" type="text" name="name" wire:model="form.name" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label value="Телефон или адрес электронной почты" />
            <x-text-input class="block mt-1 w-full" type="text" name="phone" wire:model="form.phone" />
            <x-input-error :messages="$errors->get('form.phone')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label value="Вопрос" />
            <x-textarea class="block mt-1 w-full h-36" placeholder="Или укажите товар который вас интересует" type="message"
                name="message" wire:model="form.message" />
            <x-input-error :messages="$errors->get('form.message')" class="mt-2" />
        </div>

        <div class="mb-4 text-right">
            <x-success-button class="">
                <span class="font-medium">Отправить</span>
            </x-success-button>
        </div>
        <p><b>После получения запроса мы свяжемся с вами в течение рабочего дня </b></p>
    </div>
</form>
