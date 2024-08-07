<x-app-layout>
    <div class="container">
        <h4 class="uk-margin-bottom-remove">Сведения о заказе</h4>
        <div class="order-summary uk-width-1-1">
            <div class=" uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Номер заказа</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2">M17786-230424</div>
            </div>
            <div class=" uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Дата заказа</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2">{{$order->created_at}}</div>
            </div>
            <div class=" uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Статус заказа</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2">Подтвержден покупателем</div>
            </div>
            <div class=" uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Последнее обновление</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2">23.04.2024</div>
            </div>
            <div class=" uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Отгрузки</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2"><span
                        class="vmshipment_name">Самовывоз</span><span class="vmshipment_description"> (В день
                        заказа)</span></div>
            </div>
            <div class=" uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Способ оплаты</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2"> <span class="vmpayment_name">{{$order->paymentMethod->name}}</span></div>
            </div>
            <div class=" uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Заметка покупателя</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2"></div>
            </div>
            <div class="uk-grid uk-margin-small-top">
                <div class="titles uk-width-1-3@l uk-width-1-2@s uk-width-1-2">Всего</div>
                <div class="values uk-width-2-3@l uk-width-1-2@s uk-width-1-2">{{ $order->sum }} ₸</div>
            </div>
        </div>
        <hr>
        <div class="order-adresses uk-grid-divider uk-grid" uk-grid="">
            <div class="bill-to uk-width-1-2@l uk-width-1-1@s uk-float-left uk-first-column">
                <h4 class="uk-margin-bottom-remove">Детали оплаты</h4>
                <hr class="uk-hr">
                <div class="spacer"> 
                    <span class="grouped"> 
                        <span class="titles">Эл.почта</span> 
                        <span class="values">{{ $order->email }}</span> 
                    </span> 
                    <span class="grouped"> 
                        <span class="titles">Имя</span> 
                        <span class="values">{{ $order->name }}</span> 
                    </span> 
                    <span class="grouped">
                        <span class="titles">Фамилия</span> 
                        <span class="values">{{ $order->lastname }}</span>
                    </span> 
                    <span class="grouped"> 
                        <span class="titles">Адрес</span> 
                        <span class="values"> No data </span>
                    </span> 
                    <span class="grouped"> 
                        <span class="titles">Город</span> 
                        <span class="values"> No data </span>
                    </span> 
                    <span class="grouped"> 
                        <span class="titles">Телефон</span> 
                        <span class="values">{{ $order->phone }}</span> 
                    </span> 
                </div>
            </div>
            <div class="ship-to uk-width-1-2@l uk-width-1-1@s uk-border-box uk-float-left">
            </div>
        </div>
        <hr class="uk-hr">
        <h4 class="uk-margin-bottom-remove">Корзина покупателя</h4>
        <div class="order-cart">
            <div class="product uk-width-1-1">
                @foreach($order->items as $item)
                <div class="spacer uk-grid" uk-grid="">
                    <div class="uk-width-1-5 uk-visible@l uk-first-column">
                        <div class="thumbnail uk-text-center"> <a href="{{$item->offer->url}}">
                                <picture>
                                    <img class="vmuikit-thumbnail vmuikit-thumbnail-mini" border=""
                                        alt="xiaomi-yeelight-drawer-light_1.jpg"
                                        src="https://rent2go.kz/storage/{{ $item->offer->product->images[0]->link }}"
                                        width="366" height="431" loading="lazy">
                                </picture>
                            </a> </div>
                    </div>
                    <div class="uk-width-4-5@l uk-width-1-1@s uk-float-left">
                        <div class="top-row uk-grid">
                            <div
                                class="uk-text-large uk-text-bold uk-float-left uk-width-2-5@l uk-width-1-1@s uk-width-1-1">
                                <div class="spacer"> <a href="{{$item->offer->url}}"
                                        class="uk-link">{{ $item->offer->name }}</a>
                                </div>
                            </div>
                            <div
                                class="uk-text-success uk-text-bold uk-float-right uk-width-1-5@l uk-width-1-3@s uk-width-1-3">
                                <div class="spacer"> {{ $item->price }} ₸ </div>
                            </div>
                            <div
                                class="quantity uk-float-right uk-width-1-5@l uk-width-1-3@s uk-width-1-3 uk-text-left-small">
                                <div class="spacer"> {{ $item->quantity }} </div>
                            </div>
                            <div
                                class="uk-text-success uk-text-bold uk-float-right uk-width-1-5@l uk-width-1-3@s uk-width-1-3 uk-text-left-small">
                                <div class="spacer"> 2 990 ₸ </div>
                            </div>
                        </div>
                        <hr class="uk-hr uk-margin-small">
                        <div class="bottom-row uk-grid" uk-grid="">
                            <div
                                class="info uk-width-1-3@l uk-width-1-3@s uk-width-1-1 uk-text-left-small uk-first-column">
                                <div class="spacer ">
                                    <div class="sku"> Артикул: {{ $item->offer->article }} </div>
                                </div>
                            </div>
                            <div class="tax-discount uk-width-1-3@l uk-width-1-3@s uk-width-1-1">
                                <div class="spacer"> <span class="tax">Налог: 0 ₸</span> <span
                                        class="discount">Скидка: {{ $item->offer->discount }} ₸</span> </div>
                            </div>
                            <div class="status uk-width-1-3@l uk-width-1-3@s uk-width-1-1">
                                <div class="spacer"> Статус товара: Подтвержден покупателем </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="uk-hr uk-margin-small">
                @endforeach
            </div>
            <div class="uk-clearfix"></div>
            <div class="price-summary uk-content">
                <div class="spacer">
                    <ul class="uk-list uk-list-striped">
                        <li>
                            <div class="uk-width-1-1 uk-grid">
                                <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    Итого</div>
                                <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    {{ $order->sum }} ₸</div>
                                <div class="clear"></div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-width-1-1 uk-grid">
                                <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    Стоимость обработки и доставки</div>
                                <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    0 ₸</div>
                                <div class="clear"></div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-width-1-1 uk-grid">
                                <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    Комиссия</div>
                                <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    299 ₸</div>
                                <div class="clear"></div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-width-1-1 uk-grid">
                                <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    Скидка</div>
                                <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    299 ₸</div>
                                <div class="clear"></div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-width-1-1 uk-grid">
                                <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    Налог</div>
                                <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    0 ₸</div>
                                <div class="clear"></div>
                            </div>
                        </li>
                        <li>
                            <div class="order-total uk-width-1-1 uk-grid">
                                <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    Всего</div>
                                <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2 uk-text-right">
                                    {{ $order->sum }} ₸</div>
                                <div class="clear"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h4 class="uk-margin-bottom-remove">Последние изменения статуса</h4>
        <div class="order-history uk-width-1-1">
            <div class="spacer">
                <div class="titles uk-width-1-1">
                    <div class="status uk-width-2-5@l uk-width-1-1@s uk-width-1-3@m">
                        <div class="spacer"> Статус заказа </div>
                    </div>
                    <div class="comment uk-width-3-5 uk-width-3-5@l uk-visible@l uk-width-2-3@m">
                        <div class="spacer"> Комментарий </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="values uk-grid" uk-grid="">
                    <div class="status uk-width-2-5@l uk-width-1-1@s uk-width-1-3@m uk-first-column">
                        <div class="spacer"> Подтвержден покупателем <span>Дата: Вторник, 23 апреля 2024,
                                05:43</span> </div>
                    </div>
                    <div class="comment uk-width-3-5 uk-width-3-5@l uk-visible@l uk-width-2-3@m">
                        <div class="spacer"> </div>
                    </div>
                    <div class="clear uk-grid-margin uk-first-column"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
