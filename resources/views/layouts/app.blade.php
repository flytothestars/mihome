<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>{{ $meta_title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="robots" content="noindex, nofollow"/>
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:image" content="{{$meta_image}}">
    <meta property="og:url" content="{{ $meta_url }}">

    <script>
        var properties = {!! json_encode($properties, JSON_UNESCAPED_UNICODE) !!}
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->

    {!! $shemaOrganization !!}
    {!! $shemaBreadCumbs !!}

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link href="/css/joomla-fontawesome.min.css" rel="preload" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="/css/wjcallback.css" rel="stylesheet" />
    <link href="/css/calendar.min.css" rel="stylesheet" />
    <link href="/css/style.min.css" rel="stylesheet" />
    <link href="/css/theme-dark.min.css" rel="stylesheet" />
    <link href="/css/joomla-alert.min.css" rel="stylesheet" />
    <link href="/css/facebox.css" rel="stylesheet" />
    <link href="/css/content.css" rel="stylesheet" />
    <link href="/css/vmuikit.css" rel="stylesheet" />
    <link href="/css/theme.13.css" rel="stylesheet" />
    <link href="/modals/css/style.min.css" rel="stylesheet" />
    <style>
        .form-horizontal .control-label {
            width: 250px;
            !important;
        }
    </style>
    <script src="/modals/js/script.min.js" defer type="module"></script>
    <script src="/js/uikit.min.js"></script>
    <script src="/js/uikit-icons-design-bites.min.js"></script>
    <script src="/js/theme.js"></script>
    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="app">
    @include('layouts.header')
    <div class="relative pt-2">
        <main class="pt-12 lg:pt-2 pb-12">
            @if (!empty($advs))
                <div class="container">
                    <div class="swiper my-5" style="overflow:visible !important" x-ref="advs"
                        data-count="{{ $advs->count() }}">
                        <div class="swiper-wrapper">
                            @foreach ($advs as $adv)
                                <div class="swiper-slide">
                                    <div class="proses max-w-none rounded-lg shadow-lg py-3 px-6">
                                        {!! $adv->text !!}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="container">
                <div class="flex items-center justify-between pb-3 pt-4 gap-4 lg:hidden text-green-500">
                    <a href="tel:77750070625"
                        x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.whatsapp'})"
                        class="flex items-center gap-1 transition hover:text-gray-300">
                        <svg class="w-5 h-auto" viewBox="0 0 20 20">
                            <path fill="none" stroke="currentColor"
                                d="M15.5,17 C15.5,17.8 14.8,18.5 14,18.5 L7,18.5 C6.2,18.5 5.5,17.8 5.5,17 L5.5,3 C5.5,2.2 6.2,1.5 7,1.5 L14,1.5 C14.8,1.5 15.5,2.2 15.5,3 L15.5,17 L15.5,17 L15.5,17 Z">
                            </path>
                            <circle cx="10.5" cy="16.5" r=".8" stroke="currentColor"></circle>
                        </svg>
                        <span>+7 775 007 06 25</span>
                    </a>
                    <a href="/informaciya/kontakty" class="items-center gap-1 transition hover:text-gray-300 flex"
                        target="_blank" rel="noopener noreferrer">
                        <svg class="w-5 h-auto" viewBox="0 0 20 20" stroke="currentColor">
                            <path fill="none" stroke-width="1.01"
                                d="M10,0.5 C6.41,0.5 3.5,3.39 3.5,6.98 C3.5,11.83 10,19 10,19 C10,19 16.5,11.83 16.5,6.98 C16.5,3.39 13.59,0.5 10,0.5 L10,0.5 Z">
                            </path>
                            <circle fill="none" cx="10" cy="6.8" r="2.3">
                            </circle>
                        </svg>
                        <span> АДРЕС МАГАЗИНА</span>
                    </a>
                </div>
            </div>
            {{ $slot }}
        </main>
        @include('layouts.footer')
        <div class="hidden">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2"></div>
        </div>

        <div class="absolute top-0 bottom-0 left-0 right-0 z-20 bg-white lg:bg-black lg:bg-opacity-40"
            style="display:none" x-show="bodycover" x-on:click="searching=false;catalogShow=false;"></div>
        <div class="h-px absolute" x-on:resize.window="mobile = (window.innerWidth < 960) ? true : false">&nbsp;</div>
    </div>

    <a href="#" x-on:click.prevent="Livewire.dispatch('openModal', { component: 'modals.whats-app' })"
        class="whatsapp uk-position-fixed">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            style="width: 100%; height: 100%; fill: rgb(255, 255, 255); stroke: none;">
            <path
                d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z">
            </path>
        </svg>
    </a>
    @livewire('wire-elements-modal')
    @livewireScriptConfig
    <!--onpage script, should be added once, before closing </body> -->
    <script>
        (function(d, s, id) {
            var js, kjs;
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://kaspi.kz/kaspibutton/widget/ks-wi_ext.js';
            kjs = document.getElementsByTagName(s)[0]
            kjs.parentNode.insertBefore(js, kjs);
        }(document, 'script', 'KS-Widget'));
    </script>
</body>

</html>
