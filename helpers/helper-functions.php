<?php

// Prohibit direct script loading.
defined('ABSPATH') || die('No direct script access allowed!');

if ( ! function_exists( 'wp_wax_plugin_get_template' ) ) {
    function wp_wax_plugin_get_template( $template_name = '', $data = '', $output = 'echo', $base = WP_WAX_PLIGIN_TEMPLATES_DIR ) {
        if ( ! ( is_string( $template_name ) && is_string( $base ) )  ) {
            if ( 'return' === $output ) {
                return;
            }

            echo '';
            return;
        }
        
        $base = apply_filters( 'wp_wax_plugin_template_base', $base );
        $file = trailingslashit( $base ) . $template_name . '.php';

        if ( ! file_exists( $file ) ) {
            if ( 'return' === $output ) {
                return;
            }

            echo '';
            return;
        }

        ob_start();
        include( $file );
        $template = ob_get_clean();

        if ( 'return' === $output ) {
            return $template;
        }

        echo $template;
    }
}