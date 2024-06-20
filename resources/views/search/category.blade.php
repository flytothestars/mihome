<x-app-layout>
    <div class="container" x-data="category">
        {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('category', $category) }}
        @if ($category)
            <h1 class="mb-5 text-2xl text-center uk-heading-line lg:text-4xl my-0">
                <span>{{ $category->name }}</span>
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5 my-5">
                @foreach ($category->children as $child)
                    <a href="{{ $child->url }}"
                        class="flex overflow-hidden text-white transition bg-green-300 rounded-lg hover:bg-green-400 hover:shadow-xl">
                        @if (!empty($child->webp))
                            <div class="w-[4.5rem] h-[4.5rem] bg-cover bg-center shrink-0"
                                style="background-image:url('{{ $child->webp[1] }}')">
                            </div>
                        @endif
                        <div class="grow p-2.5">
                            <div class="text-lg leading-tight h-[2.75rem] overflow-hidden line-clamp-2 text-ellipsis">
                                {{ $child->name }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5 my-5">
                @foreach ($categories as $child)
                    <a href="{{ $child['url'] }}"
                        class="flex overflow-hidden text-white transition bg-green-300 rounded-lg hover:bg-green-400 hover:shadow-xl">
                        @if (!empty($child['webp']))
                            <div class="w-[4.5rem] h-[4.5rem] bg-cover bg-center shrink-0"
                                style="background-image:url('{{ $child['webp'][1] }}')">
                            </div>
                        @endif
                        <div class="grow p-2.5">
                            <div class="text-lg leading-tight h-[2.75rem] overflow-hidden line-clamp-2 text-ellipsis">
                                {{ $child['name'] }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif


        <div class="flex flex-wrap lg:flex-nowrap gap-2.5">
            <div class="w-full lg:w-1/4 xl:w-1/5 lg:shrink-0">
                @include('store._filter')
            </div>
            <div class="w-full lg:w-auto lg:grow">


                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2.5">
                    @foreach ($products as $tizer)
                        @include('store._tizer')
                    @endforeach
                </div>
                <div class="flex justify-center py-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
