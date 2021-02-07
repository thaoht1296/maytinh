<?php
/**
 * oceanic Theme Customizer
 *
 * @package oceanic
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function oceanic_customize_register( $wp_customize ) {
	/*
	$widget_area = (object) $wp_customize->get_section( 'sidebar-widgets-oceanic-site-footer' );
	$widget_area->panel = '';
	$widget_area->title = __( 'Widgets: Footer', 'textdomain' );
	$widget_area->priority = 100;
	
	$widget_area = (object) $wp_customize->get_section( 'sidebar-widgets-sidebar-1' );
	$widget_area->panel = '';
	$widget_area->title = __( 'Widgets: Sidebar', 'textdomain' );
	$widget_area->priority = 100;
	*/
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'oceanic_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function oceanic_customize_preview_js() {
	wp_enqueue_script( 'oceanic_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'oceanic_customize_preview_js' );
