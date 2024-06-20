<div class="space-y-6">
    <form action="#" wire:submit.prevent="submitContacts" method="POST">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 my-6">
            <div class="">
                <div class="flex flex-wrap gap-3">
                    <input class="w-full bg-gray-75 border-gray-75 rounded" type="text" placeholder="Имя" name="name"
                        value="{{ old('name', '') }}" wire:model="name">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="">
                <div class="flex flex-wrap gap-3">
                    <input class="w-full bg-gray-75 border-gray-75 rounded" type="text" placeholder="Фамилия"
                        name="lastname" value="{{ old('lastname', '') }}" wire:model="lastname">
                </div>
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
            <div class="">
                <div class="flex flex-wrap gap-3">
                    <input class="w-full bg-gray-75 border-gray-75 rounded" type="text" placeholder="Номер телефона"
                        name="phone" value="{{ old('phone', '') }}" x-mask="+7 (999) 999 99 99" wire:model="phone">
                </div>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <div class="">
                <div class="flex flex-wrap gap-3">
                    <input class="w-full bg-gray-75 border-gray-75 rounded" type="email" placeholder="Эл. почта"
                        name="email" value="{{ old('email', '') }}" wire:model="email">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        <x-primary-button>Подтвердить</x-primary-button>
    </form>
</div>
