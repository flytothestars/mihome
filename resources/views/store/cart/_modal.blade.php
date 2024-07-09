<div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
        <div x-cloak x-on:click="modelOpen = false" x-show="modelOpen"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true">
        </div>
        <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
            <div id="bd_results" role="region" aria-live="polite">
                <div id="cf_res_ajax_loader"></div>
                <div class="product-container">
                    <p>Товар:</p>
                    <p class="uk-h3 uk-margin-remove">
                        {!! $product->name !!}</p>
                    <p>Для оформления <b>Покупки</b>
                        - выберите доступный вариант
                        товара и нажмите
                        на кнопку <b>В
                            корзину</b></p>

                    @foreach ($product->offers as $offer)
                        <div class="uk-alert">
                            <div class="uk-grid-collapse uk-width-1-1 uk-flex-between uk-grid" uk-grid="">
                                <div class="uk-width-2-5 uk-first-column">
                                    <div class="uk-text-bold">
                                        {!! $offer->getTranslatedAttribute('name') !!}
                                    </div>
                                    <div class="uk-grid-collapse uk-grid" uk-grid="">
                                        <div class="product-price uk-first-column" id="productPrice3222"
                                            data-vm="product-prices">
                                            <span class="price-crossed">
                                                <div class="PricebasePriceWithTax vm-nodisplay">
                                                    <span class="PricebasePriceWithTax"></span>
                                                </div>
                                            </span>
                                            <div class="PricesalesPrice vm-display vm-price-value">
                                                <span
                                                    class="PricesalesPrice">{{ number_format($offer->price, 0, '.', ' ') . ' ₸' }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            &nbsp;🟢&nbsp;Готов
                                        </div>
                                    </div>
                                </div>
                                <div class="addtocart-area" x-data="cart()" x-init="init()">
                                    <div x-show="added" class="fixed inset-0 z-50 overflow-y-auto"
                                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div
                                            class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                            <div x-cloak x-on:click="added = false" x-show="added"
                                                x-transition:enter="transition ease-out duration-300 transform"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition ease-in duration-200 transform"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                                aria-hidden="true">
                                            </div>
                                            <div x-cloak x-show="added" style="width:90%"
                                                x-transition:enter="transition ease-out duration-300 transform"
                                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave="transition ease-in duration-200 transform"
                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                                <div class="inner-content">
                                                    <div class="uk-panel">
                                                        <h4 class="uk-h4 uk-text-bold" x-text="tempItem.name">
                                                        </h4>
                                                        <hr>
                                                        <div id="cartalert" class="uk-width-1-1">
                                                        </div>
                                                        <div class="uk-width-1-1 flex justify-between mt-5">
                                                            <a x-on:click.prevent="added=false"
                                                                class="uk-modal-close uk-float-left uk-special-cartclose uk-link uk-button uk-button-primary uk-width-1-1 uk-width-auto@l uk-width-auto@m uk-width-auto@s uk-margin-small-bottom"
                                                                href="#">Продолжить
                                                                покупки</a><a
                                                                class="show-shop-btn btn-all uk-link uk-float-right uk-button uk-button-primary uk-special-addtocart uk-width-1-1 uk-width-auto@l uk-width-auto@m uk-width-auto@s uk-margin-small-bottom"
                                                                href="/cart" target="_parent">
                                                                <span uk-icon="icon: cart"
                                                                    class="uk-margin-small-right uk-icon"></span>Показать
                                                                корзину</a>
                                                        </div>
                                                        <div class="uk-clearfix">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($offer->in_stock)
                                        <div x-data="{ quantity: 1 }" class="product js-recalculate" action="#">
                                            <div class="addtocart-bar">
                                                <span class="quantity-box">
                                                    <input type="text" x-model="quantity"
                                                        class="quantity-input js-recalculate uk-input" name="quantity[]"
                                                        style="width: 40px !important;" :value="quantity"
                                                        data-step="1">
                                                </span>
                                                <span class="quantity-controls js-recalculate uk-button-group">
                                                    <button type="button" x-on:click="quantity++"
                                                        class="quantity-controls btn-all quantity-plus uk-button uk-button-default">
                                                        +
                                                    </button>
                                                    <button type="button"
                                                        x-on:click="quantity > 1 ? quantity-- : null"
                                                        class="quantity-controls btn-all quantity-minus uk-button uk-button-default">
                                                        -
                                                    </button>
                                                </span>
                                                <span class="addtocart-button"
                                                    x-on:click="addItem({{ json_encode($offer) }})">
                                                    <input type="submit" name="addtocart"
                                                        class="addtocart-button  uk-button uk-button-primary"
                                                        value="В корзину" title="В корзину">
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <form method="post" class="product js-recalculate" action="#"
                                            autocomplete="off">
                                            <div class="addtocart-bar">
                                                <!-- START: Modals --><a data-modals=""
                                                    class="uk-button uk-button-default"
                                                    href="/store/xiaomi-redmi-buds-5-blue?layout=notify&amp;ml=1"
                                                    data-modals-height="100%" data-modals-width="430"
                                                    data-modals-group="_group_0" data-modals-done="true">Предзаказ</a>
                                                <!-- END: Modals -->
                                            </div>
                                            <input type="hidden" name="option" value="com_virtuemart">
                                            <input type="hidden" name="view" value="cart">
                                            <input type="hidden" name="virtuemart_product_id[]" value="3248">
                                            <input type="hidden" name="pname"
                                                value="Наушники Xiaomi Redmi Buds 5 - Синие">
                                            <input type="hidden" name="pid" value="3248">
                                            <input type="hidden" name="Itemid" value="1199">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
