<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*** Plugin Scripts and CSS */
if ( ! function_exists( 'sp_location_weather_scripts_and_style' ) ) {
	function sp_location_weather_scripts_and_style() {
		// CSS Files.
		wp_enqueue_style( 'lw-custom', SP_LOCATION_WEATHER_URL . 'assets/css/custom.css', array(), '1.1.2' );
		wp_enqueue_style( 'location-weather-style', SP_LOCATION_WEATHER_URL . 'assets/css/style.css', array(), '1.1.2' );

		include SP_LOCATION_WEATHER_PATH . 'inc/custom-css.php';
		if ( isset( $custom_css ) && ! empty( $custom_css ) ) {
			wp_add_inline_style( 'lw-custom', $custom_css );
		}

		// JS Files.
		wp_enqueue_script( 'location-weather-min-js', SP_LOCATION_WEATHER_URL . 'assets/js/locationWeather.js', array( 'jquery' ), '1.1.1', true );
	}
	add_action( 'wp_enqueue_scripts', 'sp_location_weather_scripts_and_style' );
}
