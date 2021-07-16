<?php

namespace WP_Wax_Plugin\Controller\Hook;

use WP_Wax_Plugin\Extension\Traits;

/**
 * Hooks Handler
 * 
 * @since 1.0.0
 * @package WP_Wax_Plugin\Controller
 */
class Hooks_Handler {

    use Traits\Service_Registrar_Trait;

    public function __construct() {
        $this->register_serivces( $this->get_hooks_handlers() );
    }

    /**
     * Get the hooks handlers
     * 
     * @return array
     * 
     */
    public static function get_hooks_handlers() {
        return [
            General_Hook_Handler::class,
        ];
    }
}