<?php 
if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Framework admin enqueue style and scripts
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_lw_admin_enqueue_scripts' ) ) {
	function sp_lw_admin_enqueue_scripts() {

		// SP_LW_Framework.
		$current_screen        = get_current_screen();
		$the_current_id = $current_screen->id;
		if ( $the_current_id == 'toplevel_page_lw_settings' ) {

			// admin utilities.
			wp_enqueue_media();

			// wp core styles.
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			wp_enqueue_style( 'jquery-ui-slider' );

			// framework core styles.
			wp_enqueue_style( 'lw-sp-framework', SP_URI . '/assets/css/sp-framework.css', array(), '1.1.0', 'all' );
			wp_enqueue_style( 'lw-sp-custom', SP_URI . '/assets/css/sp-custom.css', array(), '1.1.0', 'all' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'lw-sp-framework-rtl', SP_URI . '/assets/css/sp-framework-rtl.css', array(), '1.1.0', 'all' );
			}

			// wp core scripts.
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'jquery-ui-dialog' );
			// wp_enqueue_script( 'jquery-ui-sortable' );.
			wp_enqueue_script( 'jquery-ui-slider' );

			// framework core scripts.
			wp_enqueue_script( 'lw-sp-plugins', SP_URI . '/assets/js/sp-plugins.js', array( 'jquery' ), '1.1.0', true );
			wp_enqueue_script( 'lw-sp-framework', SP_URI . '/assets/js/sp-framework.js', array( 'lw-sp-plugins' ), '1.1.0', true );
		}

	}

	add_action( 'admin_enqueue_scripts', 'sp_lw_admin_enqueue_scripts' );
}
