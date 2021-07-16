<?php

namespace WP_Wax_Plugin\Controller\Asset;

class Public_Assets {

     /**
	 * Get CSS Scripts
	 *
	 * @return array
	 */
    public static function get_css_scripts() {
        $scripts = [];

		$scripts['wp-wax-plugin-public-style'] = self::with_css_default([
            'file_name' => 'public-main'
        ]);

        return $scripts;
    }


     /**
	 * Get JS Scripts
	 *
	 * @return array
	 */
    public static function get_js_scripts() {
        $scripts = [];

		$scripts['wp-wax-plugin-public-script'] = self::with_js_default([
            'file_name' => 'public-main'
        ]);

        return $scripts;
    }
    

    /**
	 * With CSS Default
	 *
	 * @return array
	 */
    public static function with_css_default( array $args = [] ) {
        $default = [
			'base_path' => WP_WAX_PLIGIN_CSS,
			'deps'      => [],
			'group'     => 'public', // public | admin | global | block-editor
        ];

        return array_merge( $default, $args );
    }

    /**
	 * With JS Default
	 *
	 * @return array
	 */
    public static function with_js_default( array $args = [] ) {
        $default = [
			'base_path' => WP_WAX_PLIGIN_JS,
			'deps'      => [],
			'group'     => 'public', // public | admin | global | block-editor
        ];

        return array_merge( $default, $args );
    }
}