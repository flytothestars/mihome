<form wire:submit="submit" id="comment-form">
    @csrf

    <input name="rate" type="hidden" wire:model="rate">

    <h2 class="text-2xl font-bold">Напишите свой отзыв</h2>

    @if (!Auth::check())
        {{-- <div class="text-sm my-2">
            Добавьте отзыв, заполнив личные данные, или сначала войдите на сайт, тогда информация будет
            автоматически взята из профиля.&nbsp;
            <a href="#">
                Войти
            </a>
        </div> --}}
    @endif

    <h3 class="text-xl mb-2">
        Рейтинг
    </h3>

    <div class="">
        <div class="">
            <div class="">
                <div class="flex gap-2">
                    @foreach ($stars as $sdx => $star)
                        <a href="#" wire:click.prevent="setRate({{ $sdx + 1 }})">
                            @if ($star)
                                <svg width="20" height="20" class="active">
                                    <use xlink:href="/storage/icon_page-product.svg#star_active"></use>
                                </svg>
                            @else
                                <svg width="20" height="20">
                                    <use xlink:href="/storage/icon_page-product.svg#star"></use>
                                </svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="">{{ $rate }}.0</div>
    </div>

    <div class="">

        @if (!Auth::check())
            <div class="my-4">
                <x-input-label for="name" :value="__('Ваше имя')" required="true" />
                <x-text-input id="name" wire:model="name" type="text" class="mt-1 block w-full" 
                    autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        @endif

        <div class="my-4">
            <x-input-label for="advantages" :value="__('Преимущества')" required="true" />
            <x-textarea name="text" class="mt-1 block w-full" wire:model="advantages" />
            <x-input-error class="mt-2" :messages="$errors->get('advantages')" />
        </div>

        <div class="my-4">
            <x-input-label for="disadvantages" :value="__('Недостатки')" required="true" />
            <x-textarea name="text" class="mt-1 block w-full" wire:model="disadvantages" />
            <x-input-error class="mt-2" :messages="$errors->get('disadvantages')" />
        </div>


        <div class="my-4">
            <x-input-label for="text" :value="__('Ваш отзыв')" required="true" />
            <x-textarea name="text" class="mt-1 block w-full" wire:model="text" />
            <x-input-error class="mt-2" :messages="$errors->get('text')" />
        </div>


    </div>
</form>
