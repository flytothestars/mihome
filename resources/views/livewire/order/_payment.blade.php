<div class="space-y-6" x-data>
    <div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 my-6">
            @foreach ($deliveryMethod->paymentMethods as $p)
                <label for="payment_method_id_{{ $p->id }}"
                    class="rounded-lg bg-gray-50 hover:bg-gray-150 cursor-pointer py-4 px-4">
                    <div class="flex items-center gap-3">
                        <input class="" id="payment_method_id_{{ $p->id }}" type="radio"
                            name="payment_method_id" wire:change="setPaymentMethod($event.target.value)"
                            value="{{ $p->id }}" @if ($paymentMethod && $paymentMethod->id === $p->id) checked="" @endif
                            wire:model="payment_method_id" value="{{ $p->id }}">
                        <div>
                            <div>{{ $p->name }}</div>
                            <div class="text-sm">{{ $p->description }}</div>
                        </div>
                    </div>
                </label>
            @endforeach
        </div>
        <x-input-error :messages="$errors->get('payment_method_id')" class="mt-2" />
        <div class="my-6">
            <label class="block">У меня есть промокод</label>
            <div class="flex gap-4 items-center">
                <input
                    @if ($appliedCoupon) disabled="" value="{{ $appliedCoupon->code }}" @else value="{{ old('coupon', '') }}" wire:model="coupon" @endif
                    class="w-full bg-gray-75 border-gray-75 rounded" type="text" name="coupon">
                @if (!$appliedCoupon)
                    <x-primary-button wire:click="submitCoupon" class="btn-all" type="button">Применить</x-primary-button>
                @endif
            </div>
            <x-input-error :messages="$errors->get('coupon')" class="mt-2" />
        </div>
    </div>
</div>
