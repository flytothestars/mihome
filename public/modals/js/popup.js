/**
 * @package         Modals
 * @version         14.0.1PRO
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            https://regularlabs.com
 * @copyright       Copyright © 2023 Regular Labs All Rights Reserved
 * @license         GNU General Public License version 2 or later
 */

(function() {
    'use strict';

    window.RegularLabs = window.RegularLabs || {};

    window.RegularLabs.ModalsPopup = window.RegularLabs.ModalsPopup || {
        form: null,

        init: function() {
            if ( ! parent.RegularLabs.ModalsButton) {
                document.querySelector('body').innerHTML = '<div class="alert alert-error">This page cannot function on its own.</div>';
                return;
            }

            const content_editor = Joomla.editors.instances['content'];

            try {
                content_editor.getValue();
            } catch (err) {
                setTimeout(() => {
                    RegularLabs.ModalsPopup.init();
                }, 100);
                return;
            }

            this.form         = document.getElementById('modalsForm');
            this.form.editors = Joomla.editors.instances;

            parent.RegularLabs.ModalsButton.setForm(this.form);
        }
    };
})();
