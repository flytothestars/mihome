<div class="space-y-6" x-data>
    <form action="#" wire:submit.prevent="submitDelivery" method="POST" x-ref="form">
        <select placeholder="Выберите город" class="w-full bg-gray-75 border-gray-75 rounded" wire:model="city_id"
            wire:change="setCity">
            @foreach ($cities as $c)
                <option value="{{ $c->id }}" @if ($c->id == $city->id) checked="checked" @endif>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 my-6">
            @foreach ($deliveries as $d)
                <label for="delivery_method_id_{{ $d->id }}"
                    class="flex gap-3 items-center justify-between rounded-lg bg-gray-50 hover:bg-gray-150 cursor-pointer py-4 px-4">
                    <div class="flex items-center gap-3">
                        <input class="" id="delivery_method_id_{{ $d->id }}" type="radio"
                            name="delivery_method_id" wire:change="submitDelivery({{ $d->id }})"
                            @if ($deliveryMethod && $deliveryMethod->id === $d->id) checked="checked" @endif wire:model="delivery_method_id"
                            value="{{ $d->id }}">
                        <div>
                            <div>{{ $d->name }}</div>
                            <div class="text-sm">{{ $d->description }}</div>
                        </div>
                    </div>
                    <div class="text-xl font-bold shrink-0">
                        {{ $d->price ? number_format($d->price, 0, '.', ' ') . ' ₸' : '' }}
                    </div>
                </label>
            @endforeach
        </div>
        @if ($deliveryMethod && $deliveryMethod->id === $d->id && $deliveryMethod->address)
            <div class="my-6">
                <div class="flex flex-wrap gap-3">
                    <textarea class="w-full bg-gray-75 border-gray-75 rounded"
                        placeholder="Адрес (улица, номер дома, подъезд ,номер квартиры)" name="address" wire:model="address">{{ old('address', '') }}</textarea>
                </div>
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
        @endif
        <x-input-error :messages="$errors->get('delivery_method_id')" class="mt-2" />
        @if ($deliveryMethod)
            <x-primary-button>Подтвердить</x-primary-button>
        @endif
    </form>
</div>
