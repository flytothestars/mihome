<x-app-layout>
    <main id="tm-main">
        <div id="system-message-container" aria-live="polite"></div>
        <div id="bd_results" role="region" aria-live="polite">
            <div id="cf_res_ajax_loader"></div>
            <style class="uk-margin-remove-adjacent">
                #page\#0 #jp_input_div {
                    max-width: 100%
                }

                #page\#0 .jp_search_input {
                    width: 97%
                }

                #page\#1 .el-item,
                #page\#1 .el-content {
                    width: 100%
                }

                #page\#2 .el-item,
                #page\#2 .el-content {
                    width: 100%
                }
            </style>
            <div class="uk-section-default uk-section">
                <div class="uk-container">
                    <div class="uk-grid tm-grid-expand uk-child-width-1-1 uk-grid-margin">
                        <div class="uk-width-1-1">
                            <div id="page#1" class="uk-margin uk-text-center">
                                <div class="uk-flex-middle uk-grid-small uk-child-width-auto uk-flex-center uk-grid uk-grid-stack"
                                    uk-grid="">
                                    <div class="el-item uk-first-column"> <a
                                            class="el-content uk-button uk-button-primary uk-button-large uk-flex-inline uk-flex-center uk-flex-middle"
                                            title="Позвонить" href="tel:+77750070625" target="_parent"> <span
                                                class="uk-margin-small-right uk-icon" uk-icon="receiver">
                                                    <path fill="none" stroke="#000" stroke-width="1.01"
                                                        d="M6.189,13.611C8.134,15.525 11.097,18.239 13.867,18.257C16.47,18.275 18.2,16.241 18.2,16.241L14.509,12.551L11.539,13.639L6.189,8.29L7.313,5.355L3.76,1.8C3.76,1.8 1.732,3.537 1.7,6.092C1.667,8.809 4.347,11.738 6.189,13.611">
                                                    </path>
                                                </svg></span> Позвонить +7 775 007 06 25 </a> </div>
                                    <div class="el-item uk-grid-margin uk-first-column"> <a
                                            class="el-content uk-button uk-button-primary uk-button-large uk-flex-inline uk-flex-center uk-flex-middle"
                                            title="Написать на WhatsApp" href="https://wa.me/77071222981"
                                            target="_parent"> <span class="uk-margin-small-right uk-icon"
                                                uk-icon="whatsapp">
                                                    <path
                                                        d="M16.7,3.3c-1.8-1.8-4.1-2.8-6.7-2.8c-5.2,0-9.4,4.2-9.4,9.4c0,1.7,0.4,3.3,1.3,4.7l-1.3,4.9l5-1.3c1.4,0.8,2.9,1.2,4.5,1.2 l0,0l0,0c5.2,0,9.4-4.2,9.4-9.4C19.5,7.4,18.5,5,16.7,3.3 M10.1,17.7L10.1,17.7c-1.4,0-2.8-0.4-4-1.1l-0.3-0.2l-3,0.8l0.8-2.9 l-0.2-0.3c-0.8-1.2-1.2-2.7-1.2-4.2c0-4.3,3.5-7.8,7.8-7.8c2.1,0,4.1,0.8,5.5,2.3c1.5,1.5,2.3,3.4,2.3,5.5 C17.9,14.2,14.4,17.7,10.1,17.7 M14.4,11.9c-0.2-0.1-1.4-0.7-1.6-0.8c-0.2-0.1-0.4-0.1-0.5,0.1c-0.2,0.2-0.6,0.8-0.8,0.9 c-0.1,0.2-0.3,0.2-0.5,0.1c-0.2-0.1-1-0.4-1.9-1.2c-0.7-0.6-1.2-1.4-1.3-1.6c-0.1-0.2,0-0.4,0.1-0.5C8,8.8,8.1,8.7,8.2,8.5 c0.1-0.1,0.2-0.2,0.2-0.4c0.1-0.2,0-0.3,0-0.4C8.4,7.6,7.9,6.5,7.7,6C7.5,5.5,7.3,5.6,7.2,5.6c-0.1,0-0.3,0-0.4,0 c-0.2,0-0.4,0.1-0.6,0.3c-0.2,0.2-0.8,0.8-0.8,2c0,1.2,0.8,2.3,1,2.4c0.1,0.2,1.7,2.5,4,3.5c0.6,0.2,1,0.4,1.3,0.5 c0.6,0.2,1.1,0.2,1.5,0.1c0.5-0.1,1.4-0.6,1.6-1.1c0.2-0.5,0.2-1,0.1-1.1C14.8,12.1,14.6,12,14.4,11.9">
                                                    </path>
                                                </svg></span> Написать на WhatsApp </a> </div>
                                    <div class="el-item uk-grid-margin uk-first-column"> <a
                                            class="el-content uk-button uk-button-primary uk-button-large uk-flex-inline uk-flex-center uk-flex-middle"
                                            title="Написать на WhatsApp" href="https://t.me/M_Home_kz" target="_parent">
                                            <span class="uk-margin-small-right uk-icon" uk-icon="tg"><svg version="1.1"
                                                    id="Layer_1" width="20" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 300 300" style="enable-background:new 0 0 300 300;"
                                                    xml:space="preserve">
                                                    <g id="XMLID_496_">
                                                        <path id="XMLID_497_"
                                                            d="M5.299,144.645l69.126,25.8l26.756,86.047c1.712,5.511,8.451,7.548,12.924,3.891l38.532-31.412 c4.039-3.291,9.792-3.455,14.013-0.391l69.498,50.457c4.785,3.478,11.564,0.856,12.764-4.926L299.823,29.22 c1.31-6.316-4.896-11.585-10.91-9.259L5.218,129.402C-1.783,132.102-1.722,142.014,5.299,144.645z M96.869,156.711l135.098-83.207 c2.428-1.491,4.926,1.792,2.841,3.726L123.313,180.87c-3.919,3.648-6.447,8.53-7.163,13.829l-3.798,28.146 c-0.503,3.758-5.782,4.131-6.819,0.494l-14.607-51.325C89.253,166.16,91.691,159.907,96.869,156.711z">
                                                        </path>
                                                    </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                </svg></span> Написать в Telegram </a> </div>
                                    <div class="el-item uk-grid-margin uk-first-column"> <a
                                            class="el-content uk-button uk-button-primary uk-button-large uk-flex-inline uk-flex-center uk-flex-middle"
                                            title="Задать вопрос" href="/obratnyj-zvonok" target="_parent"> <span
                                                class="uk-margin-small-right uk-icon" uk-icon="sign-out">
                                                    <polygon
                                                        points="13.1 13.4 12.5 12.8 15.28 10 8 10 8 9 15.28 9 12.5 6.2 13.1 5.62 17 9.5">
                                                    </polygon>
                                                    <polygon points="13 2 3 2 3 17 13 17 13 16 4 16 4 3 13 3"></polygon>
                                                </svg></span> Перезвонить вам </a> </div>
                                </div>
                            </div>
                            <hr class="uk-divider-small uk-text-center">
                            <div id="page#2" class="uk-margin uk-text-center">
                                <div class="uk-flex-middle uk-grid-small uk-child-width-auto uk-flex-center uk-grid uk-grid-stack"
                                    uk-grid="">
                                    <div class="el-item uk-first-column"> <a
                                            class="el-content uk-button uk-button-primary uk-button-large uk-flex-inline uk-flex-center uk-flex-middle"
                                            href="https://www.instagram.com/m_home.kz/" target="_parent"> <span
                                                class="uk-margin-small-right uk-icon" uk-icon="instagram">
                                                    <path
                                                        d="M13.55,1H6.46C3.45,1,1,3.44,1,6.44v7.12c0,3,2.45,5.44,5.46,5.44h7.08c3.02,0,5.46-2.44,5.46-5.44V6.44 C19.01,3.44,16.56,1,13.55,1z M17.5,14c0,1.93-1.57,3.5-3.5,3.5H6c-1.93,0-3.5-1.57-3.5-3.5V6c0-1.93,1.57-3.5,3.5-3.5h8 c1.93,0,3.5,1.57,3.5,3.5V14z">
                                                    </path>
                                                    <circle cx="14.87" cy="5.26" r="1.09"></circle>
                                                    <path
                                                        d="M10.03,5.45c-2.55,0-4.63,2.06-4.63,4.6c0,2.55,2.07,4.61,4.63,4.61c2.56,0,4.63-2.061,4.63-4.61 C14.65,7.51,12.58,5.45,10.03,5.45L10.03,5.45L10.03,5.45z M10.08,13c-1.66,0-3-1.34-3-2.99c0-1.65,1.34-2.99,3-2.99s3,1.34,3,2.99 C13.08,11.66,11.74,13,10.08,13L10.08,13L10.08,13z">
                                                    </path>
                                                </svg></span> Страница в Instagram </a> </div>
                                    <div class="el-item uk-grid-margin uk-first-column"> <a
                                            class="el-content uk-button uk-button-primary uk-button-large uk-flex-inline uk-flex-center uk-flex-middle"
                                            title="Написать на WhatsApp" href="https://t.me/xiaomimhomekz"
                                            target="_parent"> <span class="uk-margin-small-right uk-icon"
                                                uk-icon="tg"><svg version="1.1" id="Layer_1" width="20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 300 300" style="enable-background:new 0 0 300 300;"
                                                    xml:space="preserve">
                                                    <g id="XMLID_496_">
                                                        <path id="XMLID_497_"
                                                            d="M5.299,144.645l69.126,25.8l26.756,86.047c1.712,5.511,8.451,7.548,12.924,3.891l38.532-31.412 c4.039-3.291,9.792-3.455,14.013-0.391l69.498,50.457c4.785,3.478,11.564,0.856,12.764-4.926L299.823,29.22 c1.31-6.316-4.896-11.585-10.91-9.259L5.218,129.402C-1.783,132.102-1.722,142.014,5.299,144.645z M96.869,156.711l135.098-83.207 c2.428-1.491,4.926,1.792,2.841,3.726L123.313,180.87c-3.919,3.648-6.447,8.53-7.163,13.829l-3.798,28.146 c-0.503,3.758-5.782,4.131-6.819,0.494l-14.607-51.325C89.253,166.16,91.691,159.907,96.869,156.711z">
                                                        </path>
                                                    </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                    <g> </g>
                                                </svg></span> Канал в Telegram </a> </div>
                                    <div class="el-item uk-grid-margin uk-first-column"> <a
                                            class="el-content uk-button uk-button-primary uk-button-large uk-flex-inline uk-flex-center uk-flex-middle"
                                            href="https://www.youtube.com/@-m-home2426" target="_parent"> <span
                                                class="uk-margin-small-right uk-icon" uk-icon="youtube">
                                                    <path
                                                        d="M15,4.1c1,0.1,2.3,0,3,0.8c0.8,0.8,0.9,2.1,0.9,3.1C19,9.2,19,10.9,19,12c-0.1,1.1,0,2.4-0.5,3.4c-0.5,1.1-1.4,1.5-2.5,1.6 c-1.2,0.1-8.6,0.1-11,0c-1.1-0.1-2.4-0.1-3.2-1c-0.7-0.8-0.7-2-0.8-3C1,11.8,1,10.1,1,8.9c0-1.1,0-2.4,0.5-3.4C2,4.5,3,4.3,4.1,4.2 C5.3,4.1,12.6,4,15,4.1z M8,7.5v6l5.5-3L8,7.5z">
                                                    </path>
                                                </svg></span> Канал на YouTube </a> </div>
                                </div>
                            </div>
                            <hr class="uk-divider-small uk-text-center">
                            <div class="uk-panel uk-margin uk-text-center">
                                <p><strong>Наш Адрес:</strong> г. Алматы, улица 24 Июня, дом 27 (район Абая - Манаса)
                                </p>
                            </div>
                            <div class="uk-margin uk-text-center">
                                <div class="uk-flex-middle uk-grid-small uk-child-width-auto uk-flex-center uk-grid"
                                    uk-grid="">
                                    <div class="el-item uk-first-column"> <a
                                            class="el-content uk-button uk-button-default uk-flex-inline uk-flex-center uk-flex-middle"
                                            title="2Gis" href="https://go.2gis.com/57o21n" target="_parent"> <span
                                                class="uk-margin-small-right uk-icon" uk-icon="location">
                                                    <path fill="none" stroke="#000" stroke-width="1.01"
                                                        d="M10,0.5 C6.41,0.5 3.5,3.39 3.5,6.98 C3.5,11.83 10,19 10,19 C10,19 16.5,11.83 16.5,6.98 C16.5,3.39 13.59,0.5 10,0.5 L10,0.5 Z">
                                                    </path>
                                                    <circle fill="none" stroke="#000" cx="10" cy="6.8" r="2.3"></circle>
                                                </svg></span> 2Gis Maps </a> </div>
                                    <div class="el-item"> <a
                                            class="el-content uk-button uk-button-default uk-flex-inline uk-flex-center uk-flex-middle"
                                            title="Google Maps" href="https://goo.gl/maps/AVJCds6vcxrYsBE57"
                                            target="_parent"> <span class="uk-margin-small-right uk-icon"
                                                uk-icon="location">
                                                    <path fill="none" stroke="#000" stroke-width="1.01"
                                                        d="M10,0.5 C6.41,0.5 3.5,3.39 3.5,6.98 C3.5,11.83 10,19 10,19 C10,19 16.5,11.83 16.5,6.98 C16.5,3.39 13.59,0.5 10,0.5 L10,0.5 Z">
                                                    </path>
                                                    <circle fill="none" stroke="#000" cx="10" cy="6.8" r="2.3"></circle>
                                                </svg></span> Google Maps </a> </div>
                                </div>
                            </div>
                            <hr class="uk-divider-small uk-text-center">
                            <div class="uk-panel uk-margin uk-text-center">
                                <p><strong>График работы:</strong></p>
                            </div>
                            <div class="uk-margin uk-text-center">
                                <div class="uk-grid uk-child-width-1-2 uk-grid-match" uk-grid="">
                                    <div class="uk-first-column">
                                        <div class="el-item uk-panel uk-margin-remove-first-child">
                                            <div class="el-content uk-panel uk-margin-top">
                                                <p>Будние дни:</p>
                                                <p>с 9.00 до 20.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="el-item uk-panel uk-margin-remove-first-child">
                                            <div class="el-content uk-panel uk-margin-top">
                                                <p>Выходные дни:</p>
                                                <p>с 10.00 до 20.00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-panel uk-margin">
                                <script
                                    defer="">var links = document.getElementsByTagName('a'); for (var i = 0; i < links.length; i++) { var link = links[i]; link.setAttribute('target', '_parent'); }</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>