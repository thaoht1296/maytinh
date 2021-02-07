<?php
/**
 * Plugin Name:         WooCommerce Variation images gallery
 * Plugin URI:          https://radiustheme.com
 * Description:         WooCommerce variation images gallery plugin allows to add UNLIMITED additional images for each variation of product.
 * Version:             1.1.21
 * Author:              RadiusTheme
 * Author URI:          https://radiustheme.com
 * Requires at least:   4.8
 * Tested up to:        5.4
 * WC requires at least:3.2
 * WC tested up to:     4.0
 * Domain Path:         /languages
 * Text Domain:         woo-product-variation-gallery
 */

defined( 'ABSPATH' ) or die( 'Keep Silent' );

// Define RTWPVG_PLUGIN_FILE.
if ( ! defined( 'RTWPVG_PLUGIN_FILE' ) ) {
	define( 'RTWPVG_PLUGIN_FILE', __FILE__ );
}

// Define RTWPVG_VERSION.
if ( ! defined( 'RTWPVG_VERSION' ) ) {
	$plugin_data = get_file_data( RTWPVG_PLUGIN_FILE, array( 'version' => 'Version' ), false );
	define( 'RTWPVG_VERSION', $plugin_data['version'] );
}

if ( ! class_exists( 'WooProductVariationGallery' ) ) {
	require_once( "app/WooProductVariationGallery.php" );
}
