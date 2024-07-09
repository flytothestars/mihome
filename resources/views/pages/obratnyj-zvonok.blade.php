<x-app-layout>
    <main id="tm-main" class="tm-main uk-section uk-section-default" uk-height-viewport="expand: true"
        style="min-height: max(0px, -1529.88px + 100vh);">
        <div class="uk-container">
            <div id="system-message-container" aria-live="polite"></div>
            <div id="bd_results" role="region" aria-live="polite">
                <div id="cf_res_ajax_loader"></div>
                <form method="post" id="userForm" style="background: #fff;padding: 10px;"
                    action="https://mi-home.kz/obratnyj-zvonok">
                    <h2>Задать вопрос</h2>
                    <div class="formContainer uk-form-horizontal" id="rsform_4_page_0">
                        <div class="uk-grid">
                            <div class="uk-width-12-12">
                                <div class="uk-margin rsform-block rsform-block-name rsform-type-textbox"> <label
                                        class="uk-form-label formControlLabel" for="name">Ваше имя</label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="20"
                                            name="form[name]" id="name" class="rsform-input-box uk-input"
                                            aria-required="true"> <span class="formValidation"><span id="component12"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-phone rsform-type-textbox"> <label
                                        class="uk-form-label formControlLabel" for="phone">Телефон или адрес электронной
                                        почты</label>
                                    <div class="formControls uk-form-controls"> <input type="text" value="" size="20"
                                            name="form[phone]" id="phone" class="rsform-input-box uk-input"
                                            aria-required="true"> <span class="formValidation"><span id="component13"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-question rsform-type-textarea"> <label
                                        class="uk-form-label formControlLabel" for="question">Вопрос</label>
                                    <div class="formControls uk-form-controls"> <textarea cols="50" rows="5"
                                            name="form[question]" id="question"
                                            class="rsform-text-box uk-textarea">Или укажите товар который вас интересует</textarea>
                                        <span class="formValidation"><span id="component17"
                                                class="formNoError"></span></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-button rsform-type-submitbutton"> <label
                                        class="uk-form-label formControlLabel"></label>
                                    <div class="formControls uk-form-controls"> <button type="submit"
                                            name="form[button]" id="button"
                                            class="jcepopup noicon rsform-submit-button  uk-button uk-button-primary">Отправить</button>
                                        <span class="formValidation"></span> </div>
                                </div>
                                <div class="uk-margin rsform-block rsform-block-text rsform-type-freetext">
                                    <p><b>После получения запроса мы свяжемся с вами в течение рабочего дня </b></p>
                                </div>
                            </div>
                        </div>
                    </div><input type="hidden" name="form[referer]" id="referer" value="https://mi-home.kz/"><input
                        type="hidden" name="form[formId]" value="4"><input type="hidden"
                        name="c750aab0cf92d39f52653e863b6e2b49" value="1">
                </form>
            </div>
        </div>
    </main>
</x-app-layout>