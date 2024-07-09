<x-app-layout>
    <div class="container">
        <div id="cart-contents" x-data="cart()" x-init="init()"
            class="uk-grid-divider uk-grid-margin uk-grid" uk-grid="">
            <div id="leftdiv"
                class="uk-width-1-1 uk-width-3-5@l uk-width-3-5@m uk-width-1-1@s uk-border-rounded uk-first-column">
                <div class="uk-width-1-1 uk-margin-bottom">
                    <h3 class="uk-h3">Корзина</h3>
                </div>
                <div id="allproducts" class="uk-width-1-1">
                    <div
                        class="uk-panel  uk-card uk-card-default uk-card-small uk-card-body uk-width-1-1 uk-margin-top">
                        <div class="uk-margin-remove-last-child custom">
                            <p class="text-center">Вы также можете
                                оформить заказ через <a href="#">форму обратной связи</a>
                            </p>
                        </div>
                    </div>
                    <hr class="uk-margin">
                    <div class="uk-width-1-1" id="customerror" style="display:none;"></div>
                    <template x-for="item in cart">
                        <div class="product uk-width-1-1 uk-margin">
                            <div x-text="item"></div>
                            <div class="spacer uk-grid-small uk-grid" uk-grid="">
                                <div class="uk-width-1-4 uk-visible@l uk-first-column">
                                    <div class=" uk-text-center ">
                                        <a href="/store/roidmi-eve-plus">
                                            <picture>
                                                <source type="image/webp"
                                                    srcset="/templates/yootheme/cache/f7/xiaomi-roidmi-eve-max_1-f78dcae7.webp 732w"
                                                    sizes="(min-width: 732px) 732px">
                                                <img class="uk-thumbnail uk-thumbnail-mini"
                                                    src="/images/virtuemart/product/xiaomi-roidmi-eve-max_1.jpg"
                                                    width="732" height="862" alt="" loading="lazy">
                                            </picture>
                                        </a>
                                    </div>
                                </div>
                                <div class="uk-width-3-4@l uk-width-1-1@s ">
                                    <div class="top-row uk-grid-small uk-grid" uk-grid="">
                                        <div
                                            class="uk-text-bold uk-width-2-5@l uk-width-1-1@s uk-width-1-1 uk-first-column">
                                            <div class="spacer">
                                                <div class="uk-hidden@l uk-float-left uk-margin-small-right"
                                                    style="width:100px;"><a href="/store/roidmi-eve-plus">
                                                        <picture>
                                                            <img class="uk-thumbnail uk-thumbnail-mini"
                                                                src="/images/virtuemart/product/xiaomi-roidmi-eve-max_1.jpg"
                                                                width="732" height="862" alt=""
                                                                loading="lazy">
                                                        </picture>
                                                    </a></div>
                                                <a href="/store/roidmi-eve-plus" class="uk-link" x-text="item.name"></a>
                                            </div>
                                        </div>
                                        <div
                                            class="quantity uk-width-2-5@l uk-width-1-2@s uk-width-2-3 uk-text-left-small">
                                            <div class="flex flex-wrap items-center gap-1">

                                                <input name="quantityv	" type="hidden" value="2"> <input
                                                    type="hidden" name="stock[0]" value="37">
                                                <input type="hidden" name="view" value="cart">
                                                <input type="hidden" name="virtuemart_product_id[]" value="1143">
                                                <input type="text" title="Обновить количество в корзине"
                                                    class="quantity-input js-recalculate  uk-input uk-form-small"
                                                    onblur="check_0(this);" maxlength="4" id="quantity_0"
                                                    name="quantityval[0]"
                                                    data-errstr="You can buy this product only in multiples of %1$s pieces!"
                                                    x-model="item.count" data-init="1" data-step="1"
                                                    data-minerror="The minimum order quantity for this product is 0 items."
                                                    data-maxerror="The maximum order quantity for this product is 0 items."
                                                    style="max-width:45px">

                                                <a href="#" x-on:click.prevent="item.count>1?item.count--:1"
                                                    class="quantity-minus flex items-center shrink-0"><span
                                                        uk-icon="icon: minus-circle" class="uk-icon block"></span></a>
                                                <a href="#"
                                                    x-on:click.prevent="item.count>=item.in_stock?item.count = item.in_stock:item.count++"
                                                    class="quantity-plus flex items-center shrink-0"><span
                                                        uk-icon="icon: plus-circle" class="uk-icon block"></span></a>
                                            </div>
                                        </div>
                                        <div
                                            class="uk-text-primary uk-text-bold  uk-width-1-5@l uk-width-1-2@s uk-width-1-3 uk-text-right">
                                            <div class="spacer" id="subtotal_with_tax_0"><span
                                                    x-text="item.price*item.count"></span> ₸
                                            </div>
                                        </div>
                                        <div class="clear uk-grid-margin uk-first-column"></div>
                                    </div>
                                    <hr class="uk-margin-small">
                                    <div class="bottom-row uk-grid">
                                        <div class="info uk-width-1-2">
                                            <div class="spacer">
                                                <div class="uk-text-small"> Артикул: CDJ08RM</div>
                                                <div class="vm-customfield-cart"></div>
                                                <div class="spacer uk-hidden@m uk-text-small"></div>
                                                <div class="cart-product-details  uk-visible@l"><a
                                                        href="/store/roidmi-eve-plus">Описание товара</a></div>
                                            </div>
                                        </div>
                                        <div
                                            class="uk-width-1-3@l uk-width-1-2@s uk-width-1-2 uk-text-left@s uk-text-right uk-hidden">
                                            <div class="spacer uk-text-small"></div>
                                        </div>
                                        <div class="uk-text-small  uk-text-right uk-width-1-2">
                                            <div class="spacer"><a id="removeproduct" class="removeproduct"
                                                    title="Удалить товар из корзины" align="middle"
                                                    href="javascript:void(0)" data-itemid="0">Удалить
                                                    товар
                                                    из корзины </a></div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-clearfix"></div>
                            <hr class="uk-margin-bottom-remove">
                        </div>
                    </template>
                </div>
                <div class="uk-card uk-card-default uk-card-body uk-card-small">
                    <div class="selectbox uk-child-width-1-2@l uk-child-width-1-1 uk-child-width-1-2@m uk-grid-small uk-grid uk-grid-stack"
                        uk-grid="">
                        <div class="uk-first-column"><label class="virtuemart_country_id"
                                for="virtuemart_country_id_field"> Выберите регион для
                                доставки </label><br>

                            <select @change="changeRegion($event)" x-model="form.region"
                                class="uk-select uk-width-1-1 " style="width: 210px">
                                <option selected="selected" value="0">-- Выберите --</option>
                                <template x-for="region in regions">
                                    <option x-bind:value="region.id">
                                        <template x-text="region.name"></template>
                                    </option>
                                </template>
                            </select>
                        </div>
                        <div class=" uk-hidden"><label class="virtuemart_state_id" for="virtuemart_state_id_field">
                                Область/Регион </label><br><select onchange="javascript:updateaddress(2);"
                                id="virtuemart_state_id_field" class="uk-select uk-width-1-1  "
                                name="virtuemart_state_id" style="width: 210px">
                                <option value="">-- Выберите --</option>
                            </select></div>
                    </div>
                </div>
                <div class="uk-clearfix"></div>
                <div
                    class="uk-grid-small uk-grid-match uk-child-width-1-2@l uk-child-width-1-1 uk-child-width-1-2@m uk-grid">
                    <div id="shipment_select" class="uk-margin-small-top uk-first-column">
                        <div id="shipmentdiv" class="uk-card uk-card-default uk-card-small uk-card-body ">
                            <h4 class="uk-panel-title">Выберите способ отправки</h4>
                            <template x-if="form.region == 0">
                                <div>
                                    <div id="shipment_nill"></div>
                                    <fieldset id="shipment_selection">
                                        <ul class="uk-list uk-list-divider uk-margin-remove" id="shipment_ul"></ul>
                                        <p id="shipmentnill" class="uk-text-warning">Выберите <b>Регион</b> для
                                            доставки
                                        </p>
                                    </fieldset>
                                </div>
                            </template>
                            <template x-if="form.region != 0">
                                <fieldset id="shipment_selection">
                                    <ul class="uk-list uk-list-divider uk-margin-remove" id="shipment_ul">
                                        <template x-for="delivery in deliveries">
                                            <li x-show="selectRegion(delivery,form.region)">
                                                <label class="uk-width-1-1">
                                                    <input onclick="setshipment()" type="radio"
                                                        data-dynamic-update="1" name="virtuemart_shipmentmethod_id"
                                                        id="shipment_id_8" value="8">
                                                    <span class="vmshipment"><span class="vmshipment_name"
                                                            x-text="delivery.name"></span><span
                                                            class="vmpayment_description uk-text-small"
                                                            x-text="delivery.description"></span><span
                                                            class="vmpayment_cost uk-text-small fee"
                                                            x-text="delivery.cost"> </span></span>
                                                </label>
                                            </li>
                                        </template>
                                    </ul>
                                </fieldset>
                            </template>
                        </div>
                    </div>
                    <input type="hidden" name="onepaymenthide" id="onepaymenthide" value="no"> <input
                        type="hidden" name="auto_paymentid" id="auto_paymentid" value="-1">
                    <div id="payment_select" class="uk-margin-small-top  ">
                        <div id="paymentdiv" class="uk-card-body uk-card uk-card-default uk-card-small ">
                            <h4 class="uk-h4">Выберите способ оплаты</h4>
                            <div id="payment_nill"></div>
                            <div id="paymentsdiv">
                                <ul class="uk-list uk-list-divider uk-margin-remove" id="payment_ul">
                                    <template x-for="payment in payment_types">
                                        <li x-show="selectPayment(payment,form.region)">
                                            <label><input onclick="setpayment()" type="radio"
                                                    data-dynamic-update="1" name="virtuemart_paymentmethod_id"
                                                    id="payment_id_4" value="4" checked="checked"><span
                                                    class="vmpayment"> <span class="vmpayment_name"
                                                        x-text="payment.name"></span> | <span
                                                        class="vmpayment_description"
                                                        x-text="payment.description"></span></span></label>
                                        </li>
                                    </template>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-clearfix"></div>
                <hr class="uk-hr">
                <div class="uk-width-1-1 uk-margin-small-top ">
                    <div class="uk-width-1-1 uk-text-center  uk-card uk-card-body uk-padding-small uk-card-default">
                        <div class="uk-grid-small uk-grid" uk-grid="">
                            <div class="uk-width-expand uk-first-column"><input type="text" name="coupon_code"
                                    id="coupon_code" class="uk-input uk-form-width-large"
                                    alt="Введите код своего купона" placeholder="Введите код своего купона"
                                    value="" autocomplete="false" readonly=""
                                    onfocus="this.removeAttribute('readonly');">
                            </div>
                            <div class="details-button uk-width-auto">
                                <button id="save-button" class="uk-button btn-all uk-button-primary" type="button"
                                    value="Сохранить" onclick="applycoupon();"> Сохранить
                                </button>
                            </div>
                            <div id="coupon_code_txt"
                                class="uk-width-1-1 uk-container-center uk-grid-margin uk-first-column"></div>
                            <div class="deletecoupon-button uk-grid-margin uk-first-column">
                                <button id="delete-button" class="uk-button btn-all uk-button-primary uk-button-small"
                                    type="button" value="Удалить" onclick="deletecoupon();" style="display: none;">
                                    Удалить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="extracommentss"
                    class="uk-panel uk-card-body  uk-card uk-card-default uk-card-small uk-margin-small-top"
                    style="display:none;">
                    <h3 class="uk-panel-title">Комментарий к заказу</h3>
                    <div class="uk-text-center">
                        <textarea onblur="javascript:updatecustomernote(this);" id="customer_note_field" name="customer_note" cols="60"
                            rows="1" class="inputbox" maxlength="2500"></textarea>
                    </div>
                </div>
                <style>
                    .price-summary .uk-grid {
                        margin-top: 5px !important
                    }
                </style>
                <div class="price-summary uk-content uk-margin-small-top">
                    <div class="spacer">
                        <div class="uk-grid uk-text-right" id="couponpricediv" style="display: none;">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2">Купон на скидку:</div>
                            <div class="price-amount price-type uk-width-1-4@l uk-width-1-2@s uk-width-1-2"
                                id="coupon_price"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="product-subtotal uk-grid uk-text-right" id="coupon_taxfulldiv"
                            style="display:none;">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2"> Купон на скидку:</div>
                            <div class="price-amount price-type uk-width-1-4@l uk-width-1-2@s uk-width-1-2"
                                id="coupon_tax"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="product-subtotal  uk-grid uk-text-right" id="sales_pricefulldiv">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2">Итого:</div>
                            <div class="price-amount price-type uk-width-1-4@l uk-width-1-2@s uk-width-1-2"
                                id="sales_price">144 190 ₸
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="product-subtotal   uk-grid uk-text-right" id="shipmentfulldiv"
                            style="display: none;">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2"> Отправка:</div>
                            <div class="price-amount price-type uk-width-1-4@l uk-width-1-2@s uk-width-1-2"
                                id="shipment"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="product-subtotal   uk-grid uk-text-right" id="paymentfulldiv"
                            style="display: none;">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2"> Оплата:</div>
                            <div class="price-amount price-type uk-width-1-4@l uk-width-1-2@s uk-width-1-2"
                                id="paymentprice"></div>
                            <div class="clear"></div>
                        </div>
                        <div id="DBTaxRulesBill" style="display:none"></div>
                        <div id="taxRulesBill" style="display:none"></div>
                        <div id="DATaxRulesBill" style="display:none"></div>
                        <div class=" uk-grid uk-text-right" id="total_amountfulldiv" style="display: none;">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2">Скидка:</div>
                            <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2" id="total_amount">55
                                800 ₸
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="shipping-total uk-hidden">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2">
                                COM_VIRTUEMART_CART_SHIPPING_TAX:
                            </div>
                            <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2" id="shipment_tax">
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class=" uk-grid uk-text-right" id="total_taxfulldiv" style="display: none;">
                            <div class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2">Налог:</div>
                            <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2" id="total_tax"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="total  uk-grid uk-text-right" id="bill_totalfulldiv">
                            <div
                                class="price-type uk-width-3-4@l uk-width-1-2@s uk-width-1-2 uk-text-large uk-text-primary uk-text-bold">
                                Итого:
                            </div>
                            <div class="price-amount uk-width-1-4@l uk-width-1-2@s uk-width-1-2 uk-text-large uk-text-primary uk-text-bold"
                                id="bill_total">144 190 ₸
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="right_div" class="tm-sidebar-a uk-width-1-1 uk-width-2-5@l uk-width-2-5@m uk-width-1-1@s">
                <div class="uk-width-1-1 uk-margin-bottom">
                    <h3 class="uk-h3">Оформление заказа</h3>
                </div>
                <fieldset id="payments">
                    <div class="paydiv" id="paydiv_4" style=""><input type="radio" class="uk-hidden"
                            onclick="javascript:updateaddress(5);" data-dynamic-update="1"
                            name="virtuemart_paymentmethod_id" id="payment_id_4" value="4" checked="checked">
                        <label class="uk-hidden" for="payment_id_4"><span class="vmpayment uk-hidden"> <span
                                    class="vmpayment_name">Счет на компанию</span><span class="vmpayment_description">
                                    | Укажите ваши реквизиты в разделе "Комментарии к заказу".</span></span></label>
                    </div>
                    <div class="paydiv" id="paydiv_10" style="display:none;"><input type="radio"
                            class="uk-hidden" onclick="javascript:updateaddress(5);" data-dynamic-update="1"
                            name="virtuemart_paymentmethod_id" id="payment_id_10" value="10">
                        <label class="uk-hidden" for="payment_id_10"><span class="vmpayment uk-hidden"> <span
                                    class="vmpayment_name"><b>Kaspi QR</b></span><span class="vmpayment_description">
                                    | Рассрочка или кредит </span></span></label>
                    </div>
                    <div class="paydiv" id="paydiv_15" style="display:none;"><input type="radio"
                            class="uk-hidden" onclick="javascript:updateaddress(5);" data-dynamic-update="1"
                            name="virtuemart_paymentmethod_id" id="payment_id_15" value="15">
                        <label class="uk-hidden" for="payment_id_15"><span class="vmpayment uk-hidden"><span
                                    class="vmpayment_name">Банковской картой онлайн</span><span
                                    class="vmpayment_description"> | Скидка 10%</span></span></label>
                    </div>
                </fieldset>
                <div id="otherpay_buttons" class="uk-card uk-card-body uk-card-default uk-card-small"
                    x-data="{ mode: 'register' }">
                    <div class="uk-width-1-1 uk-button-group " id="loginbtns" data-uk-button-radio=""><a
                            id="regbtn" href="#" x-on:click.prevent="mode='register'"
                            :class="mode == 'register' ? 'uk-button-primary' : ''"
                            class="uk-button uk-width-1-2 ">Оформить
                            заказ</a><a id="loginbtn" href="#" x-on:click.prevent="mode='login'"
                            :class="mode == 'login' ? 'uk-button-primary' : ''" class="uk-button uk-width-1-2">Вход</a>
                    </div>
                    <hr>
                    <template x-if="mode=='login'">
                        <div id="logindiv" class="uk-margin-top">
                            <h4 class="uk-h4">Если вы уже
                                зарегистрированы, войдите в систему здесь</h4>
                            <div id="loginerror" class="uk-width-1-1" style="display:none;"></div>
                            <div class=" uk-width-1-1">
                                <div class="username uk-inline uk-width-1-1 uk-margin-small-top "
                                    id="com-form-login-username">
                                    <div class="uk-inline uk-width-1-1"><a
                                            class="uk-form-icon uk-form-icon-flip uk-icon" uk-icon="icon: user"
                                            uk-tooltip="Забыли логин?" title="Забыли логин?"
                                            href="/component/users/remind?Itemid=101">

                                        </a> <input id="userlogin_username" class="uk-input uk-width-1-1"
                                            type="text" name="username" alt="Имя пользователя" value=""
                                            placeholder="Имя пользователя"></div>
                                </div>
                                <div class="password uk-width-1-1 uk-margin-small-top  uk-margin"
                                    id="com-form-login-password">
                                    <div class="uk-inline uk-width-1-1"><a
                                            class="uk-form-icon uk-form-icon-flip uk-icon" uk-icon="icon: lock"
                                            uk-tooltip="Забыли пароль?" title="Забыли пароль?"
                                            href="/component/users/reset?Itemid=101">
                                        </a> <input id="userlogin_password" type="password" name="password"
                                            class="uk-input uk-width-1-1" size="18" alt="Пароль"
                                            value="" placeholder="Пароль"></div>
                                </div>
                                <div class="login uk-width-1-1@l uk-width-1-1@s uk-margin-small-top"
                                    id="com-form-login-remember"><a class="uk-button uk-button-primary uk-width-1-1"
                                        href="javascript:void(0);" onclick="ajaxlogin()">Вход</a></div>
                                <div class="clear"></div>
                            </div>
                            <input type="hidden" id="loginempty" value="Поле не заполнено"> <input type="hidden"
                                id="loginerrors" value="Логин и Пароль не совпадают">
                            <input type="hidden" name="task" value="user.login"> <input type="hidden"
                                name="return" value="" id="returnurl">

                        </div>
                    </template>
                    <template x-if="mode=='register'">
                        <div id="old_payments" style="">
                            <div><span class="priceColor2 uk-hidden" id="payment_tax"></span></div>
                            <div id="payment" class="uk-hidden"></div>
                            <div class="billto-shipto" style="">
                                <div class="uk-width-1-1">
                                    <h4 id="guesttitle" class="uk-h4 uk-margin-top  ">
                                        Оформить без регистрации</h4>
                                    <div id="billto_inputdiv">
                                        @if (\Illuminate\Support\Facades\Auth::check())
                                            <div class="adminform" id="billto_fields_div" style="margin:0;">
                                                <div class="uk-width-1-1 uk-margin-small">
                                                    <div id="email_error" style="display:none;"></div>
                                                    <input placeholder="Эл.почта *" disabled="true" type="email"
                                                        id="email_field" name="email"
                                                        value="{{ Auth::user()->email }}"
                                                        class="uk-input required validate-email" maxlength="100">
                                                </div>
                                                <div class="uk-width-1-1 uk-margin-small">
                                                    <input placeholder="Имя *" type="text" disabled="true"
                                                        id="first_name_field" name="first_name"
                                                        value="{{ Auth::user()->name }}" class="uk-input required"
                                                        maxlength="32">
                                                </div>
                                                <div class="uk-width-1-1 uk-margin-small"><input
                                                        placeholder="Фамилия *" disabled="true" type="text"
                                                        id="last_name_field" name="last_name"
                                                        x-model="form.last_name" value=""
                                                        class="uk-input required" maxlength="32"></div>
                                                <div class="uk-width-1-1 uk-margin-small"><input placeholder="Адрес *"
                                                        type="text" id="address_1_field" disabled="true"
                                                        name="address_1" x-model="form.address_1" value=""
                                                        class="uk-input required" maxlength="64"></div>
                                                <div class="uk-width-1-1 uk-margin-small"><input placeholder="Город *"
                                                        type="text" id="city_field" disabled="true"
                                                        name="city" x-model="form.city" value=""
                                                        class="uk-input required" maxlength="32"></div>
                                                <div class="uk-width-1-1 uk-margin-small"><input class="uk-input "
                                                        placeholder="Телефон" disabled="true" type="text"
                                                        x-model="form.text" id="phone_1_field" name="phone_1"
                                                        value="" maxlength="32"></div>
                                            </div>
                                        @else
                                            <div class="adminform" id="billto_fields_div" style="margin:0;">
                                                <div class="uk-width-1-1 uk-margin-small">
                                                    <div id="email_error" style="display:none;"></div>
                                                    <input placeholder="Эл.почта *" onblur="checkemail();"
                                                        type="email" id="email_field" name="email"
                                                        x-model="form.email" value=""
                                                        class="uk-input required validate-email" maxlength="100">
                                                </div>
                                                <div class="uk-width-1-1 uk-margin-small">
                                                    <input placeholder="Имя *" type="text" id="first_name_field"
                                                        name="first_name" x-model="form.first_name" value=""
                                                        class="uk-input required" maxlength="32">
                                                </div>
                                                <div class="uk-width-1-1 uk-margin-small"><input
                                                        placeholder="Фамилия *" type="text" id="last_name_field"
                                                        name="last_name" x-model="form.last_name" value=""
                                                        class="uk-input required" maxlength="32"></div>
                                                <div class="uk-width-1-1 uk-margin-small"><input placeholder="Адрес *"
                                                        type="text" id="address_1_field" name="address_1"
                                                        x-model="form.address_1" value=""
                                                        class="uk-input required" maxlength="64"></div>
                                                <div class="uk-width-1-1 uk-margin-small"><input placeholder="Город *"
                                                        type="text" id="city_field" name="city"
                                                        x-model="form.city" value="" class="uk-input required"
                                                        maxlength="32"></div>
                                                <div class="uk-width-1-1 uk-margin-small"><input class="uk-input "
                                                        placeholder="Телефон" type="text" x-model="form.text"
                                                        id="phone_1_field" name="phone_1" value=""
                                                        maxlength="32"></div>
                                            </div>
                                        @endif
                                    </div>
                                    {{--                                <div class="uk-width-1-1 uk-margin-top" id="div_shipto"> --}}
                                    {{--                                    <div class="shipto_fields_div"> --}}
                                    {{--                                        <div class="uk-width-1-1"><a id="shiptobutton" --}}
                                    {{--                                                                     class="uk-button uk-button-default uk-width-1-1" --}}
                                    {{--                                                                     href="#" uk-toggle="target:#shiptopopup" --}}
                                    {{--                                                                     role="button"><i id="shiptoicon" --}}
                                    {{--                                                                                      style="display:none;" --}}
                                    {{--                                                                                      class="uk-icon uk-icon-play uk-margin-right"></i>Добавить --}}
                                    {{--                                                адрес доставки</a></div> --}}
                                    {{--                                    </div> --}}
                                    {{--                                    <div class="clear"></div> --}}
                                    {{--                                </div> --}}
                                    <div id="other-things" style="" class="uk-margin-small">
                                        {{--                                    <div class="uk-width-1-1" style=""><a id="commentbutton" --}}
                                        {{--                                                                          class="uk-button uk-button-default  uk-width-1-1" --}}
                                        {{--                                                                          href="#commentpopup" uk-toggle="" --}}
                                        {{--                                                                          role="button"><i id="commenticon" --}}
                                        {{--                                                                                           style="display:none" --}}
                                        {{--                                                                                           class="uk-icon uk-icon-play uk-margin-small-right"></i> --}}
                                        {{--                                            Комментарий к заказу </a></div> --}}
                                        <div class="checkout-button-top uk-margin-small"><label><input type="hidden"
                                                    name="tos" value="0"><input
                                                    class="uk-checkbox terms-of-service" id="squaredTwo"
                                                    type="checkbox" name="tos" value="1"> <a
                                                    class="uk-link uk-text-small uk-text-middle"
                                                    role="button">Прочтите и примите условия
                                                    обслуживания оплаты, доставки и гарантии</a> </label>
                                            <a class="uk-button uk-button-primary uk-button-large uk-margin-top uk-width-1-1"
                                                href="javascript:void(0);"
                                                x-on:click="submitOrder();"><span>Подтвердить заказ</span></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
