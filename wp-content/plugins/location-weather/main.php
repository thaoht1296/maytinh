<?php
/**
 * Plugin Name: Location Weather
 * Description: This plugin will enable Weather in your WordPress site.
 * Plugin URI: http://shapedplugin.com/plugin/location-weather-pro/
 * Author: ShapedPlugin
 * Author URI: http://shapedplugin.com/
 * Version: 1.1.2
 */

/* Define */
define( 'SP_LOCATION_WEATHER_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'SP_LOCATION_WEATHER_PATH', plugin_dir_path( __FILE__ ) );

/* Plugin Action Links */
function sp_location_weather_action_links( $pro_links ) {
	$pro_links[] = '<a href="https://shapedplugin.com/plugin/location-weather-pro/" style="color: red; font-weight: bold;">Go Pro!</a>';

	return $pro_links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'sp_location_weather_action_links' );

/* Including files */
require_once 'inc/scripts.php';
require_once 'inc/widget.php';
require_once 'inc/framework/sp-framework.php';
