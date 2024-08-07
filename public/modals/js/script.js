/**
 * @package         Modals
 * @version         14.0.1PRO
 *
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            https://regularlabs.com
 * @copyright       Copyright © 2023 Regular Labs All Rights Reserved
 * @license         GNU General Public License version 2 or later
 */

import {Modal} from './modules/modal.js?14.0.1.p';
import {Helper} from './modules/helper.js?14.0.1.p';

(function() {
    'use strict';

    window.RegularLabs = window.RegularLabs || {};

    window.RegularLabs.Modals = window.RegularLabs.Modals || {
        defaults: {
            theme                    : 'dark',
            width                    : '',
            height                   : '',
            iframeWidth              : '100%',
            iframeHeight             : '100%',
            videoWidth               : '100vw',
            videoHeight              : '56.25vw',
            position                 : 'center',
            openEffect               : 'zoom',
            closeEffect              : 'zoom',
            nextEffect               : 'slideForward',
            previousEffect           : 'slideBackward',
            titlePosition            : 'top',
            descriptionPosition      : 'bottom',
            dimensionsIncludeTitle   : false,
            titleTagType             : 'h3',
            showCloseButton          : true,
            closeOnOutsideClick      : true,
            keyboardNavigation       : true,
            pagination               : 'buttons',
            paginationAsImages       : true,
            paginationTextDivider    : '/',
            showCountdown            : false,
            slideshow                : false,
            slideshowInterval        : 5000,
            slideshowResume          : true,
            slideshowResumeTimeout   : 10000,
            minimumTouchSlideMovement: 50,
            disableOnNarrow          : false,
            disableBasedOn           : 'window',
            disableBreakPoint        : 576,
            cssEffects               : {
                fade         : {
                    in : 'fade-in',
                    out: 'fade-out'
                },
                zoom         : {
                    in : 'zoom-in',
                    out: 'zoom-out'
                },
                slideForward : {
                    // use left/right depending on the direction of the language
                    in : document.documentElement.getAttribute('dir') === 'rtl' ? 'slide-in-to-right' : 'slide-in-to-left',
                    out: document.documentElement.getAttribute('dir') === 'rtl' ? 'slide-out-to-right' : 'slide-out-to-left'
                },
                slideBackward: {
                    // use left/right depending on the direction of the language
                    in : document.documentElement.getAttribute('dir') === 'rtl' ? 'slide-in-to-left' : 'slide-in-to-right',
                    out: document.documentElement.getAttribute('dir') === 'rtl' ? 'slide-out-to-left' : 'slide-out-to-right'
                },
                legacy       : {
                    in : 'fade-in',
                    out: 'hide'
                },
                none         : {
                    in : 'show',
                    out: 'hide'
                }
            },
            htmlTemplates            : {
                modal           : `
                    <div data-modals-element="modal" class="hidden" tabindex="-1" role="dialog" aria-hidden="true">
                        <div data-modals-element="overlay" data-modals-close-on-click></div>
                        <div data-modals-element="spinner"></div>
                        <div data-modals-element="container" data-modals-close-on-click>
                            <div data-modals-element="main" data-modals-close-on-click>
                                <div data-modals-element="left">
                                    <button type="button" data-modals-element="previous" class="hidden btn-all" aria-label="${Joomla.Text._('MDL_MODALTXT_PREVIOUS')}" data-modals-taborder="3"></button>
                                </div>
                                <div data-modals-element="center" data-modals-close-on-click>
                                    <div data-modals-element="slides" data-modals-close-on-click></div>
                                </div>
                                <div data-modals-element="right">
                                    <button type="button" data-modals-element="next" class="hidden btn-all" aria-label="${Joomla.Text._('MDL_MODALTXT_NEXT')}" data-modals-taborder="2"></button>
                                </div>
                            </div>
                            <div data-modals-element="pagination-bar" data-modals-close-on-click>
                                <div data-modals-element="pagination"></div>
                            </div>
                            <div data-modals-element="close-bar" data-modals-close-on-click>
                                <button type="button" data-modals-element="close" class="hidden btn-all" aria-label="${Joomla.Text._('MDL_MODALTXT_CLOSE')}" data-modals-taborder="1"></button>
                            </div>
                        </div>
                    </div>
                    `,
                slide           : `
                    <div data-modals-element="slide" class="hidden" data-modals-close-on-click>
                        <div data-modals-element="slide-container" data-modals-close-on-click>
                            <div data-modals-element="slide-before" class="hidden"></div>
                            <div data-modals-element="slide-content">
                                <div data-modals-element="slide-content-inner"></div>
                                <div data-modals-element="countdown" class="hidden"></div>
                            </div>
                            <div data-modals-element="slide-after" class="hidden"></div>
                        </div>
                    </div>
                    `,
                paginationButton: '<button type="button" data-modals-element="pagination-button">%number%</button>',
                paginationText  : `
                    <div data-modals-element="pagination-text">
                        <span data-modals-element="pagination-text-number"></span>
                        <span data-modals-element="pagination-text-divider"></span>
                        <span data-modals-element="pagination-text-total"></span>
                    </div>
                    `,
                title           : '<%titleTagType% data-modals-element="slide-title"></%titleTagType%>',
                description     : '<div data-modals-element="slide-description"></div>',
            }
        },

        settings    : {},
        modals      : [],
        bodyElements: [],
        groupCounter: 0,

        init: async function(settings) {
            const setSettings = (settings) => {
                return new Promise(resolve => {
                    if (this.settings.length) {
                        return;
                    }

                    this.settings = {...this.defaults};

                    if (
                        typeof Joomla !== 'undefined'
                        && typeof Joomla.getOptions !== 'undefined'
                    ) {
                        this.settings = {
                            ...this.settings,
                            ...Joomla.getOptions('rl_modals')
                        };
                    }

                    this.settings = {
                        ...this.settings,
                        ...settings
                    };

                    resolve();
                });
            };

            const createModalsFromLinks = async () => {
                const links = document.querySelectorAll('[data-modals]');

                for (const link of links) {
                    await RegularLabs.Modals.createModalFromLink(link);
                }
            };

            const setBodyElements = () => {
                if (this.bodyElements.length) {
                    return;
                }

                const children = document.body.childNodes;

                children.forEach((child) => {
                    if (child.parentNode === document.body
                        && child.nodeName.charAt(0) !== '#'
                        && child.hasAttribute
                        && ! child.hasAttribute('aria-hidden')
                    ) {
                        this.bodyElements.push(child);
                    }
                });
            };

            setBodyElements();
            await setSettings(settings);
            await createModalsFromLinks();
        },

        createModalFromLink: async function(link) {
            return new Promise(async (resolve) => {
                if ( ! (link instanceof Element)) {
                    resolve();
                    return;
                }

                if (Helper.getData(link, 'done')) {
                    resolve();
                    return;
                }

                const group = this.getGroupFromLink(link);

                if ( ! group) {
                    resolve();
                    return;
                }

                this.modals[group] = this.modals[group] || new Modal(link, group);

                resolve();
            });
        },

        getGroupFromLink: function(link) {
            if ( ! (link instanceof Element)) {
                return false;
            }

            let group = Helper.getData(link, 'group');

            if ( ! group) {
                group = '_group_' + RegularLabs.Modals.groupCounter++;
                Helper.setData(link, 'group', group);
            }

            return group;
        },

        hideBodyElements: function() {
            if ( ! this.bodyElements.length) {
                return;
            }

            this.bodyElements.forEach((element) => {
                element.setAttribute('aria-hidden', 'true');
            });
        },

        showBodyElements: function() {
            if ( ! this.bodyElements.length) {
                return;
            }

            this.bodyElements.forEach((element) => {
                element.removeAttribute('aria-hidden');
            });
        },

        open: function(link) {
            const modal = this.getModalByLink(link);

            if ( ! modal) {
                return;
            }

            modal.open();
        },

        close: function(link) {
            if ( ! link) {
                this.closeAll();
                return;
            }

            const modal = this.getModalByLink(link);

            if ( ! modal) {
                return;
            }

            modal.close();
        },

        closeAll: function() {
            for (const group in this.modals) {
                this.modals[group].close();
            }
        },

        getModalByLink: function(link) {
            for (const group in this.modals) {
                if (this.modals[group].link === link) {
                    return this.modals[group];
                }
            }

            return null;
        },
    };

    RegularLabs.Modals.init();
})();

window.RLModals = window.RLModals || (function(options) {
    return RegularLabs.Modals.init(options);
});
