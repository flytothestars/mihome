<x-app-layout>
    <main id="tm-main" class="tm-main uk-section uk-section-default" uk-height-viewport="expand: true"
        style="min-height: max(0px, -1529.88px + 100vh);">
        <div class="uk-container">
            <div id="system-message-container" aria-live="polite"></div>
            <div id="bd_results" role="region" aria-live="polite">
                <div id="cf_res_ajax_loader"></div>
                <form method="post" id="userForm" action="https://mi-home.kz/kredit">
                    <div id="rsform_error_12" style="display: none;">
                        <p class="formRed">Пожалуйста, заполните все необходимые поля</p>
                    </div>
                    <div class="formContainer uk-form-horizontal" id="rsform_12_page_0">
                        <div class="uk-grid">
                            <div class="uk-width-12-12">
                                <div class="uk-margin rsform-block rsform-block-info rsform-type-freetext">
                                    <h2>Рассрочка / Кредит</h2>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-price rsform-type-textbox"> <label
                                        class="uk-form-label formControlLabel" for="price">Стоимость товара, ₸<strong
                                            class="formRequired">*</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="number" value="" size="5"
                                            step="1" name="form[price]" id="price" readonly=""
                                            class="rsform-input-box uk-input" aria-required="true"> <span
                                            class="formValidation"><span id="component100"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-info2 rsform-type-freetext">
                                    <ol>
                                        <li>Нажмите на кнопку <strong>Оформить рассрочку</strong></li>
                                        <li>Введите <span style="text-decoration: underline;">стоимость товара</span> и
                                            нажмите <strong>Продолжить</strong></li>
                                        <li>В поле <strong>Сообщение продавцу</strong> укажите <span
                                                style="text-decoration: underline;">ваш номер телефона</span></li>
                                        <li>Нажмите <strong>Оплатить в Рассрочку</strong></li>
                                    </ol>
                                    <ol start="5">
                                        <li>После,&nbsp;<span style="text-decoration: underline;">вернитесь на
                                                сайт</span> <strong>Mi Home</strong></li>
                                        <li>Заполните поля <span style="text-decoration: underline;">Ваше имя и номер
                                                телефона</span></li>
                                        <li>Нажмите <strong>Подтвердить заказ</strong></li>
                                    </ol>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-kaspi-button rsform-type-freetext"> <a
                                        href="https://pay.kaspi.kz/pay/bk2pl4ny" target="_blank" rel="nofollow noopener"
                                        class="uk-button kaspi_button"><span class="kaspi_button_logo"></span>Оформить
                                        рассрочку</a> </div>
                                <div class="uk-margin rsform-block rsform-block-client-name rsform-type-textbox"> <label
                                        class="uk-form-label formControlLabel" for="client_name">Ваше имя<strong
                                            class="formRequired">*</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="32"
                                            name="form[client_name]" id="client_name" class="rsform-input-box uk-input"
                                            aria-required="true"> <span class="formValidation"><span id="component67"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-client-phone rsform-type-textbox">
                                    <label class="uk-form-label formControlLabel" for="client_phone">Ваш номер
                                        телефона<strong class="formRequired">*</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="tel" value="+77" size="11"
                                            maxlength="12" name="form[client_phone]" id="client_phone"
                                            class="rsform-input-box uk-input" aria-required="true"> <span
                                            class="formValidation"><span id="component68"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-info3 rsform-type-freetext">
                                    <p>Доставка может быть <span style="text-decoration: underline;">платной</span> или
                                        <span style="text-decoration: underline;">бесплатной</span>&nbsp;<a
                                            data-modals="" href="/informaciya/dostavka?ml=1" data-modals-height="100%"
                                            data-modals-width="430" data-modals-group="_group_5"
                                            data-modals-done="true">подробнее</a></p>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-submit-button rsform-type-submitbutton">
                                    <label class="uk-form-label formControlLabel"></label>
                                    <div class="formControls uk-form-controls"> <button type="submit"
                                            name="form[submit_button]" id="submit_button"
                                            class="rsform-submit-button  uk-button uk-button-primary"><span
                                                uk-icon="icon: cart" class="uk-margin-small uk-icon">
                                                    <circle cx="7.3" cy="17.3" r="1.4"></circle>
                                                    <circle cx="13.3" cy="17.3" r="1.4"></circle>
                                                    <polyline fill="none" stroke="#000"
                                                        points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5"></polyline>
                                                </svg></span> Подтвердить заказ</button> <span
                                            class="formValidation"></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-info-2 rsform-type-freetext">
                                    <p class="uk-margin-medium-top uk-alert" uk-alert="">Вы также можете оформить заявку
                                        на рассрочку или кредит написав нам на <a data-modals="" class="inherit"
                                            href="/whatsapp?ml=1" data-modals-height="100%" data-modals-width="430"
                                            data-modals-group="_group_6" data-modals-done="true"><span
                                                uk-icon="icon: whatsapp" class="uk-icon">
                                                    <path
                                                        d="M16.7,3.3c-1.8-1.8-4.1-2.8-6.7-2.8c-5.2,0-9.4,4.2-9.4,9.4c0,1.7,0.4,3.3,1.3,4.7l-1.3,4.9l5-1.3c1.4,0.8,2.9,1.2,4.5,1.2 l0,0l0,0c5.2,0,9.4-4.2,9.4-9.4C19.5,7.4,18.5,5,16.7,3.3 M10.1,17.7L10.1,17.7c-1.4,0-2.8-0.4-4-1.1l-0.3-0.2l-3,0.8l0.8-2.9 l-0.2-0.3c-0.8-1.2-1.2-2.7-1.2-4.2c0-4.3,3.5-7.8,7.8-7.8c2.1,0,4.1,0.8,5.5,2.3c1.5,1.5,2.3,3.4,2.3,5.5 C17.9,14.2,14.4,17.7,10.1,17.7 M14.4,11.9c-0.2-0.1-1.4-0.7-1.6-0.8c-0.2-0.1-0.4-0.1-0.5,0.1c-0.2,0.2-0.6,0.8-0.8,0.9 c-0.1,0.2-0.3,0.2-0.5,0.1c-0.2-0.1-1-0.4-1.9-1.2c-0.7-0.6-1.2-1.4-1.3-1.6c-0.1-0.2,0-0.4,0.1-0.5C8,8.8,8.1,8.7,8.2,8.5 c0.1-0.1,0.2-0.2,0.2-0.4c0.1-0.2,0-0.3,0-0.4C8.4,7.6,7.9,6.5,7.7,6C7.5,5.5,7.3,5.6,7.2,5.6c-0.1,0-0.3,0-0.4,0 c-0.2,0-0.4,0.1-0.6,0.3c-0.2,0.2-0.8,0.8-0.8,2c0,1.2,0.8,2.3,1,2.4c0.1,0.2,1.7,2.5,4,3.5c0.6,0.2,1,0.4,1.3,0.5 c0.6,0.2,1.1,0.2,1.5,0.1c0.5-0.1,1.4-0.6,1.6-1.1c0.2-0.5,0.2-1,0.1-1.1C14.8,12.1,14.6,12,14.4,11.9">
                                                    </path>
                                                </svg></span> WhatsApp</a></p>
                                </div>
                            </div>
                        </div>
                    </div><input type="hidden" name="form[referer]" id="referer" value="https://mi-home.kz/"> <input
                        type="hidden" name="form[sku]" id="sku" value=""> <input type="hidden" name="form[name]"
                        id="name" value=""> <input type="hidden" name="form[price_]" id="price_" value=""> <input
                        type="hidden" name="form[bank]" id="bank" value=""> <input type="hidden"
                        name="g-recaptcha-response" id="g-recaptcha-response-12" value=""><input type="hidden"
                        name="form[formId]" value="12"><input type="hidden" name="c750aab0cf92d39f52653e863b6e2b49"
                        value="1">
                </form>
            </div>
        </div>
    </main>
</x-app-layout>