<div class="space-y-6">
    @foreach ($cart->items as $item)
        <div class="flex flex-col lg:flex-row lg:items-center gap-3">
            <div class="flex gap-4 grow items-start">
                <div class="bg-center bg-contain bg-no-repeat shrink-0"
                    style="background-image:url('/storage/{{ $item->offer->product->images[0]->link }}'); width: 130px;height: calc(130px * 1.176);"></div>
                    <!-- <div class="image-container">
                        <img src="https://rent2go.kz/storage/images/products/Xiaomi_Deerma_DX118C8.jpg">
                    </div> -->
                <div class="relative grow">
                    <svg class="w-4 h-4 absolute right-0 top-0" wire:click="remove({{ $item->id }})"
                        viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"  style="cursor: pointer;">
                        <path d="M1.5 1.5L13.5 13.5M1.5 13.5L13.5 1.5" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                    <h5 class="text-lg font-bold mt-0 mb-3 pr-8"><a href="{{$item->offer->url}}">{{ $item->offer->name }}</a></h5>
                    <div class="text-sm mb-8">Артикул: {{ $item->offer->article }}</div>
                    <div class="flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <a href="#" wire:click="subtract({{ $item->id }})"
                                class="w-5 h-5 rounded-full flex items-center justify-center leading-none text-green-500 border border-green-500">
                                <div class="w-2.5 h-px bg-green-500"></div>
                            </a>
                            <div class="py-1.5 px-3 bg-gray-75 rounded min-w-[2.5rem] text-center text-sm">
                                {{ $item->quantity }}</div>
                            <a href="#" wire:click="add({{ $item->id }})"
                                class="relative w-5 h-5 rounded-full flex items-center justify-center leading-none text-green-500 border border-green-500">
                                <div class="w-2.5 h-px bg-green-500"></div>
                                <div class="h-2.5 w-px bg-green-500 absolute"></div>
                            </a>
                        </div>
                        <div class="text-xl font-bold">{{ number_format($item->sum, 0, '.', ' ') }} ₸
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <x-primary-button wire:click="next">Подтвердить</x-primary-button>
</div>
