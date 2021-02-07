<?php

namespace Rtwpvg\Controllers;

class ThemeSupport
{
    /**
     * ThemeSupport constructor.
     * Add Theme Support for different theme
     */
    public function __construct() {
        add_action('init', array($this, 'add_theme_support'), 200);
    }

    function add_theme_support() {
        // Electro Theme remove extra gallery
        if (apply_filters('rtwpvg_add_electro_theme_support', true)) {
            remove_action('woocommerce_before_single_product_summary', 'electro_show_product_images', 20);
        }
    }

}