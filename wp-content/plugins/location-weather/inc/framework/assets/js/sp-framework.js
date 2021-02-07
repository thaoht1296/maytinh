/**
 *
 * -----------------------------------------------------------
 *
 * ShapedPlugin Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 * Copyright 2018 ShapedPlugin <support@shapedplugin.com>
 *
 * -----------------------------------------------------------
 *
 */
;(function ($, window, document, undefined) {
    'use strict';

    $.SPFRAMEWORK = $.SPFRAMEWORK || {};

    // caching selector
    let $sp_body = $('body');

    // caching let / variables
    let sp_is_rtl = $sp_body.hasClass('rtl');

    // ======================================================
    // SPFRAMEWORK TAB NAVIGATION
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_TAB_NAVIGATION = function () {
        return this.each(function () {

            let $this = $(this),
                $nav = $this.find('.sp-nav'),
                $reset = $this.find('.sp-reset'),
                $expand = $this.find('.sp-expand-all');

            $nav.find('ul:first a').on('click', function (e) {

                e.preventDefault();

                let $el = $(this),
                    $next = $el.next(),
                    $target = $el.data('section');

                if ($next.is('ul')) {

                    $next.slideToggle('fast');
                    $el.closest('li').toggleClass('sp-tab-active');

                } else {

                    $('#sp-tab-' + $target).fadeIn('fast').siblings().hide();
                    $nav.find('a').removeClass('sp-section-active');
                    $el.addClass('sp-section-active');
                    $reset.val($target);

                }

            });

            $expand.on('click', function (e) {
                e.preventDefault();
                $this.find('.sp-body').toggleClass('sp-show-all');
                $(this).find('.fa').toggleClass('fa-eye-slash').toggleClass('fa-eye');
            });

        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK DEPENDENCY
    // ------------------------------------------------------
    $.SPFRAMEWORK.DEPENDENCY = function (el, param) {

        // Access to jQuery and DOM versions of element
        let base = this;
        base.$el = $(el);
        base.el = el;

        base.init = function () {

            base.ruleset = $.deps.createRuleset();

            // required for shortcode attrs
            let cfg = {
                show: function (el) {
                    el.removeClass('hidden');
                },
                hide: function (el) {
                    el.addClass('hidden');
                },
                log: false,
                checkTargets: false
            };

            if (param !== undefined) {
                base.depSub();
            } else {
                base.depRoot();
            }

            $.deps.enable(base.$el, base.ruleset, cfg);

        };

        base.depRoot = function () {

            base.$el.each(function () {

                $(this).find('[data-controller]').each(function () {

                    let $this = $(this),
                        _controller = $this.data('controller').split('|'),
                        _condition = $this.data('condition').split('|'),
                        _value = $this.data('value').toString().split('|'),
                        _rules = base.ruleset;

                    $.each(_controller, function (index, element) {

                        let value = _value[index] || '',
                            condition = _condition[index] || _condition[0];

                        _rules = _rules.createRule('[data-depend-id="' + element + '"]', condition, value);
                        _rules.include($this);

                    });

                });

            });

        };

        base.depSub = function () {

            base.$el.each(function () {

                $(this).find('[data-sub-controller]').each(function () {

                    let $this = $(this),
                        _controller = $this.data('sub-controller').split('|'),
                        _condition = $this.data('sub-condition').split('|'),
                        _value = $this.data('sub-value').toString().split('|'),
                        _rules = base.ruleset;

                    $.each(_controller, function (index, element) {

                        let value = _value[index] || '',
                            condition = _condition[index] || _condition[0];

                        _rules = _rules.createRule('[data-sub-depend-id="' + element + '"]', condition, value);
                        _rules.include($this);

                    });

                });

            });

        };


        base.init();
    };

    $.fn.SPFRAMEWORK_DEPENDENCY = function (param) {
        return this.each(function () {
            new $.SPFRAMEWORK.DEPENDENCY(this, param);
        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK CHOSEN
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_CHOSEN = function () {
        return this.each(function () {
            $(this).chosen({
                allow_single_deselect: true,
                disable_search_threshold: 15,
                width: parseFloat($(this).actual('width') + 25) + 'px'
            });
        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK IMAGE SELECTOR
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_IMAGE_SELECTOR = function () {
        return this.each(function () {

            $(this).find('label').on('click', function () {
                $(this).siblings().find('input').prop('checked', false);
            });

        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK SORTER
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_SORTER = function () {
        return this.each(function () {

            let $this = $(this),
                $enabled = $this.find('.sp-enabled'),
                $disabled = $this.find('.sp-disabled');

            $enabled.sortable({
                connectWith: $disabled,
                placeholder: 'ui-sortable-placeholder',
                update: function (event, ui) {

                    let $el = ui.item.find('input');

                    if (ui.item.parent().hasClass('sp-enabled')) {
                        $el.attr('name', $el.attr('name').replace('disabled', 'enabled'));
                    } else {
                        $el.attr('name', $el.attr('name').replace('enabled', 'disabled'));
                    }

                }
            });

            // avoid conflict
            $disabled.sortable({
                connectWith: $enabled,
                placeholder: 'ui-sortable-placeholder'
            });

        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK MEDIA UPLOADER / UPLOAD
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_UPLOADER = function () {
        return this.each(function () {

            let $this = $(this),
                $add = $this.find('.sp-add'),
                $input = $this.find('input'),
                wp_media_frame;

            $add.on('click', function (e) {

                e.preventDefault();

                // Check if the `wp.media.gallery` API exists.
                if (typeof wp === 'undefined' || !wp.media || !wp.media.gallery) {
                    return;
                }

                // If the media frame already exists, reopen it.
                if (wp_media_frame) {
                    wp_media_frame.open();
                    return;
                }

                // Create the media frame.
                wp_media_frame = wp.media({

                    // Set the title of the modal.
                    title: $add.data('frame-title'),

                    // Tell the modal to show only images.
                    library: {
                        type: $add.data('upload-type')
                    },

                    // Customize the submit button.
                    button: {
                        // Set the text of the button.
                        text: $add.data('insert-title'),
                    }

                });

                // When an image is selected, run a callback.
                wp_media_frame.on('select', function () {

                    // Grab the selected attachment.
                    let attachment = wp_media_frame.state().get('selection').first();
                    $input.val(attachment.attributes.url).trigger('change');

                });

                // Finally, open the modal.
                wp_media_frame.open();

            });

        });

    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK IMAGE UPLOADER
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_IMAGE_UPLOADER = function () {
        return this.each(function () {

            let $this = $(this),
                $add = $this.find('.sp-add'),
                $preview = $this.find('.sp-image-preview'),
                $remove = $this.find('.sp-remove'),
                $input = $this.find('input'),
                $img = $this.find('img'),
                wp_media_frame;

            $add.on('click', function (e) {

                e.preventDefault();

                // Check if the `wp.media.gallery` API exists.
                if (typeof wp === 'undefined' || !wp.media || !wp.media.gallery) {
                    return;
                }

                // If the media frame already exists, reopen it.
                if (wp_media_frame) {
                    wp_media_frame.open();
                    return;
                }

                // Create the media frame.
                wp_media_frame = wp.media({
                    library: {
                        type: 'image'
                    }
                });

                // When an image is selected, run a callback.
                wp_media_frame.on('select', function () {

                    let attachment = wp_media_frame.state().get('selection').first().attributes;
                    let thumbnail = ( typeof attachment.sizes.thumbnail !== 'undefined' ) ? attachment.sizes.thumbnail.url : attachment.url;

                    $preview.removeClass('hidden');
                    $img.attr('src', thumbnail);
                    $input.val(attachment.id).trigger('change');

                });

                // Finally, open the modal.
                wp_media_frame.open();

            });

            // Remove image
            $remove.on('click', function (e) {
                e.preventDefault();
                $input.val('').trigger('change');
                $preview.addClass('hidden');
            });

        });

    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK IMAGE GALLERY
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_IMAGE_GALLERY = function () {
        return this.each(function () {

            let $this = $(this),
                $edit = $this.find('.sp-edit'),
                $remove = $this.find('.sp-remove'),
                $list = $this.find('ul'),
                $input = $this.find('input'),
                $img = $this.find('img'),
                wp_media_frame,
                wp_media_click;

            $this.on('click', '.sp-add, .sp-edit', function (e) {

                let $el = $(this),
                    what = ( $el.hasClass('sp-edit') ) ? 'edit' : 'add',
                    state = ( what === 'edit' ) ? 'gallery-edit' : 'gallery-library';

                e.preventDefault();

                // Check if the `wp.media.gallery` API exists.
                if (typeof wp === 'undefined' || !wp.media || !wp.media.gallery) {
                    return;
                }

                // If the media frame already exists, reopen it.
                if (wp_media_frame) {
                    wp_media_frame.open();
                    wp_media_frame.setState(state);
                    return;
                }

                // Create the media frame.
                wp_media_frame = wp.media({
                    library: {
                        type: 'image'
                    },
                    frame: 'post',
                    state: 'gallery',
                    multiple: true
                });

                // Open the media frame.
                wp_media_frame.on('open', function () {

                    let ids = $input.val();

                    if (ids) {

                        let get_array = ids.split(',');
                        let library = wp_media_frame.state('gallery-edit').get('library');

                        wp_media_frame.setState(state);

                        get_array.forEach(function (id) {
                            let attachment = wp.media.attachment(id);
                            library.add(attachment ? [attachment] : []);
                        });

                    }
                });

                // When an image is selected, run a callback.
                wp_media_frame.on('update', function () {

                    let inner = '';
                    let ids = [];
                    let images = wp_media_frame.state().get('library');

                    images.each(function (attachment) {

                        let attributes = attachment.attributes;
                        let thumbnail = ( typeof attributes.sizes.thumbnail !== 'undefined' ) ? attributes.sizes.thumbnail.url : attributes.url;

                        inner += '<li><img src="' + thumbnail + '"></li>';
                        ids.push(attributes.id);

                    });

                    $input.val(ids).trigger('change');
                    $list.html('').append(inner);
                    $remove.removeClass('hidden');
                    $edit.removeClass('hidden');

                });

                // Finally, open the modal.
                wp_media_frame.open();
                wp_media_click = what;

            });

            // Remove image
            $remove.on('click', function (e) {
                e.preventDefault();
                $list.html('');
                $input.val('').trigger('change');
                $remove.addClass('hidden');
                $edit.addClass('hidden');
            });

        });

    };
    // ======================================================


    // ======================================================
    // SPFRAMEWORK GROUP
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_GROUP = function () {
        return this.each(function () {

            let _this = $(this),
                field_groups = _this.find('.sp-groups'),
                accordion_group = _this.find('.sp-accordion'),
                clone_group = _this.find('.sp-group:first').clone();

            if (accordion_group.length) {
                accordion_group.accordion({
                    header: '.sp-group-title',
                    collapsible: true,
                    active: false,
                    animate: 250,
                    heightStyle: 'content',
                    icons: {
                        'header': 'dashicons dashicons-arrow-right',
                        'activeHeader': 'dashicons dashicons-arrow-down'
                    },
                    beforeActivate: function (event, ui) {
                        $(ui.newPanel).SPFRAMEWORK_DEPENDENCY('sub');
                    }
                });
            }

            field_groups.sortable({
                axis: 'y',
                handle: '.sp-group-title',
                helper: 'original',
                cursor: 'move',
                placeholder: 'widget-placeholder',
                start: function (event, ui) {
                    let inside = ui.item.children('.sp-group-content');
                    if (inside.css('display') === 'block') {
                        inside.hide();
                        field_groups.sortable('refreshPositions');
                    }
                },
                stop: function (event, ui) {
                    ui.item.children('.sp-group-title').triggerHandler('focusout');
                    accordion_group.accordion({active: false});
                }
            });

            let i = 0;
            $('.sp-add-group', _this).on('click', function (e) {

                e.preventDefault();

                clone_group.find('input, select, textarea').each(function () {
                    this.name = this.name.replace(/\[(\d+)\]/, function (string, id) {
                        return '[' + (parseInt(id, 10) + 1) + ']';
                    });
                });

                let cloned = clone_group.clone().removeClass('hidden');
                field_groups.append(cloned);

                if (accordion_group.length) {
                    field_groups.accordion('refresh');
                    field_groups.accordion({active: cloned.index()});
                }

                field_groups.find('input, select, textarea').each(function () {
                    this.name = this.name.replace('[_nonce]', '');
                });

                // run all field plugins
                cloned.SPFRAMEWORK_DEPENDENCY('sub');
                cloned.SPFRAMEWORK_RELOAD_PLUGINS();

                i++;

            });

            field_groups.on('click', '.sp-remove-group', function (e) {
                e.preventDefault();
                $(this).closest('.sp-group').remove();
            });

        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK RESET CONFIRM
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_CONFIRM = function () {
        return this.each(function () {
            $(this).on('click', function (e) {
                if (!confirm('Are you sure?')) {
                    e.preventDefault();
                }
            });
        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK SAVE OPTIONS
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_SAVE = function () {
        return this.each(function () {

            let $this = $(this),
                $text = $this.data('save'),
                $value = $this.val(),
                $ajax = $('#sp-save-ajax');

            $(document).on('keydown', function (event) {
                if (event.ctrlKey || event.metaKey) {
                    if (String.fromCharCode(event.which).toLowerCase() === 's') {
                        event.preventDefault();
                        $this.trigger('click');
                    }
                }
            });

            $this.on('click', function (e) {

                if ($ajax.length) {

                    if (typeof tinyMCE === 'object') {
                        tinyMCE.triggerSave();
                    }

                    $this.prop('disabled', true).attr('value', $text);

                    let serializedOptions = $('#sp_framework_form').serialize();

                    $.post('options.php', serializedOptions).error(function () {
                        alert('Error, Please try again.');
                    }).success(function () {
                        $this.prop('disabled', false).attr('value', $value);
                        $ajax.hide().fadeIn().delay(250).fadeOut();
                    });

                    e.preventDefault();

                } else {

                    $this.addClass('disabled').attr('value', $text);

                }

            });

        });
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK UI DIALOG OVERLAY HELPER
    // ------------------------------------------------------
    if (typeof $.widget !== 'undefined' && typeof $.ui !== 'undefined' && typeof $.ui.dialog !== 'undefined') {
        $.widget('ui.dialog', $.ui.dialog, {
                _createOverlay: function () {
                    this._super();
                    if (!this.options.modal) {
                        return;
                    }
                    this._on(this.overlay, {click: 'close'});
                }
            }
        );
    }

    // ======================================================
    // SPFRAMEWORK ICONS MANAGER
    // ------------------------------------------------------
    $.SPFRAMEWORK.ICONS_MANAGER = function () {

        let base = this,
            onload = true,
            $parent;

        base.init = function () {

            $sp_body.on('click', '.sp-icon-add', function (e) {

                e.preventDefault();

                let $this = $(this),
                    $dialog = $('#sp-icon-dialog'),
                    $load = $dialog.find('.sp-dialog-load'),
                    $select = $dialog.find('.sp-dialog-select'),
                    $insert = $dialog.find('.sp-dialog-insert'),
                    $search = $dialog.find('.sp-icon-search');

                // set parent
                $parent = $this.closest('.sp-icon-select');

                // open dialog
                $dialog.dialog({
                    width: 850,
                    height: 700,
                    modal: true,
                    resizable: false,
                    closeOnEscape: true,
                    position: {my: 'center', at: 'center', of: window},
                    open: function () {

                        // fix scrolling
                        $sp_body.addClass('sp-icon-scrolling');

                        // fix button for VC
                        $('.ui-dialog-titlebar-close').addClass('ui-button');

                        // set viewpoint
                        $(window).on('resize', function () {

                            let height = $(window).height(),
                                load_height = Math.floor(height - 237),
                                set_height = Math.floor(height - 125);

                            $dialog.dialog('option', 'height', set_height).parent().css('max-height', set_height);
                            $dialog.css('overflow', 'auto');
                            $load.css('height', load_height);

                        }).resize();

                    },
                    close: function () {
                        $sp_body.removeClass('sp-icon-scrolling');
                    }
                });

                // load icons
                if (onload) {

                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            action: 'sp-lw-get-icons'
                        },
                        success: function (content) {

                            $load.html(content);
                            onload = false;

                            $load.on('click', 'a', function (e) {

                                e.preventDefault();

                                let icon = $(this).data('icon');

                                $parent.find('i').removeAttr('class').addClass(icon);
                                $parent.find('input').val(icon).trigger('change');
                                $parent.find('.sp-icon-preview').removeClass('hidden');
                                $parent.find('.sp-icon-remove').removeClass('hidden');
                                $dialog.dialog('close');

                            });

                            $search.keyup(function () {

                                let value = $(this).val(),
                                    $icons = $load.find('a');

                                $icons.each(function () {

                                    let $ico = $(this);

                                    if ($ico.data('icon').search(new RegExp(value, 'i')) < 0) {
                                        $ico.hide();
                                    } else {
                                        $ico.show();
                                    }

                                });

                            });

                            $load.find('.sp-icon-tooltip').sptooltip({html: true, placement: 'top', container: 'body'});

                        }
                    });

                }

            });

            $sp_body.on('click', '.sp-icon-remove', function (e) {

                e.preventDefault();

                let $this = $(this),
                    $parent = $this.closest('.sp-icon-select');

                $parent.find('.sp-icon-preview').addClass('hidden');
                $parent.find('input').val('').trigger('change');
                $this.addClass('hidden');

            });

        };

        // run initializer
        base.init();
    };
    // ======================================================

    // ======================================================
    // SPFRAMEWORK COLORPICKER
    // ------------------------------------------------------
    if (typeof Color === 'function') {

        // adding alpha support for Automattic Color.js toString function.
        Color.fn.toString = function () {

            // check for alpha
            if (this._alpha < 1) {
                return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
            }

            let hex = parseInt(this._color, 10).toString(16);

            if (this.error) {
                return '';
            }

            // maybe left pad it
            if (hex.length < 6) {
                for (let i = 6 - hex.length - 1; i >= 0; i--) {
                    hex = '0' + hex;
                }
            }

            return '#' + hex;

        };

    }

    $.SPFRAMEWORK.PARSE_COLOR_VALUE = function (val) {

        let value = val.replace(/\s+/g, ''),
            alpha = ( value.indexOf('rgba') !== -1 ) ? parseFloat(value.replace(/^.*,(.+)\)/, '$1') * 100) : 100,
            rgba = ( alpha < 100 ) ? true : false;

        return {value: value, alpha: alpha, rgba: rgba};

    };

    $.fn.SPFRAMEWORK_COLORPICKER = function () {

        return this.each(function () {

            let $this = $(this);

            // check for rgba enabled/disable
            if ($this.data('rgba') !== false) {

                // parse value
                let picker = $.SPFRAMEWORK.PARSE_COLOR_VALUE($this.val());

                // wpColorPicker core
                $this.wpColorPicker({

                    // wpColorPicker: clear
                    clear: function () {
                        $this.trigger('keyup');
                    },

                    // wpColorPicker: change
                    change: function (event, ui) {

                        let ui_color_value = ui.color.toString();

                        // update checkerboard background color
                        $this.closest('.wp-picker-container').find('.sp-alpha-slider-offset').css('background-color', ui_color_value);
                        $this.val(ui_color_value).trigger('change');

                    },

                    // wpColorPicker: create
                    create: function () {

                        // set variables for alpha slider
                        let a8cIris = $this.data('a8cIris'),
                            $container = $this.closest('.wp-picker-container'),

                            // appending alpha wrapper
                            $alpha_wrap = $('<div class="sp-alpha-wrap">' +
                                '<div class="sp-alpha-slider"></div>' +
                                '<div class="sp-alpha-slider-offset"></div>' +
                                '<div class="sp-alpha-text"></div>' +
                                '</div>').appendTo($container.find('.wp-picker-holder')),

                            $alpha_slider = $alpha_wrap.find('.sp-alpha-slider'),
                            $alpha_text = $alpha_wrap.find('.sp-alpha-text'),
                            $alpha_offset = $alpha_wrap.find('.sp-alpha-slider-offset');

                        // alpha slider
                        $alpha_slider.slider({

                            // slider: slide
                            slide: function (event, ui) {

                                let slide_value = parseFloat(ui.value / 100);

                                // update iris data alpha && wpColorPicker color option && alpha text
                                a8cIris._color._alpha = slide_value;
                                $this.wpColorPicker('color', a8cIris._color.toString());
                                $alpha_text.text(( slide_value < 1 ? slide_value : '' ));

                            },

                            // slider: create
                            create: function () {

                                let slide_value = parseFloat(picker.alpha / 100),
                                    alpha_text_value = slide_value < 1 ? slide_value : '';

                                // update alpha text && checkerboard background color
                                $alpha_text.text(alpha_text_value);
                                $alpha_offset.css('background-color', picker.value);

                                // wpColorPicker clear for update iris data alpha && alpha text && slider color option
                                $container.on('click', '.wp-picker-clear', function () {

                                    a8cIris._color._alpha = 1;
                                    $alpha_text.text('');
                                    $alpha_slider.slider('option', 'value', 100).trigger('slide');

                                });

                                // wpColorPicker default button for update iris data alpha && alpha text && slider color option
                                $container.on('click', '.wp-picker-default', function () {

                                    let default_picker = $.SPFRAMEWORK.PARSE_COLOR_VALUE($this.data('default-color')),
                                        default_value = parseFloat(default_picker.alpha / 100),
                                        default_text = default_value < 1 ? default_value : '';

                                    a8cIris._color._alpha = default_value;
                                    $alpha_text.text(default_text);
                                    $alpha_slider.slider('option', 'value', default_picker.alpha).trigger('slide');

                                });

                                // show alpha wrapper on click color picker button
                                $container.on('click', '.wp-color-result', function () {
                                    $alpha_wrap.toggle();
                                });

                                // hide alpha wrapper on click body
                                $sp_body.on('click.wpcolorpicker', function () {
                                    $alpha_wrap.hide();
                                });

                            },

                            // slider: options
                            value: picker.alpha,
                            step: 1,
                            min: 1,
                            max: 100

                        });
                    }

                });

            } else {

                // wpColorPicker default picker
                $this.wpColorPicker({
                    clear: function () {
                        $this.trigger('keyup');
                    },
                    change: function (event, ui) {
                        $this.val(ui.color.toString()).trigger('change');
                    }
                });

            }

        });

    };
    // ======================================================

    // ======================================================
    // ON WIDGET-ADDED RELOAD FRAMEWORK PLUGINS
    // ------------------------------------------------------
    $.SPFRAMEWORK.WIDGET_RELOAD_PLUGINS = function () {
        $(document).on('widget-added widget-updated', function (event, $widget) {
            $widget.SPFRAMEWORK_RELOAD_PLUGINS();
            $widget.SPFRAMEWORK_DEPENDENCY();
        });
    };

    // ======================================================
    // TOOLTIP HELPER
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_TOOLTIP = function () {
        return this.each(function () {
            let placement = ( sp_is_rtl ) ? 'left' : 'right';
            $(this).sptooltip({html: true, placement: placement, container: 'body'});
        });
    };

    // ======================================================
    // Slider field by Shamim
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_SLIDER = function () {
        return this.each(function () {

            let dis = $(this),
                input = $('input', dis),
                slider = $('.sp-lcp-slider > div', dis),
                data = input.data('slider'),
                val = input.val() || 0,
                step = data.step || 1,
                min = data.min || 0,
                max = data.max || 200;

            slider.slider({
                range: "min",
                value: val,
                step: step,
                min: min,
                max: max,
                slide: function (e, o) {
                    input.val(o.value + data.unit).trigger('change');
                }
            });

            input.keyup(function () {
                slider.slider("value", parseInt(input.val()));
            });

        });
    };

// ======================================================
// Advanced Typography field
// ------------------------------------------------------
    jQuery(document).ready(function () {
        jQuery('.sp_font_field').each(function () {
            let parentName = jQuery(this).attr('data-id');
            let preview = jQuery(this).find('#preview-' + parentName);
            let fontColor = jQuery(this).find('.sp-field-color-picker');
            let fontSize = jQuery(this).find('.sp-font-size input');
            let lineHeight = jQuery(this).find('.sp-font-height input');
            let fontFamily = jQuery(this).find('.sp-typo-family');
            let fontWeight = jQuery(this).find('.chosen.sp-typo-variant');
            let textAlignment = jQuery(this).find('.sp-font-alignment select');
            let textTransform = jQuery(this).find('.sp-font-transform select');
            let letterSpacing = jQuery(this).find('.sp-font-spacing select');
            let typography_type = jQuery(this).find('.sp-typo-font');
            // Set current values to preview
            updatePreview(preview, fontColor, fontSize, lineHeight, textAlignment, textTransform, letterSpacing);
            loadGoogleFont(this, parentName, fontFamily, fontWeight);

            // Update preview
            function updatePreview(preview, fontColor, fontSize, lineHeight, textAlignment, textTransform, letterSpacing) {
                preview.css('color', fontColor.val()).css('font-size', fontSize.val() + 'px').css('line-height', lineHeight.val() + 'px').css('text-align', textAlignment.val()).css('text-transform', textTransform.val()).css('letter-spacing', letterSpacing.val());
            }

            // Load selected Google font
            function loadGoogleFont(element, parentName, fontFamily, fontWeight) {

                let font = fontFamily.val();
                let fontWeightStyle = calculateFontWeight(fontWeight.find(':selected').text());

                // Generate font loading html
                let href = 'http://fonts.googleapis.com/css?family=' + font + ':' + fontWeightStyle.fontWeightValue;
                let html = '<link href="' + href + '" class="sp-font-preview-' + parentName + '" rel="stylesheet" type="text/css" />';

                if (jQuery('.sp-font-preview-' + parentName).length > 0) {
                    jQuery('.sp-font-preview-' + parentName).attr('href', href).load();
                } else {
                    jQuery('head').append(html).load();
                }


                // Update preiew
                preview.css('font-family', font).css('font-weight', fontWeightStyle.fontWeightValue).css('font-style', fontWeightStyle.fontStyleValue);

            }

            // Calculte font weight
            function calculateFontWeight(fontWeight) {
                let fontWeightValue = '400';
                let fontStyleValue = 'normal';

                switch (fontWeight) {
                    case '100':
                        fontWeightValue = '100';
                        break;
                    case '100italic':
                        fontWeightValue = '100';
                        fontStyleValue = 'italic';
                        break;
                    case '200':
                        fontWeightValue = '200';
                        break;
                    case '200italic':
                        fontWeightValue = '200';
                        fontStyleValue = 'italic';
                        break;
                    case '300':
                        fontWeightValue = '300';
                        break;
                    case '300italic':
                        fontWeightValue = '300';
                        fontStyleValue = 'italic';
                        break;
                    case '500':
                        fontWeightValue = '500';
                        break;
                    case '500italic':
                        fontWeightValue = '500';
                        fontStyleValue = 'italic';
                        break;
                    case '600':
                        fontWeightValue = '600';
                        break;
                    case '600italic':
                        fontWeightValue = '600';
                        fontStyleValue = 'italic';
                        break;
                    case '700':
                        fontWeightValue = '700';
                        break;
                    case '700italic':
                        fontWeightValue = '700';
                        fontStyleValue = 'italic';
                        break;
                    case '800':
                        fontWeightValue = '800';
                        break;
                    case '800italic':
                        fontWeightValue = '800';
                        fontStyleValue = 'italic';
                        break;
                    case '900':
                        fontWeightValue = '900';
                        break;
                    case '900italic':
                        fontWeightValue = '900';
                        fontStyleValue = 'italic';
                        break;
                    case 'italic':
                        fontStyleValue = 'italic';
                        break;
                }

                return {fontWeightValue, fontStyleValue};
            }

            // Font Variants Auto Load
            fontFamily.on('change', function () {

                let _this = $(this),
                    _type = _this.find(':selected').data('type') || 'custom',
                    _variants = _this.find(':selected').data('variants');

                if (fontWeight.length) {

                    fontWeight.find('option').remove();

                    $.each(_variants.split('|'), function (key, text) {
                        fontWeight.append('<option value="' + text + '">' + text + '</option>');
                    });

                    fontWeight.find('option[value="regular"]').attr('selected', 'selected').trigger('chosen:updated');

                }
                typography_type.val(_type);
            });


            // Font family and weight change event
            jQuery(fontFamily).add(fontWeight).change(function () {
                loadGoogleFont(this, parentName, fontFamily, fontWeight);
            });

            // Font size, line height and weight change event
            preview.add(fontColor).add(fontSize).add(lineHeight).add(textAlignment).add(textTransform).add(letterSpacing).change(function () {
                updatePreview(preview, fontColor, fontSize, lineHeight, textAlignment, textTransform, letterSpacing);
            });
        });
    });
    // ======================================================
    // SPFRAMEWORK BUTTON SET
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_BUTTON_SET = function () {
        return this.each(function () {

            $(this).find('label').on('click', function () {
                $(this).siblings().find('input').prop('checked', false);
            });

        });
    };

    // ======================================================
    // RELOAD FRAMEWORK PLUGINS
    // ------------------------------------------------------
    $.fn.SPFRAMEWORK_RELOAD_PLUGINS = function () {
        return this.each(function () {
            $('.chosen', this).SPFRAMEWORK_CHOSEN();
            $('.sp-field-image-select', this).SPFRAMEWORK_IMAGE_SELECTOR();
            $('.sp-field-image', this).SPFRAMEWORK_IMAGE_UPLOADER();
            $('.sp-field-button-set', this).SPFRAMEWORK_BUTTON_SET();
            $('.sp-field-gallery', this).SPFRAMEWORK_IMAGE_GALLERY();
            $('.sp-field-sorter', this).SPFRAMEWORK_SORTER();
            $('.sp-field-upload', this).SPFRAMEWORK_UPLOADER();
            $('.sp-field-color-picker', this).SPFRAMEWORK_COLORPICKER();
            $('.sp-help', this).SPFRAMEWORK_TOOLTIP();
            // Slider field by Shamim
            $('.sp-field-slider', this).SPFRAMEWORK_SLIDER();
        });
    };

    // ======================================================
    // JQUERY DOCUMENT READY
    // ------------------------------------------------------
    $(document).ready(function () {
        $('.sp-framework').SPFRAMEWORK_TAB_NAVIGATION();
        $('.sp-reset-confirm, .sp-import-backup').SPFRAMEWORK_CONFIRM();
        $('.sp-content, .wp-customizer, .widget-content, .sp-taxonomy').SPFRAMEWORK_DEPENDENCY();
        $('.sp-field-group').SPFRAMEWORK_GROUP();
        $('.sp-save').SPFRAMEWORK_SAVE();
        // Slider field by Codevz
        $('.sp-field-slider').SPFRAMEWORK_SLIDER();
        $sp_body.SPFRAMEWORK_RELOAD_PLUGINS();
        $.SPFRAMEWORK.ICONS_MANAGER();
        $.SPFRAMEWORK.WIDGET_RELOAD_PLUGINS();

    });

})(jQuery, window, document);