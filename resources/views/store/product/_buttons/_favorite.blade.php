@if (Auth::check())
@if($favorite)
<a href="{{ route(app()->getLocale() . '.profile.favorites') }}"
    class="btn-all leading-none flex items-center gap-1 lg:py-2 px-4 rounded justify-center transition bg-white hover:shadow-lg min-h-[2.75rem] text-left {{ setting('shop.kaspi0024') && ($offer ? $offer->kaspi : $product->offers()->where('kaspi', true)->exists()) ? '' : 'col-span-2' }}">
    <span class="max-w-[calc(8rem)]">Товар у вас в избранном</span>
</a>
@else
<a href="{{ route(app()->getLocale() . '.favorite', ['product' => $product->id]) }}"
    class="btn-all img-width leading-none flex items-center gap-1 lg:py-2 px-4 rounded justify-center transition bg-white hover:shadow-lg min-h-[2.75rem] text-left {{ setting('shop.kaspi0024') && ($offer ? $offer->kaspi : $product->offers()->where('kaspi', true)->exists()) ? '' : 'col-span-2' }}">
    <span class="variable">Добавить в избранное</span>
    <span class="variable">
        <img src="{{asset('vector_star.png')}}" width="44" height="44">
    </span>
</a>
@endif
@else
<a href="{{ route(app()->getLocale() . '.login') }}"
    class="btn-all img-width leading-none flex items-center gap-1 lg:py-2 px-4 rounded justify-center transition bg-white hover:shadow-lg min-h-[2.75rem] text-left {{ setting('shop.kaspi0024') && ($offer ? $offer->kaspi : $product->offers()->where('kaspi', true)->exists()) ? '' : 'col-span-2' }}">
    <span class="variable">Добавить в избранное</span>
    <span class="variable">
        <img src="{{asset('vector_star.png')}}" width="44" height="44">
    </span>
</a>
@endif