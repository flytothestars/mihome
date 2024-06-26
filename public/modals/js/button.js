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

    window.RegularLabs.ModalsButton = window.RegularLabs.ModalsButton || {
        form   : null,
        type   : 'url',
        options: {},

        setForm: function(form) {
            this.form = form;
        },

        insertText: function(editor_name) {
            this.options = Joomla.getOptions ? Joomla.getOptions('rl_modals_button', {}) : Joomla.optionsStorage.rl_modals_button || {};
            this.options.content_id = this.getValue('content_id', 'modal-content-' + Math.round(Math.random() * 1000));

            let html = this.renderHtml();

            if ( ! html) {
                return;
            }

            const editor = parent.Joomla.editors.instances[editor_name];

            html = this.prepareOutputForEditor(html, editor);

            editor.replaceSelection(html);
        },

        renderHtml: function() {
            const tag       = this.options.tag;
            const tag_start = this.options.tag_characters[0];
            const tag_end   = this.options.tag_characters[1];

            this.type = this.getValue('type', 'url');

            const attributes = [
                ...this.getMainAttributes(),
                ...this.getTypeAttributes()
            ];
            const link_text  = this.getLinkText();
            const extra_html = this.getExtraHtml();

            return '<p>'
                + tag_start + (tag + ' ' + attributes.join(' ')).trim() + tag_end
                + link_text
                + tag_start + '/' + tag + tag_end
                + '</p>'
                + extra_html;
        },

        prepareOutputForEditor: function(string, editor) {
            const editor_content   = editor.getValue();
            const editor_selection = editor.getSelection();

            // If the editor is CodeMirror
            if (editor_content === '' || editor_content[0] !== '<') {
                return string;
            }

            // If selection is empty or code is replacing a selection not starting with a html tag
            if (editor_selection.indexOf('<') !== 0) {
                // remove surrounding p tags
                return string.replace(/^<p>(.*)<\/p>$/g, '$1');
            }

            return string;
        },

        getTypeAttributes: function() {
            switch (this.type) {
                case 'content':
                    return this.getTypeAttributesForContent();

                case 'article':
                    return this.getTypeAttributesForArticle();

                case 'image':
                    return this.getTypeAttributesForImage();

                case 'gallery':
                    return this.getTypeAttributesForGallery();

                case 'video':
                    return this.getTypeAttributesForVideo();

                default:
                    return this.getTypeAttributesForUrl();
            }
        },

        getLinkText: function() {
            return this.getValue('text', '');
        },

        getExtraHtml: function() {
            if (this.type !== 'content') {
                return '';
            }

            let content = this.getValue('content').replace(/^<p>(.*)<\/p>$/g, '$1');
            if ( ! content) {
                content = '...';
            }

            const tag_content = this.options.tag_content;
            const tag_start   = this.options.tag_characters[0];
            const tag_end     = this.options.tag_characters[1];

            return '<p>'
                + tag_start + tag_content + ' ' + this.options.content_id + tag_end
                + content
                + tag_start + '/' + tag_content + tag_end
                + '</p>';
        },

        getTypeAttributesForUrl: function() {
            const attributes = [];

            this.addAttribute(attributes, 'url', 'url', null, '...');

            return attributes;
        },

        getTypeAttributesForContent: function() {
            return [
                'content="' + this.options.content_id + '"',
            ];
        },

        getTypeAttributesForArticle: function() {
            const attributes = [];

            let article = this.getValue('article');

            if (article === '' || article === undefined) {
                article = '...';
            } else {
                article = article.split('::')[this.getValue('article_type')];
            }

            attributes.push('article="' + article + '"');

            return attributes;
        },

        getTypeAttributesForImage: function() {
            const attributes = [];

            this.addAttribute(attributes, 'image', 'image', null, '...');
            this.addAttribute(attributes, 'image_thumbnail_width', 'thumbnail-width');
            this.addAttribute(attributes, 'image_thumbnail_height', 'thumbnail-height');

            return attributes;
        },

        getTypeAttributesForGallery: function() {
            const attributes = [];

            this.addAttribute(attributes, 'gallery', 'gallery', null, '...');

            let first = this.getValue('gallery_first');
            if (first === 'specific') {
                first = this.getValue('gallery_first_image');
            }
            if (first) {
                attributes.push('first="' + first + '"');
            }

            this.addAttribute(attributes, 'slideshow');

            let thumbnails = this.getValue('gallery_thumbnails');
            if (thumbnails === 'specific') {
                thumbnails = this.getValue('gallery_thumbnail_image');
            }
            if (thumbnails) {
                attributes.push('thumbnails="' + thumbnails + '"');
            }

            if ( ! this.getValue('text')) {
                this.addAttribute(attributes, 'gallery_thumbnail_width', 'thumbnail-width');
                this.addAttribute(attributes, 'gallery_thumbnail_height', 'thumbnail-height');
            }

            return attributes;

        },

        getTypeAttributesForVideo: function() {
            const attributes = [];

            const youtube = this.getValue('youtube');
            if (youtube) {
                attributes.push('youtube="' + youtube + '"');
                return attributes;
            }

            const vimeo = this.getValue('vimeo');
            if (vimeo) {
                attributes.push('vimeo="' + vimeo + '"');
                return attributes;
            }

            this.addAttribute(attributes, 'video', 'url', null, '...');

            return attributes;
        },

        getMainAttributes: function() {
            const attributes = [];

            this.addAttribute(attributes, 'title');
            this.addAttribute(attributes, 'description');
            this.addAttribute(attributes, 'theme');
            this.addAttribute(attributes, 'class');
            this.addAttribute(attributes, 'classname');
            this.addAttribute(attributes, 'width');
            this.addAttribute(attributes, 'height');
            this.addAttribute(attributes, 'open');
            this.addAttribute(attributes, 'autoclose');

            return attributes;
        },

        addAttribute: function(attributes, id, key = null, true_value = null, false_value = null) {
            key = key ? key : id;

            let value = this.getValue(id);

            // join value if it is an array
            if (Array.isArray(value)) {
                value = value.join(',');
            }

            if (value === '' || value === undefined || value === null) {
                if (false_value !== null) {
                    attributes.push(key + '="' + false_value + '"');
                }
                return;
            }

            value = true_value !== null ? true_value : value;

            attributes.push(key + '="' + value + '"');
        },

        getValue: function(id, default_value = '') {
            let elements = this.form.querySelectorAll('[name="' + id + '"]');

            if ( ! elements.length) {
                elements = this.form.querySelectorAll('[name="' + id + '[]"]');
            }

            if ( ! elements.length) {
                return default_value;
            }

            const element = elements[0];

            if (element.type === 'textarea') {
                return this.fixType(this.getEditorContent(element));
            }

            let value = element.value ? element.value : default_value;

            if (element.type === 'select-one') {
                if (element.type === 'checkbox' && ! element.checked) {
                    return default_value;
                }

                return this.fixType(value);
            }

            if (element.type === 'select-multiple') {
                value = [];

                for (let i = 0; i < element.options.length; i++) {
                    if (element.options[i].selected && element.options[i].value !== '') {
                        value.push(element.options[i].value);
                    }
                }

                return this.fixType(value);
            }

            if (elements.length > 1) {
                value = [];

                for (let i = 0; i < elements.length; i++) {
                    if ((elements[i].selected || elements[i].checked) && elements[i].value !== '') {
                        value.push(elements[i].value);
                    }
                }

                if (element.type === 'radio') {
                    return this.fixType(value[0]);
                }

                return this.fixType(value);
            }

            return this.fixType(value);
        },

        fixType: function(value) {
            // if it is an array, run fixType on each value
            if (Array.isArray(value)) {
                value.forEach((val, index) => {
                    value[index] = this.fixType(val);
                });

                return value;
            }

            if (isNaN(value) || isNaN(parseInt(value))) {
                return value;
            }

            return Number(value);
        },

        getEditorContent: function(element) {
            const editor = this.form.editors[element.id];

            if (typeof editor === 'undefined') {
                return element.value;
            }

            const value = editor.getValue();

            if (typeof value === 'undefined') {
                return '';
            }

            return value.replace(/^<p><\/p>$/, '');
        },
    };
})();
