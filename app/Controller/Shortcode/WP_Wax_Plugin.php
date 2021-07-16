<?php

namespace WP_Wax_Plugin\Controller\Shortcode;

/**
 * WP_Wax_Plugin
 * 
 * @since 1.0.0
 * @package WP_Wax_Plugin\Controller\Ajax
 */
class WP_Wax_Plugin {

    public function __construct() {
        add_shortcode( 'wp_wax_plugin', [ $this, 'render_shortcode' ] );
    }


    /**
     * Render Shortcode
     */
    public function render_shortcode( $atts = [] ) {
        return wp_wax_plugin_get_template( 'shortcodes/wp-wax-plugin', [], 'return' );
    }
}