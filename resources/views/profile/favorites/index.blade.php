<x-app-layout>
    <div class="container">
        <div class="flex gap-8">
            <div class="w-full lg:max-w-[20rem] shrink-0 text-zinc-800">
                @include('profile.partials._aside', [
                    'active' => 'favorites',
                ])
            </div>
            <div class="grow">
                <div class="text-zinc-800 text-2xl font-bold mb-6" >Ваши избранные товары</div>
                <template x-if="{{$favorites->count()}}">
                    <ul class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-2.5 gap-y-5">
                        <template x-for="(p,pdx) of {{$favorites}}">
                            <li class="lg:p-0 relative group">
                                <a :href="'https://rent2go.kz/product/' + p.slug"
                                    class="relative block lg:w-32 bg-white rounded shadow">
                                    <div class="w-full pt-[96.25%] bg-cover bg-center"
                                        :style="{ backgroundImage: `url('/storage/${p.images.length ? p.images[0].link : '/storage/no-photo.png'}')` }"
                                        style="width: 129px;height: calc(129px* 1.176); position: relative;">
                                        <div class="absolute inset-0 flex flex-col justify-center space-y-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2">
                                            <button class="bg-gray-400 text-white py-1 px-2 rounded"
                                            @click.prevent="window.location.href = 'https://rent2go.kz/product/' + p.slug">Перейти</button>
                                            <button class="bg-gray-400 text-white py-1 px-2 rounded"
                                            @click.prevent="window.location.href = 'https://rent2go.kz/product/unfavorite/' + p.id">Убрать</button>
                                        </div>
                                    </div>
                                    <div class="p-2 text-xs text-zinc-800">
                                        <div class="mb-2 line-clamp-3 h-[3rem]"
                                            x-text="p.name">
                                        </div>
                                        <div class="font-bold" x-text="p.price_formatted">
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </template>
                        
                        
                    </ul>
                </template>
                @if (!$favorites->count())
                <div class="text-zinc-400 font-semibold py-2">У Вас пока нет заказов</div>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rows = document.querySelectorAll('tr[data-href]');

            rows.forEach(row => {
                row.addEventListener('click', function () {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
</x-app-layout>
