<x-app-layout>
    <div class="container text-center">
        <h3 class="text-2xl font-bold">Спасибо за Ваш заказ!</h3>
        <div class="message">
            <div class="spacer">
                <div class="post_payment_payment_name" style="width: 100%">
                    <span class="post_payment_payment_name_title">Способ оплаты </span>

                    <span class="vmpayment_name">{{ $order->paymentMethod->title }}</span>
                </div>
                <div class="post_payment_order_number" style="width: 100%"> <span
                        class="post_payment_order_number_title">Номер заказа </span> {{ $order->id }}</div>
                <div class="post_payment_order_total" style="width: 100%"> <span
                        class="post_payment_order_total_title">Всего </span> {{ $order->totalText }}</div> <a
                    class="uk-button uk-button-primary uk-margin-small-top " href="/order/{{ $order->token }}">Показать
                    ваш заказ</a>
            </div>
        </div>
    </div>
</x-app-layout>
