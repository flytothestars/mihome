<x-app-layout>
    <div class="container">
        <div class="flex gap-8">
            <div class="w-full lg:max-w-[20rem] shrink-0 text-zinc-800">
                @include('profile.partials._aside', [
                    'active' => 'orders',
                ])
            </div>
            <div class="grow">
                <div class="text-zinc-800 text-2xl font-bold mb-6">Мои заказы</div>
                @if ($orders->count())
                    <table class="table-auto w-full my-8">
                        <thead>
                            <tr class="border-t">
                                <th class="text-left text-zinc-400 font-semibold py-2 px-3">Номер заказа</th>
                                <th class="text-left text-zinc-400 font-semibold py-2 px-3">Товары</th>
                                <th class="text-zinc-400 font-semibold py-2 px-3">Количество</th>
                                <th class="text-zinc-400 font-semibold py-2 px-3">Сумма</th>
                                <th class="text-zinc-400 font-semibold py-2 px-3">Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-t" style="cursor: pointer;" data-href="{{route(app()->getLocale() . '.order.show',['token' => $order->token])}}">
                                    <td class="text-zinc-800 py-2 px-3">
                                        <div class="font-semibold mb-0.5">Заказ №{{ $order->id }}</div>
                                        <div class="text-zinc-400 text-sm">
                                            {{ \Illuminate\Support\Carbon::parse($order->created_at)->isoFormat('D MMMM Y г.') }}
                                        </div>
                                    </td>
                                    <td class="text-zinc-800 py-2 px-3">
                                        <div class="flex items-center gap-2.5 flex-wrap">
                                            @foreach ($order->items as $item)
                                                @if (isset($item->offer) &&
                                                        isset($item->offer->product) &&
                                                        isset($item->offer->product->webp) &&
                                                        isset($item->offer->product->webp[0]) &&
                                                        isset($item->offer->product->webp[0][1]))
                                                @endif
                                                <a href="{{ $item->offer->url }}"
                                                    style="background-image:url('{{ $item->offer->product->webp[0][1] }}')"
                                                    class="w-10 h-10 rounded-lg bg-center bg-contain bg-no-repeat shadow"></a>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center text-zinc-800 py-2 px-3">
                                        <div class="font-semibold">x {{ $order->items()->count() }}</div>
                                    </td>
                                    <td class="text-center text-zinc-800 py-2 px-3">
                                        <div class="font-semibold">{{ $order->totalText }}</div>
                                    </td>
                                    <td class="text-zinc-800 py-2 px-3">
                                        <div class="flex justify-center">
                                            <div
                                                class="text-center text-white text-xs font-bold p-1 rounded-md"style="background:{{ $order->status->color }}">
                                                {{ $order->status->title }}</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center">
                        {{ $orders->links() }}
                    </div>
                @else
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
