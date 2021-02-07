<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library Demo
 */

/**
 * Enqueue Google Fonts Example
 */
function customizer_oceanic_theme_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'oceanic-body-font', customizer_library_get_default( 'oceanic-body-font' ) ),
		get_theme_mod( 'oceanic-heading-font', customizer_library_get_default( 'oceanic-heading-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'customizer_oceanic_theme_fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'customizer_oceanic_theme_fonts' );