<x-app-layout>
    <div x-data="page">
        <div class="container">
            <h1 class="uk-heading-line text-center text-2xl lg:text-4xl mb-5">
                {{ $page->getTranslatedAttribute('title') }}</h1>
        </div>
        @if ($page->webp)
            <div class="container relative">
                <a class="swiper-prev absolute top-1/2 -translate-y-full left-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#" uk-slidenav-previous="" uk-slideshow-item="previous" role="button"
                    aria-controls="uk-slideshow-1" aria-label="Previous slide">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                        </polyline>
                    </svg>
                </a>
                <div class="swiper my-5" x-ref="banners">
                    <div class="swiper-wrapper">
                        @foreach ($page->webp as $image)
                            <div class="swiper-slide">
                                <a data-fancybox href="{{ isset($image[0]) ? $image[0] : '' }}">
                                    <img class="w-full" src="{{ isset($image[0]) ? $image[0] : '' }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a class="swiper-next absolute top-1/2 -translate-y-full right-6 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
                    href="#" uk-slidenav-previous="" uk-slideshow-item="previous" role="button"
                    aria-controls="uk-slideshow-1" aria-label="Previous slide">
                    <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                        <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                        </polyline>
                    </svg>
                </a>
                <div class="swiper-pagination relative"></div>
            </div>
        @endif
        <div class="container">
            <div class="prose max-w-none">
                {!! $fulltext !!}
            </div>
        </div>
        @if (isset($promotions) && isset($ptypes))
        <style>
            .hidden { display: none; }
        </style>
        <div class="container my-5">
            <ul class="m-0 p-0 mb-5 flex gap-2.5 items-center justify-center flex-wrap text-sm">
                <li class="rounded py-0.5 px-1.5 bg-gray-200 hover:bg-gray-300" onclick="filterTizers('all', this)">
                    <a class="subnavstyle" href="#" role="button">Все</a>
                </li>
                @foreach($ptypes as $ptype)
                <li class="rounded py-0.5 px-1.5 bg-gray-200 hover:bg-gray-300" onclick="filterTizers('{{$ptype->id}}', this)">
                    <a class="subnavstyle" href="#" role="button">{{$ptype->title}}</a>
                </li>
                @endforeach
            </ul>
            <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-2.5" id="tizerContainer">
                @foreach ($promotions as $tizer)
                <div class="tizer" data-type="{{$tizer->is_type}}">
                    @include('promotions._tizer')
                </div>
                @endforeach
            </div>
        </div>
        <script>
        function filterTizers(type, element) {
            var tizers = document.querySelectorAll('#tizerContainer .tizer');
            var items = document.querySelectorAll('ul > li');
    
            // Убираем класс активного состояния у всех элементов <li>
            items.forEach(function(item) {
                item.classList.remove('bg-green-400', 'text-white');
                item.classList.add('bg-gray-200', 'hover:bg-gray-300');
            });
    
            // Добавляем класс активного состояния текущему элементу <li>
            element.classList.remove('bg-gray-200', 'hover:bg-gray-300');
            element.classList.add('bg-green-400', 'text-white');
    
            // Фильтрация тизеров
            tizers.forEach(function(tizer) {
                if (type === 'all' || tizer.getAttribute('data-type') === type) {
                    tizer.classList.remove('hidden');
                } else {
                    tizer.classList.add('hidden');
                }
            });
        }
    
        // Default to show all tizers on page load
        document.addEventListener('DOMContentLoaded', function() {
            var allButton = document.querySelector('li[onclick^="filterTizers(\'all\'"]');
            filterTizers('all', allButton);
        });
        </script>
        @endif
        @if (isset($products))
            <div class="container my-5" x-data="products">
                <ul class="m-0 p-0 mb-5 flex gap-2.5 items-center justify-center flex-wrap text-sm">
                    <li class="rounded py-0.5 px-1.5 "
                        :class="!category ? 'bg-green-400 text-white' : 'bg-gray-200 hover:bg-gray-300'">
                        <a class="subnavstyle" href="#" role="button" x-on:click.prevent="category=null">Все
                            товары</a>
                    </li>
                    <template x-for="(cat,cdx) in categories">
                        <li class="rounded py-0.5 px-1.5 "
                            :class="category && category.slug === cat.slug ? 'bg-green-400 text-white' :
                                'bg-gray-200 hover:bg-gray-300'">
                            <a class="subnavstyle" href="#" x-on:click.prevent="category=cat" role="button"
                                x-text="cat.name.replace(/xiaomi/ig, '')"></a>
                        </li>
                    </template>
                </ul>
                <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-2.5">
                    @foreach ($products as $tizer)
                        @include('store._tizer')
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    
</x-app-layout>
