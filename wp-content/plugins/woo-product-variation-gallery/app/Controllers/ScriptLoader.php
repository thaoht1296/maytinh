<?php

namespace Rtwpvg\Controllers;


class ScriptLoader
{

    private $suffix;
    private $version;

    public function __construct() {
        $this->suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $this->version = defined('WP_DEBUG') ? time() : rtwpvg()->version();

        add_action('admin_footer', array($this, 'admin_template_js'));
        add_action('wp_footer', array($this, 'slider_thumbnail_template_js'));

        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts() {

        if (apply_filters('rtwpvg_disable_enqueue_scripts', false)) {
            return;
        }
        $gallery_thumbnails_columns = absint(apply_filters('rtwpvg_thumbnails_columns', rtwpvg()->get_option('thumbnails_columns')));
        $gallery_width = absint(apply_filters('rtwpvg_gallery_width', rtwpvg()->get_option('gallery_width')));
        $gallery_md_width = absint(apply_filters('rtwpvg_gallery_md_width', rtwpvg()->get_option('gallery_md_width')));
        $gallery_sm_width = absint(apply_filters('rtwpvg_gallery_sm_width', rtwpvg()->get_option('gallery_sm_width')));
        $gallery_xsm_width = absint(apply_filters('rtwpvg_gallery_xsm_width', rtwpvg()->get_option('gallery_xsm_width')));

        wp_enqueue_script('rtwpvg-slider', esc_url(rtwpvg()->get_assets_uri("/js/slick{$this->suffix}.js")), array('jquery'), '1.8.1', true);

        wp_enqueue_style('rtwpvg-slider', esc_url(rtwpvg()->get_assets_uri("/css/slick{$this->suffix}.css")), array(), '1.8.1');

        wp_enqueue_script('rtwpvg', esc_url(rtwpvg()->get_assets_uri("/js/rtwpvg{$this->suffix}.js")), array(
            'jquery',
            'wp-util',
            'imagesloaded'
        ), $this->version, true);

        wp_localize_script('rtwpvg', 'rtwpvg', apply_filters('rtwpvg_js_options', array(
            'reset_on_variation_change' => rtwpvg()->get_option('reset_on_variation_change'),
            'enable_zoom'               => rtwpvg()->get_option('zoom'),
            'enable_lightbox'           => rtwpvg()->get_option('lightbox'),
            'thumbnails_columns'        => $gallery_thumbnails_columns,
            'is_mobile'                 => function_exists('wp_is_mobile') && wp_is_mobile(),
            'gallery_width'             => $gallery_width,
            'gallery_md_width'          => $gallery_md_width,
            'gallery_sm_width'          => $gallery_sm_width,
            'gallery_xsm_width'         => $gallery_xsm_width,
        )));

        wp_enqueue_style('rtwpvg', esc_url(rtwpvg()->get_assets_uri("/css/rtwpvg{$this->suffix}.css")), array('dashicons'), $this->version);

        $this->add_inline_style();

    }

    public function admin_enqueue_scripts() {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';
        if (in_array($screen_id, array('product', 'edit-product'))) {
            wp_deregister_script('wc-admin-variation-meta-boxes');
            wp_register_script('wc-admin-variation-meta-boxes', rtwpvg()->get_assets_uri("/js/meta-boxes-product-variation{$this->suffix}.js"), ['wc-admin-meta-boxes', 'serializejson', 'media-models'], $this->version);
        }
        if ((isset($_GET['post_type']) && $_GET['post_type'] == 'product') || $screen_id === 'product' || ((isset($_GET['page']) && $_GET['page'] == "wc-settings") && (isset($_GET['tab']) && $_GET['tab'] == "rtwpvg"))) {

            wp_enqueue_style('rtwpvg-admin', esc_url(rtwpvg()->get_assets_uri("/css/admin{$this->suffix}.css")), array(), $this->version);
            wp_enqueue_script('rtwpvg-admin', esc_url(rtwpvg()->get_assets_uri("/js/admin{$this->suffix}.js")), array(
                'jquery',
                'jquery-ui-sortable',
                'wp-util'
            ), $this->version, true);

            wp_localize_script('rtwpvg-admin', 'rtwpvg_admin', array(
                'choose_image' => esc_html__('Choose Image', 'woo-product-variation-gallery'),
                'add_image'    => esc_html__('Add Images', 'woo-product-variation-gallery')
            ));
        }
    }

    public function add_inline_style() {
        if (apply_filters('rtwpvg_disable_inline_style', false)) {
            return;
        }
        $single_image_width = absint(wc_get_theme_support('single_image_width', get_option('woocommerce_single_image_width', 600)));
        $gallery_margin = absint(apply_filters('rtwpvg_gallery_margin', rtwpvg()->get_option('gallery_margin')));
        $gallery_thumbnails_gap = absint(apply_filters('rtwpvg_thumbnails_gap', rtwpvg()->get_option('thumbnails_gap')));
        $gallery_width = absint(apply_filters('rtwpvg_gallery_width', rtwpvg()->get_option('gallery_width')));
        $gallery_md_width = absint(apply_filters('rtwpvg_gallery_md_width', rtwpvg()->get_option('gallery_md_width')));
        $gallery_sm_width = absint(apply_filters('rtwpvg_gallery_sm_width', rtwpvg()->get_option('gallery_sm_width')));
        $gallery_xsm_width = absint(apply_filters('rtwpvg_gallery_xsm_width', rtwpvg()->get_option('gallery_xsm_width')));
        ob_start();
        ?>
        <style type="text/css">
            :root {
                --rtwpvg-thumbnail-gap: <?php echo $gallery_thumbnails_gap ?>px;
                --rtwpvg-gallery-margin-bottom: <?php echo $gallery_margin ?>px;
                --rtwpvg-single-image-size: <?php echo $single_image_width ?>px;
            }

            /* Large Screen / Default Width */
            .rtwpvg-images {
                max-width: <?php echo $gallery_width ?>%;
            }

            /* MD, Desktops */
            <?php if( $gallery_md_width > 0 ): ?>
            @media only screen and (max-width: 992px) {
                .rtwpvg-images {
                    width: <?php echo $gallery_md_width ?>px;
                    max-width: 100% !important;
                }
            }

            <?php endif; ?>

            /* SM Devices, Tablets */
            <?php if( $gallery_sm_width > 0 ): ?>
            @media only screen and (max-width: 768px) {
                .rtwpvg-images {
                    width: <?php echo $gallery_sm_width ?>px;
                    max-width: 100% !important;
                }
            }

            <?php endif; ?>

            /* XSM Devices, Phones */
            <?php if( $gallery_xsm_width > 0 ): ?>
            @media only screen and (max-width: 480px) {
                .rtwpvg-images {
                    width: <?php echo $gallery_xsm_width ?>px;
                    max-width: 100% !important;
                }
            }

            <?php endif; ?>
        </style>
        <?php
        $css = ob_get_clean();
        $css = str_ireplace(array('<style type="text/css">', '</style>'), '', $css);

        $css = apply_filters('rtwpvg_inline_style', $css);
        wp_add_inline_style('rtwpvg', $css);
    }

    public function admin_template_js() {
        require_once rtwpvg()->locate_template('template-admin-thumbnail');
    }

    function slider_thumbnail_template_js() {
        require_once rtwpvg()->locate_template('template-slider');
        require_once rtwpvg()->locate_template('template-thumbnail');
    }

}
