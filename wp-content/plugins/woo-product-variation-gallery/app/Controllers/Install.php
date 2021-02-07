<?php

namespace Rtwpvg\Controllers;


class Install {

	static function activated() {
		update_option( 'rtwpvg_active', 'yes' );
		if ( ! get_option( 'rtwpvg_version' ) ) {
			// acc some options
		}

		// Update version
		delete_option( 'rtwpvg_version' );
		add_option( 'rtwpvg_version', rtwpvg()->version() );
	}

	static function deactivated() {
		delete_option( 'rtwpvg_active' );
	}

}