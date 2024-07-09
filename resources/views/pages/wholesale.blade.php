<x-app-layout>
    <main id="tm-main" class="tm-main uk-section uk-section-default" uk-height-viewport="expand: true"
        style="min-height: max(0px, -1523.09px + 100vh);">
        <div class="uk-container">
            <div id="system-message-container" aria-live="polite"></div>
            <div id="bd_results" role="region" aria-live="polite">
                <div id="cf_res_ajax_loader"></div>
                <form method="post" id="userForm" action="https://mi-home.kz/wholesale">
                    <div class="formContainer uk-form-horizontal" id="rsform_7_page_0">
                        <div class="uk-grid">
                            <div class="uk-width-12-12">
                                <div class="uk-margin rsform-block rsform-block-head rsform-type-freetext">
                                    <h1>Запрос оптовых цен</h1>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-info rsform-type-freetext">
                                    <p>Укажите ваши контактные данные и мы свяжеся с вами</p>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-client-name rsform-type-textbox"> <label
                                        class="uk-form-label formControlLabel" for="client_name">Ваше имя<strong
                                            class="formRequired">*</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="32"
                                            name="form[client_name]" id="client_name" class="rsform-input-box uk-input"
                                            aria-required="true"> <span class="formValidation"><span id="component28"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-client-company rsform-type-textbox">
                                    <label class="uk-form-label formControlLabel" for="client_company">Компания<strong
                                            class="formRequired">*</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="32"
                                            name="form[client_company]" id="client_company"
                                            class="rsform-input-box uk-input" aria-required="true"> <span
                                            class="formValidation"><span id="component27"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-client-phone rsform-type-textbox">
                                    <label class="uk-form-label formControlLabel" for="client_phone">Номер
                                        телефона<strong class="formRequired">*</strong></label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="32"
                                            name="form[client_phone]" id="client_phone"
                                            class="rsform-input-box uk-input" aria-required="true"> <span
                                            class="formValidation"><span id="component29"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-submit-button rsform-type-submitbutton">
                                    <label class="uk-form-label formControlLabel"></label>
                                    <div class="formControls uk-form-controls"> <button type="submit"
                                            name="form[submit_button]" id="submit_button"
                                            class="rsform-submit-button  uk-button uk-button-primary">Отправить
                                            запрос</button> <span class="formValidation"></span> </div>
                                </div>
                            </div>
                        </div>
                    </div><input type="hidden" name="form[referer]" id="referer" value="https://mi-home.kz/"> <input
                        type="hidden" name="g-recaptcha-response" id="g-recaptcha-response-7" value=""><input
                        type="hidden" name="form[formId]" value="7"><input type="hidden"
                        name="c750aab0cf92d39f52653e863b6e2b49" value="1">
                </form>
            </div>
        </div>
    </main>
</x-app-layout>