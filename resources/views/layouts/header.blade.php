<header class="relative z-30" x-data="header">
    <div class="lg:border bg-white lg:bg-primary-800 lg:text-white fixed w-full lg:static py-2.5 text-xm">
        <div class="container">
            <div class="relative lg:flex lg:items-center lg:justify-between">
                <div class="lg:hidden">
                    <ul class="flex justify-between gap-4 items-end w-full pl-0 m-0">
                        <li class="w-1/5">
                            <a href="#" x-on:click.prevent="catalogShow=true" class="flex flex-col items-center">
                                <svg width="20" height="20" viewBox="0 0 20 20">
                                    <rect class="line-1" y="3" width="20" height="2"></rect>
                                    <rect class="line-2" y="9" width="20" height="2"></rect>
                                    <rect class="line-3" y="9" width="20" height="2"></rect>
                                    <rect class="line-4" y="15" width="20" height="2"></rect>
                                </svg>
                                <div class="leading-none">каталог</div>
                            </a>
                        </li>
                        <li class="w-1/5">
                            <a href="#" x-on:click.prevent="searching=true" class="flex flex-col items-center">
                                <svg width="26" height="26" viewBox="0 0 20 20">
                                    <circle fill="none" stroke="#000" stroke-width="1.1" cx="9"
                                        cy="9" r="7"></circle>
                                    <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z">
                                    </path>
                                </svg>
                                <div class="leading-none">поиск</div>
                            </a>
                        </li>
                        <li class="w-1/5">
                            <a href="/" class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="10 10 190 190"
                                    class="w-12 h-12">
                                    <path d="M 14 188 L 14 62  L 100 12 L 188 62 L 188 188  L 14 188 " stroke="#000000"
                                        fill="transparent" stroke-width="4" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M 39.63 74.94 C 42.10 74.94 44.58 74.94 47.05 74.94 C 58.85 103.55 70.64 132.18 82.43 160.80 C 94.25 132.19 106.01 103.55 117.83 74.94 C 120.30 74.94 122.77 74.94 125.25 74.94 C 125.26 106.96 125.25 138.98 125.25 171.00 C 123.69 171.00 122.12 171.00 120.56 171.00 C 120.55 140.88 120.57 110.76 120.55 80.65 C 108.08 110.64 95.67 141.15 83.09 171.04 C 82.01 171.13 81.41 170.78 81.26 170.00 C 68.95 140.24 56.64 110.40 44.32 80.65 C 44.30 110.76 44.32 140.88 44.31 171.00 C 42.75 171.00 41.19 171.00 39.62 171.00 C 39.63 138.98 39.62 106.96 39.63 74.94 Z"
                                        fill="#000000" />
                                    <path
                                        d="M 151.30 81.31 C 154.21 80.37 157.11 82.84 156.73 85.86 C 156.29 89.25 152.15 90.76 149.66 88.34 C 147.28 86.11 148.31 82.33 151.30 81.31 Z"
                                        fill="#000000" />
                                    <path
                                        d="M 150.38 101.43 C 151.84 101.43 153.30 101.44 154.77 101.46 C 154.73 124.66 154.76 147.86 154.75 171.06 C 153.29 171.06 151.83 171.06 150.38 171.06 C 150.37 147.85 150.36 124.64 150.38 101.43 Z"
                                        fill="#000000" />
                                </svg>
                            </a>
                        </li>
                        <li class="w-1/5">
                            @auth
                                <a href="{{ route(app()->getLocale() . '.profile.edit') }}"
                                    class="flex flex-col items-center">
                                    <svg class="w-7 h-auto" viewBox="0 0 20 20">
                                        <circle fill="none" stroke="currentColor" stroke-width="1.1" cx="9.9"
                                            cy="6.4" r="4.4"></circle>
                                        <path fill="none" stroke="currentColor" stroke-width="1.1"
                                            d="M1.5,19 C2.3,14.5 5.8,11.2 10,11.2 C14.2,11.2 17.7,14.6 18.5,19.2">
                                        </path>
                                    </svg>
                                    <div class="leading-none">аккаунт</div>
                                </a>
                            @else
                                <a href="{{ route(app()->getLocale() . '.login') }}" class="flex flex-col items-center">
                                    <svg class="w-7 h-auto" viewBox="0 0 20 20">
                                        <circle fill="none" stroke="currentColor" stroke-width="1.1" cx="9.9"
                                            cy="6.4" r="4.4"></circle>
                                        <path fill="none" stroke="currentColor" stroke-width="1.1"
                                            d="M1.5,19 C2.3,14.5 5.8,11.2 10,11.2 C14.2,11.2 17.7,14.6 18.5,19.2">
                                        </path>
                                    </svg>
                                    <div class="leading-none">аккаунт</div>
                                </a>
                            @endauth
                        </li>
                        <li class="w-1/5">
                            <a href="/cart" class="flex flex-col items-center">
                                <svg class="w-7 h-auto" viewBox="0 0 20 20">
                                    <circle cx="7.3" cy="17.3" r="1.4" fill="currentColor"></circle>
                                    <circle cx="13.3" cy="17.3" r="1.4" fill="currentColor"></circle>
                                    <polyline fill="none" stroke="currentColor"
                                        points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5">
                                    </polyline>
                                </svg>
                                <div class="leading-none">корзина</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class=" items-center gap-4 hidden lg:flex">
                    <div class="flex items-center gap-4">
                        <a href="tel:77750070625"
                            x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.whatsapp'})"
                            class="flex items-center gap-1 transition hover:text-gray-300">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20">
                                <path fill="none" stroke="currentColor"
                                    d="M15.5,17 C15.5,17.8 14.8,18.5 14,18.5 L7,18.5 C6.2,18.5 5.5,17.8 5.5,17 L5.5,3 C5.5,2.2 6.2,1.5 7,1.5 L14,1.5 C14.8,1.5 15.5,2.2 15.5,3 L15.5,17 L15.5,17 L15.5,17 Z">
                                </path>
                                <circle cx="10.5" cy="16.5" r=".8" stroke="currentColor"></circle>
                            </svg>
                            <span>+7 775 ПОЗВОНИТЬ</span>
                        </a>
                        <a href="/informaciya/kontakty"
                            class="items-center hidden gap-1 transition hover:text-gray-300 xl:flex" target="_blank"
                            rel="noopener noreferrer">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20" stroke="currentColor">
                                <path fill="none" stroke-width="1.01"
                                    d="M10,0.5 C6.41,0.5 3.5,3.39 3.5,6.98 C3.5,11.83 10,19 10,19 C10,19 16.5,11.83 16.5,6.98 C16.5,3.39 13.59,0.5 10,0.5 L10,0.5 Z">
                                </path>
                                <circle fill="none" cx="10" cy="6.8" r="2.3">
                                </circle>
                            </svg>
                            <span> АДРЕС МАГАЗИНА</span>
                        </a>
                        <a href="#"
                            x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.feedback', arguments: { link: location.href }})"
                            class="items-center hidden gap-1 transition hover:text-gray-300 lg:flex">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20" fill="currentColor">
                                <polygon
                                    points="13.1 13.4 12.5 12.8 15.28 10 8 10 8 9 15.28 9 12.5 6.2 13.1 5.62 17 9.5">
                                </polygon>
                                <polygon points="13 2 3 2 3 17 13 17 13 16 4 16 4 3 13 3"></polygon>
                            </svg>
                            <span> ЗАДАТЬ ВОПРОС</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="https://wa.me/77071222981" target="_blank" rel="nofollow noopener"
                            class="flex items-center gap-1 transition hover:text-gray-300">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M16.7,3.3c-1.8-1.8-4.1-2.8-6.7-2.8c-5.2,0-9.4,4.2-9.4,9.4c0,1.7,0.4,3.3,1.3,4.7l-1.3,4.9l5-1.3c1.4,0.8,2.9,1.2,4.5,1.2 l0,0l0,0c5.2,0,9.4-4.2,9.4-9.4C19.5,7.4,18.5,5,16.7,3.3 M10.1,17.7L10.1,17.7c-1.4,0-2.8-0.4-4-1.1l-0.3-0.2l-3,0.8l0.8-2.9 l-0.2-0.3c-0.8-1.2-1.2-2.7-1.2-4.2c0-4.3,3.5-7.8,7.8-7.8c2.1,0,4.1,0.8,5.5,2.3c1.5,1.5,2.3,3.4,2.3,5.5 C17.9,14.2,14.4,17.7,10.1,17.7 M14.4,11.9c-0.2-0.1-1.4-0.7-1.6-0.8c-0.2-0.1-0.4-0.1-0.5,0.1c-0.2,0.2-0.6,0.8-0.8,0.9 c-0.1,0.2-0.3,0.2-0.5,0.1c-0.2-0.1-1-0.4-1.9-1.2c-0.7-0.6-1.2-1.4-1.3-1.6c-0.1-0.2,0-0.4,0.1-0.5C8,8.8,8.1,8.7,8.2,8.5 c0.1-0.1,0.2-0.2,0.2-0.4c0.1-0.2,0-0.3,0-0.4C8.4,7.6,7.9,6.5,7.7,6C7.5,5.5,7.3,5.6,7.2,5.6c-0.1,0-0.3,0-0.4,0 c-0.2,0-0.4,0.1-0.6,0.3c-0.2,0.2-0.8,0.8-0.8,2c0,1.2,0.8,2.3,1,2.4c0.1,0.2,1.7,2.5,4,3.5c0.6,0.2,1,0.4,1.3,0.5 c0.6,0.2,1.1,0.2,1.5,0.1c0.5-0.1,1.4-0.6,1.6-1.1c0.2-0.5,0.2-1,0.1-1.1C14.8,12.1,14.6,12,14.4,11.9">
                                </path>
                            </svg>
                        </a>
                        <a href="https://t.me/M_Home_kz" target="_blank" rel="nofollow noopener"
                            class="flex items-center gap-1 transition hover:text-gray-300">
                            <svg class="w-5 h-auto" fill="currentColor" viewBox="0 0 300 300">
                                <path
                                    d="M5.299,144.645l69.126,25.8l26.756,86.047c1.712,5.511,8.451,7.548,12.924,3.891l38.532-31.412 c4.039-3.291,9.792-3.455,14.013-0.391l69.498,50.457c4.785,3.478,11.564,0.856,12.764-4.926L299.823,29.22 c1.31-6.316-4.896-11.585-10.91-9.259L5.218,129.402C-1.783,132.102-1.722,142.014,5.299,144.645z M96.869,156.711l135.098-83.207 c2.428-1.491,4.926,1.792,2.841,3.726L123.313,180.87c-3.919,3.648-6.447,8.53-7.163,13.829l-3.798,28.146 c-0.503,3.758-5.782,4.131-6.819,0.494l-14.607-51.325C89.253,166.16,91.691,159.907,96.869,156.711z">
                                </path>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/m_home.kz/" target="_blank" rel="nofollow noopener"
                            class="flex items-center gap-1 transition hover:text-gray-300">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13.55,1H6.46C3.45,1,1,3.44,1,6.44v7.12c0,3,2.45,5.44,5.46,5.44h7.08c3.02,0,5.46-2.44,5.46-5.44V6.44 C19.01,3.44,16.56,1,13.55,1z M17.5,14c0,1.93-1.57,3.5-3.5,3.5H6c-1.93,0-3.5-1.57-3.5-3.5V6c0-1.93,1.57-3.5,3.5-3.5h8 c1.93,0,3.5,1.57,3.5,3.5V14z">
                                </path>
                                <circle cx="14.87" cy="5.26" r="1.09"></circle>
                                <path
                                    d="M10.03,5.45c-2.55,0-4.63,2.06-4.63,4.6c0,2.55,2.07,4.61,4.63,4.61c2.56,0,4.63-2.061,4.63-4.61 C14.65,7.51,12.58,5.45,10.03,5.45L10.03,5.45L10.03,5.45z M10.08,13c-1.66,0-3-1.34-3-2.99c0-1.65,1.34-2.99,3-2.99s3,1.34,3,2.99 C13.08,11.66,11.74,13,10.08,13L10.08,13L10.08,13z">
                                </path>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/@-m-home2426" target="_blank" rel="nofollow noopener"
                            class="flex items-center gap-1 transition hover:text-gray-300">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M15,4.1c1,0.1,2.3,0,3,0.8c0.8,0.8,0.9,2.1,0.9,3.1C19,9.2,19,10.9,19,12c-0.1,1.1,0,2.4-0.5,3.4c-0.5,1.1-1.4,1.5-2.5,1.6 c-1.2,0.1-8.6,0.1-11,0c-1.1-0.1-2.4-0.1-3.2-1c-0.7-0.8-0.7-2-0.8-3C1,11.8,1,10.1,1,8.9c0-1.1,0-2.4,0.5-3.4C2,4.5,3,4.3,4.1,4.2 C5.3,4.1,12.6,4,15,4.1z M8,7.5v6l5.5-3L8,7.5z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class=" items-center gap-3 hidden lg:flex">
                    <a href="#" x-on:click.prevent="searching=true"
                        class="flex items-center gap-2 px-3 py-3 leading-tight text-gray-500 transition-all bg-white rounded hover:bg-gray-100 active:bg-gray-200 text-bm xl:px-4">
                        <svg class="w-5 h-auto" viewBox="0 0 20 20">
                            <circle fill="none" stroke="currentColor" stroke-width="1.1" cx="9"
                                cy="9" r="7"></circle>
                            <path fill="none" stroke="currentColor" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z">
                            </path>
                        </svg>
                        <span class="hidden mr-16 lg:block"> Поиск...</span>
                    </a>
                    @auth
                        <a href="{{ route(app()->getLocale() . '.profile.edit') }}"
                            class="flex items-center gap-2 px-3 py-3 leading-tight text-gray-500 transition-all bg-white rounded hover:bg-gray-100 active:bg-gray-200 text-bm xl:px-4">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20">
                                <circle fill="none" stroke="currentColor" stroke-width="1.1" cx="9.9"
                                    cy="6.4" r="4.4"></circle>
                                <path fill="none" stroke="currentColor" stroke-width="1.1"
                                    d="M1.5,19 C2.3,14.5 5.8,11.2 10,11.2 C14.2,11.2 17.7,14.6 18.5,19.2">
                                </path>
                            </svg>
                            <span class="hidden lg:block">Аккаунт</span>
                        </a>
                    @else
                        <a href="{{ route(app()->getLocale() . '.login') }}"
                            class="flex items-center gap-2 px-3 py-3 leading-tight text-gray-500 transition-all bg-white rounded hover:bg-gray-100 active:bg-gray-200 text-bm xl:px-4">
                            <svg class="w-5 h-auto" viewBox="0 0 20 20">
                                <circle fill="none" stroke="currentColor" stroke-width="1.1" cx="9.9"
                                    cy="6.4" r="4.4"></circle>
                                <path fill="none" stroke="currentColor" stroke-width="1.1"
                                    d="M1.5,19 C2.3,14.5 5.8,11.2 10,11.2 C14.2,11.2 17.7,14.6 18.5,19.2">
                                </path>
                            </svg>
                            <span class="hidden lg:block">Аккаунт</span>
                        </a>
                    @endauth
                    @livewire('cart')
                </div>
                <div x-show="searching" style="display:none"
                    class="absolute top-0 bottom-0 left-0 right-0 items-center gap-2 px-3 py-3 leading-tight text-gray-500 bg-white rounded text-bm xl:px-4 flex">
                    <input class="w-full bg-transparent border-0 outline-none" x-ref="inputsearch"
                        placeholder="Поиск..." x-model="query">
                    <svg class="w-5 h-auto cursor-pointer" x-on:click="searching=false" viewBox="0 0 15 15"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 1.5L13.5 13.5M1.5 13.5L13.5 1.5" stroke="currentColor" stroke-width="1"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <template x-if="!!searchObj">
                    <div class="absolute left-0 right-0 pt-4 lg:pt-20 text-base top-full -mx-2">
                        <div class="pt-2">
                            <div
                                class="z-10 flex flex-col max-h-[calc(100vh-6rem)] lg:max-h-none overflow-y-auto text-gray-500 bg-white rounded-lg min-h-16 xl:flex-row">
                                <div class="w-full px-2.5 lg:px-6 py-4 lg:py-8 lg:w-[20rem] shrink-0">
                                    <template x-if="!!searchObj.categories">
                                        <div class="lg:min-h-[10rem] mb-4 lg:mb-2">
                                            <div class="font-bold">Категории товаров</div>
                                            <template x-if="!!searchObj.categories.nbHits">
                                                <ul class="m-0 pl-0">
                                                    <template x-for="(c,cdx) of searchObj.categories.hits">
                                                        <li :key="cdx">
                                                            <a :href="c.url" x-text="c.name"
                                                                class="hover:text-green-500"></a>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </template>
                                            <template x-if="!searchObj.categories.nbHits">
                                                <ul class="m-0 pl-0">
                                                    <li>Не найдено</li>
                                                </ul>
                                            </template>
                                        </div>
                                    </template>
                                    <template x-if="!!searchObj.brands">
                                        <div class="lg:min-h-[10rem] mb-4 lg:mb-0">
                                            <div class="font-bold">Бренды</div>
                                            <template x-if="!!searchObj.brands.nbHits">
                                                <ul class="m-0 pl-0">
                                                    <template x-for="(c,cdx) of searchObj.brands.hits">
                                                        <li :key="cdx">
                                                            <a :href="c.url" x-text="c.name"
                                                                class="hover:text-green-500"></a>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </template>
                                            <template x-if="!searchObj.brands.nbHits">
                                                <ul class="m-0 pl-0">
                                                    <li>Не найдено</li>
                                                </ul>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                                <div class="px-2.5 lg:px-6 py-4 lg:py-8 grow bg-gray-50">
                                    <template x-if="!!searchObj.products">
                                        <div>
                                            <div class="mb-4 font-bold">Товары</div>
                                            <template x-if="!!searchObj.products.nbHits">
                                                <ul class="m-0 pl-0">
                                                    <li class="grid grid-cols-2 gap-2.5 lg:grid-cols-5">
                                                        <template x-for="(tizer, cdx) of searchObj.products.hits">
                                                            <div class="">
                                                                @include('store._tizerjs')
                                                            </div>
                                                        </template>
                                                        <a href="#"
                                                            class="flex items-center justify-center bg-white rounded-lg overflow-hidden shadow-lg px-2">
                                                            <span>Показать еще</span>
                                                            <svg width="12" height="13" viewBox="0 0 12 13"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M4 11.7L9.6 6.49999L4 1.29999"
                                                                    stroke="#303030" stroke-linecap="square" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <template x-if="category">
                                                        <li>
                                                            <a :href="category.url"
                                                                class="block py-4 bg-white rounded shadow hover:shadow-lg">
                                                                <div class="flex items-center justify-center gap-1">
                                                                    <div class="text-sm text-slate-600">
                                                                        Показать еще</div>
                                                                    <svg width="12" height="13"
                                                                        viewBox="0 0 12 13" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M4 11.7L9.6 6.5L4 1.3"
                                                                            stroke="currentColor"
                                                                            stroke-linecap="square" />
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </template>
                                            <template x-if="!searchObj.products.nbHits">
                                                <ul class="m-0 pl-0">
                                                    <li>Не найдено</li>
                                                </ul>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

</header>

<div class="sticky top-0 lg:py-2.5 z-30 bg-white lg:border-0">
    <div class="container">
        <nav class="lg:flex items-center justify-between hidden">
            <a href="/" aria-label="Вернуться в начало" class="uk-logo uk-navbar-item">
                <img loading="eager" width="150" height="50"
                    src="{{ Vite::asset('resources/images/logo.svg') }}"alt="">
            </a>
            {{ menu('top', 'menu.top') }}

            <a href="https://translate.google.com/translate?sl=auto&tl=kk&u={{ url()->current() }}"
                class="flex items-center gap-0.5 text-green-500 hover:text-primary-800">
                <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor">
                    <path fill="none" d="M1,10.5 L19,10.5"></path>
                    <path fill="none" d="M2.35,15.5 L17.65,15.5"></path>
                    <path fill="none" d="M2.35,5.5 L17.523,5.5"></path>
                    <path fill="none"
                        d="M10,19.46 L9.98,19.46 C7.31,17.33 5.61,14.141 5.61,10.58 C5.61,7.02 7.33,3.83 10,1.7 C10.01,1.7 9.99,1.7 10,1.7 L10,1.7 C12.67,3.83 14.4,7.02 14.4,10.58 C14.4,14.141 12.67,17.33 10,19.46 L10,19.46 L10,19.46 L10,19.46 Z">
                    </path>
                    <circle fill="none" cx="10" cy="10.5" r="9">
                    </circle>
                </svg>
                <span>RU</span>
                <span>/</span>
                <span>KZ</span>
            </a>
        </nav>
        <div class="relative">
            <template x-if="!!catalogShow">
                <div class="absolute left-0 right-0 pt-16 lg:pt-2 text-base top-full" x-data="catalog({!! htmlentities(json_encode($catalog, JSON_UNESCAPED_UNICODE)) !!})">
                    <div class="pt-2 relative -mx-2 lg:mx-auto">
                        <svg class="absolute z-10 w-4 h-4 cursor-pointer right-4 top-6" x-on:click="catalogShow=false"
                            viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1.5L13.5 13.5M1.5 13.5L13.5 1.5" stroke="#303030" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                        <div
                            class="z-10 lg:flex h-[calc(100vh-6rem)] overflow-y-auto text-gray-500 lg:rounded-lg bg-white lg:bg-zinc-100 lg:min-h-16 flex-row">
                            <div class="shrink-0 w-full lg:w-[24rem] py-8 px-6"
                                x-bind:class="category ? 'hidden lg:block' : ''">
                                <div class="mb-4 font-bold">Категории товаров</div>
                                <ul class="m-0 pl-0">
                                    <template x-for="(c,cdx) of categories">
                                        <li :key="cdx"
                                            class="flex items-center justify-between group cursor-pointer"
                                            x-on:mouseenter="!mobile && (category=c)"
                                            x-on:click="mobile && (category=c)"
                                            x-bind:class="{ 'font-bold': category && c.id === category.id }">
                                            <a :href="c.url"
                                                class="flex items-center justify-between gap-3 py-1.5 lg:py-3 group-hover:text-green-500 pointer-events-none lg:pointer-events-auto">
                                                <span x-html="c.icon"></span>
                                                <span x-text="c.name"></span>
                                            </a>
                                            <a href="#" x-show="c.children.length" x-cloak
                                                class="p-3 group-hover:text-green-500"
                                                x-on:click.prevent="category=c">
                                                <svg width="15" height="15" viewBox="0 0 15 15"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 14L12 7.5L5 1" stroke="currentColor"
                                                        stroke-linecap="square" />
                                                </svg>
                                            </a>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            <template x-if="category && category.children.length">
                                <div class="grow bg-white py-8 px-6 flex">
                                    <div class="grow">
                                        <div class="mb-4 font-bold lg:text-neutral-400 flex items-center gap-2"
                                            x-on:click="mobile && (category=null)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 lg:hidden">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                            </svg>
                                            <span x-text="category.name"></span>
                                        </div>
                                        <ul class="m-0 pl-0">
                                            <template x-for="(c,cdx) of category.children">
                                                <li :key="cdx" class="group cursor-pointer"
                                                    x-on:mouseenter="!mobile && (subcategory=c)"
                                                    x-on:click="mobile && (subcategory=c)">
                                                    <div class="flex items-center justify-between gap-3"
                                                        x-bind:class="{ 'font-bold': subcategory && c.id === subcategory.id }">
                                                        <a :href="c.url"
                                                            class="flex items-center justify-between gap-3 py-1.5 lg:py-3 hover:text-green-500 lg:pointer-events-auto"
                                                            x-bind:class="c.children.length ?
                                                                'pointer-events-none' : ''">
                                                            <span x-text="c.name"></span>
                                                        </a>
                                                        <a href="#" x-show="c.children.length"
                                                            style="display:none" class="p-3 hover:text-green-500"
                                                            x-on:click.prevent="subcategory=c">
                                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5 14L12 7.5L5 1" stroke="currentColor"
                                                                    stroke-linecap="square" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <template x-if="subcategory && c.id === subcategory.id">
                                                        <ul class="pl-8 text-sm m-0 pl-0">
                                                            <template x-for="(cc,cdx) of subcategory.children">
                                                                <li>
                                                                    <a :href="cc.url"
                                                                        class="flex items-center justify-between gap-3 py-1.5 lg:py-3 hover:text-green-500">
                                                                        <span x-text="cc.name"></span>
                                                                    </a>
                                                                </li>
                                                            </template>
                                                        </ul>
                                                    </template>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    <div class="hidden xl:block shrink-0">
                                        <template x-if="!!products.length">
                                            <ul class="grid grid-cols-4 gap-2 m-0 pl-0">
                                                <template x-for="(p,pdx) of products">
                                                    <li class="p-1 lg:p-0">
                                                        <a :href="p.url"
                                                            class="relative block lg:w-32 bg-white rounded shadow">
                                                            <div class="w-full pt-[96.25%] bg-cover bg-center"
                                                                :style="{ backgroundImage: `url('${p.images.length ? p.images[0] : '/storage/no-photo.png'}')` }">
                                                            </div>
                                                            <div class="p-2 text-xs text-zinc-800">
                                                                <div class="mb-2 line-clamp-3 h-[3rem]"
                                                                    x-text="p.name">
                                                                </div>
                                                                <template x-if="p.in_stock">
                                                                    <div
                                                                        class="bg-green-350 rounded px-1 py-0.5 text-xs text-white mb-3 text-center">
                                                                        В наличии</div>
                                                                </template>
                                                                <template x-if="!p.in_stock">
                                                                    <div
                                                                        class="bg-yellow-500 rounded px-1 py-0.5 text-xs text-white mb-3 text-center">
                                                                        Предзаказ</div>
                                                                </template>
                                                                <div class="font-bold" x-text="p.price_formatted">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </template>
                                                <li class="min-h-[8rem] p-1 lg:p-0 flex items-center justify-center ">
                                                    <a :href="category ? category.url : `/store`"
                                                        class="flex items-center justify-center w-32 gap-1 text-sm text-slate-600">
                                                        <div>Показать еще</div>
                                                        <svg width="12" height="12" viewBox="0 0 15 15"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 14L12 7.5L5 1" stroke="currentColor"
                                                                stroke-linecap="square" />
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </template>
                                    </div>
                                </div>
                            </template>
                            {{-- <div class="relative px-6 pb-8 lg:pt-8 grow bg-zinc-100">
                                <template x-if="!products.length">
                                    <div class="absolute -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
                                        <svg class="inline-block w-12 h-12 ml-3 -mr-1 text-gray-500 animate-spin"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </template>

                                <template x-if="!!products.length">
                                    <ul class="flex flex-wrap gap-0 lg:gap-2 m-0 pl-0">
                                        <template x-for="(p,pdx) of products">
                                            <li class="w-1/2 lg:w-auto p-1 lg:p-0">
                                                <a :href="p.url"
                                                    class="relative block lg:w-32 bg-white rounded shadow">
                                                    <div class="w-full pt-[96.25%] bg-cover bg-center"
                                                        :style="{ backgroundImage: `url('${p.images.length ? p.images[0] : '/storage/no-photo.png'}')` }">
                                                    </div>
                                                    <div class="p-2 text-xs text-zinc-800">
                                                        <div class="mb-2 line-clamp-3 h-[3rem]" x-text="p.name">
                                                        </div>
                                                        <div class="font-bold" x-text="p.price_formatted"></div>
                                                    </div>
                                                </a>
                                            </li>
                                        </template>
                                        <li class="w-1/2 lg:w-auto p-1 lg:p-0 flex items-center justify-center">
                                            <a :href="category ? category.url : `/store`"
                                                class="flex items-center justify-center w-64 gap-1 text-sm text-slate-600">
                                                <div>Показать еще</div>
                                                <svg width="12" height="12" viewBox="0 0 15 15"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 14L12 7.5L5 1" stroke="currentColor"
                                                        stroke-linecap="square" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

