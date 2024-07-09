<div class="flex flex-col bg-white rounded-lg overflow-hidden shadow-lg">
    <div class="relative flex">
        <div
            class="absolute w-full p-2 flex flex-wrap gap-2 text-xs text-white -translate-x-1/2 left-1/2 whitespace-nowrap">
            <template x-if="tizer.kaspi && tizer.in_stock">
                <span class="rounded bg-red-400 px-1 py-0.5">0-0-12</span>
            </template>
            <template x-if="tizer.old_price && tizer.price && tizer.price < tizer.old_price">
                <span class="rounded bg-yellow-500 px-1 py-0.5"
                    x-text="`${Math.round((tizer.price/tizer.old_price-1)*100)}%`"></span>
            </template>
            <template
                x-if="!(tizer.old_price && tizer.price && tizer.price < tizer.old_price) && tizer.in_stock && tizer.pre_order">
                <span class="rounded bg-yellow-500 px-1 py-0.5">Ожидаем через <span x-text="tizer.pre_order"></span>
                    дн.</span>
            </template>
            <template x-if="tizer.discount">
                <span class="rounded bg-yellow-350 px-1 py-0.5" x-text="`-${tizer.discount}`%"></span>
            </template>
            <template x-if="tizer.rating">
                <span class="rounded bg-green-350 px-1 py-0.5" x-text="`⭐ ${tizer.rating}/${tizer.ratingcount}`"></span>
            </template>
        </div>
        <a :href="tizer.url" class="bg-slate-100 w-full block pt-[117.5%] bg-cover bg-center"
            :style="tizer.image ? `background-image:url('${tizer.image}')` : (tizer.images.length ?
                `background-image:url('${tizer.images[0]}')` : ``)">
        </a>
    </div>
    <div class="lg:p-2.5 pt-5 text-center grow" style="padding: 5px;">
        <a :href="tizer.url" class="block h-18 mb-3 text-ellipsis line-clamp-3 font-medium"
            x-text="tizer.name"></a>
        <div class="mb-5 h-5 text-sm text-ellipsis overflow-hidden whitespace-nowrap" x-html="tizer.description"></div>
        <template x-if="tizer.old_price && tizer.old_price > tizer.price">
            <div class="flex items-center justify-center lg:justify-center gap-1 lg:gap-6">
                <strong class="block mb-3 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap"
                    x-text="tizer.price_formatted"></strong>
                <del class="block mb-3 -tracking-[0.5px] whitespace-nowrap" x-text="tizer.old_price_formatted"></del>
            </div>
        </template>
        <template x-if="!(tizer.old_price && tizer.old_price > tizer.price)">
            <div class="flex items-center justify-center lg:justify-center gap-1 lg:gap-6">
                <strong class="block mb-3 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap"
                    x-text="tizer.price_formatted"></strong>
            </div>
        </template>
        <template x-if="tizer.in_stock">
            <div class="">
                <div class="bg-green-350 rounded px-1.5 py-1 text-xs text-white mb-3">В наличии</div>
                <div class="flex btn-all">
                    <a :class="(tizer.kaspi ? 'w-2/5 rounded-l' : 'w-full rounded') +
                    ' px-1.5 lg:px-2 pt-2 lg:pt-3 text-white bg-green-200 hover:bg-green-250 text-sm lg:text-base'"
                        x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.cart', arguments: { product: tizer.id }})"
                        href="#">Купить</a>
                    <template x-if="tizer.kaspi">
                        <a class="w-3/5 px-1.5 lg:px-2 py-2 lg:py-3 rounded-r text-white bg-rg hover:bg-rgh text-sm lg:text-base"
                            x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.kaspi', arguments: { product: tizer.id }})"
                            href="#">Рассрочка</a>
                    </template>
                </div>
            </div>
        </template>
        <template x-if="!tizer.in_stock">
            <div class="">
                <div class="bg-yellow-500 rounded px-1.5 py-1 text-xs text-white mb-3">Ожидаем</div>
                <a href="#"
                    x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.preorder', arguments: { product: tizer.id }})"
                    class="btn-all shadow rounded flex gap-2 items-center px-1.5 lg:px-2 pt-2 lg:pt-3 justify-center text-sm lg:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 lg:w-6 lg:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Предзаказ</span>
                </a>
            </div>
        </template>
    </div>
</div>
