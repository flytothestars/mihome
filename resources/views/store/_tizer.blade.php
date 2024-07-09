<div class="flex flex-col bg-white rounded-lg overflow-hidden shadow-lg"
    @if (isset($infiltrable) && $tizer->category) x-show="!category || category.id==={{ $tizer->category->id }}"
    x-init="categories && categories.find(el => el.id === {{ $tizer->category->id }}) || categories.push({
        id: {{ $tizer->category->id }},
        name: '{{ $tizer->category->name }}',
        slug: '{{ $tizer->category->slug }}'
    })" @endif>
    <div class="relative flex">
        <div
            class="absolute w-full p-2 flex flex-wrap gap-2 text-xs text-white -translate-x-1/2 left-1/2 whitespace-nowrap">
            @if ($tizer->kaspi && $tizer->in_stock)
                <span class="rounded bg-red-400 px-1 py-0.5">0-0-12</span>
            @endif
            @if ($tizer->old_price && $tizer->price && $tizer->price < $tizer->old_price)
                <span
                    class="rounded bg-yellow-500 px-1 py-0.5">{{ round(($tizer->price / $tizer->old_price - 1) * 100) . '%' }}</span>
            @elseif(!$tizer->in_stock && $tizer->pre_order)
                <span class="rounded bg-yellow-500 px-1 py-0.5">Ожидаем через
                    {{ intval($tizer->pre_order) }} дн.</span>
            @endif
            @if ($tizer->discount && $tizer->discount)
                <span class="rounded bg-yellow-400 px-1 py-0.5">-{{ $tizer->discount }}%</span>
            @endif
            @if ($tizer->rating)
                <span class="rounded bg-green-350 px-1 py-0.5">⭐ {{ $tizer->rating }} /
                    {{ $tizer->ratingcount }}</span>
            @else
                <span class="rounded bg-green-350 px-1 py-0.5">Новинка</span>
            @endif
        </div>
        <a href="{{ $tizer->url }}" class="bg-slate-100 w-full block pt-[117.5%] bg-cover bg-center"
            style="background-image:url('{{ $tizer->images && $tizer->images->count() ? Voyager::image($tizer->images[0]->link) : 'no-photo' }}')">
        </a>
    </div>
    <div class="pt-5 lg:p-2.5 text-center grow" style="padding: 5px;">
        <a href="{{ $tizer->url }}"
            class="block h-18 mb-3 text-ellipsis line-clamp-3">{{ $tizer->getTranslatedAttribute('name') }}</a>
        <div class="mb-3 h-5 text-sm text-ellipsis overflow-hidden whitespace-nowrap">
            {{ $tizer->getTranslatedAttribute('description') }}</div>
        <div class="flex items-center justify-center lg:justify-center gap-1 lg:gap-6">
            @if ($tizer->old_price && $tizer->old_price > $tizer->price)
                <strong
                    class="block mb-3 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{ number_format($tizer->price, 0, '.', ' ') . ' ₸' }}</strong>
                <del
                    class="block mb-3 -tracking-[0.5px] whitespace-nowrap">{{ number_format($tizer->old_price, 0, '.', ' ') . ' ₸' }}</del>
            @else
                <strong
                    class="block mb-3 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{ number_format($tizer->price, 0, '.', ' ') . ' ₸' }}</strong>
            @endif
        </div>
        @if ($tizer->in_stock)
            <div class="bg-green-350 rounded px-1.5 py-1 text-xs text-white mb-3" style="margin-left: 5px; margin-right: 5px;">В наличии</div>
        @else
            <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white mb-3" style="margin-left: 5px; margin-right: 5px;">Ожидаем</div>
        @endif
        @if ($tizer->in_stock)
            <div class="flex btn-all">
                <a style="margin-left: 5px; margin-bottom: 5px; @if (!$tizer->kaspi) margin-right: 5px; @endif" class="@if ($tizer->kaspi) w-2/5 rounded-l @else w-full rounded @endif px-1.5 lg:px-2 pt-2 lg:pt-3 text-white bg-green-200 hover:bg-green-250 text-sm lg:text-base"
                    x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.cart', arguments: { product: {{ $tizer->id }} }})"
                    href="#">Купить</a>
                @if ($tizer->kaspi)
                    <a style="margin-right: 5px; margin-bottom: 5px;" class="w-3/5 px-1.5 lg:px-2 pt-2 lg:pt-3 rounded-r text-white bg-rg hover:bg-rgh text-sm lg:text-base"
                        x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.kaspi', arguments: { product: {{ $tizer->id }} }})"
                        href="#">Рассрочка</a>
                @endif
            </div>
        @else
            <a style="margin-left: 5px; margin-right: 5px; margin-bottom: 5px;" href="#"
                x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.preorder', arguments: { product: {{ $tizer->id }} }})"
                class="btn-all shadow rounded flex gap-2 items-center px-1.5 lg:px-2 pt-2 lg:pt-3 justify-center text-sm lg:text-base">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 lg:w-6 lg:h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Предзаказ</span>
            </a>
        @endif
    </div>
</div>
