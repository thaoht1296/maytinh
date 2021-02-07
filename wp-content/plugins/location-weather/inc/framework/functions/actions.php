<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_lw_get_icons' ) ) {
	function sp_lw_get_icons() {

		do_action( 'sp_add_icons_before' );

		$jsons = glob( SP_DIR . '/fields/icon/*.json' );

		if( ! empty( $jsons ) ) {

			foreach ( $jsons as $path ) {

				$object = sp_lw_get_icon_fonts( 'fields/icon/'. basename( $path ) );

				if( is_object( $object ) ) {

					echo ( count( $jsons ) >= 2 ) ? '<h4 class="sp-icon-title">'. $object->name .'</h4>' : '';

					foreach ( $object->icons as $icon ) {
						echo '<a class="sp-icon-tooltip" data-icon="'. $icon .'" data-title="'. $icon .'"><span class="sp-icon sp-selector"><i class="'. $icon .'"></i></span></a>';
					}

				} else {
					echo '<h4 class="sp-icon-title">'. __( 'Error! Can not load json file.', 'location-weather' ) .'</h4>';
				}

			}

		}

		do_action( 'sp_add_icons' );
		do_action( 'sp_add_icons_after' );

		die();
	}
	add_action( 'wp_ajax_sp-lw-get-icons', 'sp_lw_get_icons' );
}
