<?php

namespace WP_Wax_Plugin\Helper;

class Asset_Helper {

    /**
	 * Get script version
	 *
	 * @return mixed
	 */
	public static function get_script_version() {
        $script_version = ( self::can_load_min() ) ? WP_WAX_SCRIPT_VERSION : md5( time() );
		return apply_filters( 'wp_wax_plugin_script_version', $script_version );
	}

    /**
	 * Check if min file can be loaded or not
	 *
	 * @return bool
	 */
	public static function can_load_min() {
		return apply_filters( 'wp_wax_plugin_load_min_files',  WP_WAX_LOAD_MIN_FILES );
	}
}


