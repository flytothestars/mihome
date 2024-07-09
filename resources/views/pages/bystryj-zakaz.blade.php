<x-app-layout>
    <main id="tm-main" class="tm-main uk-section uk-section-default" uk-height-viewport="expand: true"
        style="min-height: max(0px, -1529.88px + 100vh);">
        <div class="uk-container">
            <div id="system-message-container" aria-live="polite"></div>
            <div id="bd_results" role="region" aria-live="polite">
                <div id="cf_res_ajax_loader"></div>
                <form method="post" id="userForm" action="https://mi-home.kz/bystryj-zakaz">
                    <div id="rsform_error_11" style="display: none;">
                        <div class="uk-alert uk-alert-danger">
                            <p>Заполните все поля</p>
                        </div>
                    </div>
                    <div class="formContainer uk-form-horizontal" id="rsform_11_page_0">
                        <div class="uk-grid">
                            <div class="uk-width-12-12">
                                <div class="uk-margin rsform-block rsform-block-title rsform-type-freetext">
                                    <p class="uk-h3">Быстрый заказ</p>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-client-name rsform-type-textbox"> <label
                                        class="uk-form-label formControlLabel" for="client_name">Ваше имя<strong
                                            class="formRequired"> *</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="32"
                                            name="form[client_name]" id="client_name" class="rsform-input-box uk-input"
                                            aria-required="true"> <span class="formValidation"><span id="component57"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-client-phone rsform-type-textbox">
                                    <label class="uk-form-label formControlLabel" for="client_phone">Номер телефона
                                        WhatsApp<strong class="formRequired"> *</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="tel" value="+7" size="32"
                                            name="form[client_phone]" id="client_phone"
                                            class="rsform-input-box uk-input" aria-required="true"> <span
                                            class="formValidation"><span id="component58"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-adress rsform-type-textbox"> <label
                                        class="uk-form-label formControlLabel" for="adress">Адрес доставки</label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="20"
                                            name="form[adress]" id="adress" class="rsform-input-box uk-input"> <span
                                            class="formValidation"><span id="component62"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-submit-button rsform-type-submitbutton">
                                    <label class="uk-form-label formControlLabel"></label>
                                    <div class="formControls uk-form-controls"> <button type="submit"
                                            name="form[submit_button]" id="submit_button"
                                            class="rsform-submit-button  uk-button uk-button-primary">оформить
                                            заказ</button> <span class="formValidation"></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-info rsform-type-freetext">
                                    <p class="uk-alert-danger uk-margin-medium-top">Магазин находится в
                                        <strong>Алматы</strong></p>
                                    <p class="uk-alert-danger"><strong>Срок доставки<br></strong>- по Алматы - <span
                                            style="text-decoration: underline;">от 3 до&nbsp;24 часов</span><br>- по
                                        Казахстану - <span style="text-decoration: underline;">от 3 до 10</span> рабочих
                                        дней в зависимсти от города</p>
                                    <p class="uk-alert-danger"><strong>Стоимость доставки<br></strong> - <span
                                            style="text-decoration: underline;">бесплатно</span> при заказе на сумму
                                        <span
                                            style="text-decoration: underline;">более&nbsp;20&nbsp;000&nbsp;₸<br></span>-
                                        при заказе на меньшую сумму стоимость доставки уточняйте у менеджера</p>
                                </div>
                            </div>
                        </div>
                    </div><input type="hidden" name="form[referer]" id="referer" value="https://mi-home.kz/"> <input
                        type="hidden" name="form[sku]" id="sku" value=""> <input type="hidden" name="form[name]"
                        id="name" value=""> <input type="hidden" name="form[price]" id="price" value=""> <input
                        type="hidden" name="g-recaptcha-response" id="g-recaptcha-response-11" value=""><input
                        type="hidden" name="form[formId]" value="11"><input type="hidden"
                        name="c750aab0cf92d39f52653e863b6e2b49" value="1">
                </form>
            </div>
        </div>
    </main>
</x-app-layout>