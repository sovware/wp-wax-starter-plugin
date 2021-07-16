<?php

namespace WP_Wax_Plugin\Controller\Shortcode;

use WP_Wax_Plugin\Extension\Traits;

/**
 * Shortcodes
 * 
 * @since 1.0.0
 * @package WP_Wax_Plugin\Controller\Ajax
 */
class Shortcodes {

    use Traits\Service_Registrar_Trait;

    public function __construct() {
        $this->register_serivces( $this->get_all_shortcodes() );
    }

    /**
     * Get the hooks handlers
     * 
     * @return array
     * 
     */
    public static function get_all_shortcodes() {
        return [
            WP_Wax_Plugin::class,
        ];
    }
}