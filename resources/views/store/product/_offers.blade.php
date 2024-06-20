@if ($product->offers()->count() > 1)
    <div
        class="grid grid-cols-2 @if ($product->offers()->count() === 3 || $product->offers()->count() > 4) lg:grid-cols-3 @endif  p-2.5 gap-2.5 rounded bg-gray-25 text-sm my-5">
        @foreach ($product->offers as $of)
            <a href="{{ route(app()->getLocale() . '.product', [
                'product' => $of->slug,
            ]) }}"
                class="text-center rounded py-2 px-3 transition shadow hover:shadow-lg {{ $offer && $offer->id === $of->id ? 'bg-green-200 text-white' : 'bg-white' }}">
                <span>{{ $of->sname }}</span>
                <span class="whitespace-nowrap">
                    ({{ number_format($of->price, 0, '.', ' ') . ' ₸' }})
                </span>
                @if ($of->in_stock)
                    <span>🟢&nbsp;В&nbsp;наличии</span>
                @else
                    <span>🟠&nbsp;Ожидаем</span>
                @endif
            </a>
        @endforeach
    </div>
@endif
