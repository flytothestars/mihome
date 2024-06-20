<x-app-layout>
    <div class="container">
        <h1 class="mb-5 text-2xl text-center uk-heading-line lg:text-4xl my-0"> <span>Все товары {{ $brand->name }}</span>
        </h1>
        <div class=" grid-cols-4 gap-6 hidden lg:grid my-8">
            <div class="pr-8 border-r">
                <img class="my-5 block" src="{{ Voyager::image($brand->image) }}" alt="{{ $brand->name }}" />
            </div>
            <div class="my-5 prose max-w-none col-span-3">{!! $brand->description !!}</div>
        </div>

        <ul class="m-0 p-0 mb-5 flex gap-2.5 items-center justify-center flex-wrap text-sm my-8">
            <li class="">
                <a class="block subnavstyle rounded py-0.5 px-1.5 {{ !$category ? 'bg-green-400 text-white' : 'bg-gray-200 hover:bg-gray-300' }}"
                    href="{{ route(app()->getLocale() . '.manufacturers.show', [
                        'manufacturer' => $brand->slug,
                    ]) }}"
                    role="button">Все
                    товары</a>
            </li>
            @foreach ($categories as $c)
                <li class="">
                    <a class="block subnavstyle rounded py-0.5 px-1.5 {{ $category && $category->slug === $c['slug'] ? 'bg-green-400 text-white' : 'bg-gray-200 hover:bg-gray-300' }}"
                        href="{{ route(app()->getLocale() . '.manufacturers.show', [
                            'manufacturer' => $brand->slug,
                            'category' => $c['slug'],
                        ]) }}"
                        role="button" x-text="'{{ $c['name'] }}'.replace(/xiaomi/ig, '')"></a>
                </li>
            @endforeach
        </ul>

        <div class="w-full lg:w-auto lg:grow">
            <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-2.5">
                @foreach ($products as $tizer)
                    @include('store._tizer')
                @endforeach
            </div>
            <div class="flex justify-center py-6">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
