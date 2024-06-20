<x-app-layout>
    <div class="container">
        <h1 class="mb-5 text-2xl text-center uk-heading-line lg:text-4xl my-0"> <span>Производители и бренды экосистемы
                Xiaomi</span> </h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-2.5 gap-y-5">
            @foreach ($brands as $brand)
                <a href="{{ $brand->url }}"
                    class="block p-1 text-center transition bg-white border rounded-lg shadow hover:shadow-xl">
                    <div class="block w-full bg-cover bg-center pt-[96.25%]"
                        style="background-image:url('{{ Voyager::image($brand->image) }}')">
                    </div>
                    <div class="my-5 text-lg">{{ $brand->name }}</div>
                    <div class="my-5 line-clamp-6">{!! $brand->description !!}</div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
