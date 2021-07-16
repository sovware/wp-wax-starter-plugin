<?php

namespace WP_Wax_Plugin\Controller\Ajax;

use WP_Wax_Plugin\Extension\Traits;

/**
 * Ajax Handler
 * 
 * @since 1.0.0
 * @package WP_Wax_Plugin\Controller\Ajax
 */
class Ajax_Handler {

    use Traits\Service_Registrar_Trait;

    public function __construct() {
        $this->register_serivces( $this->get_ajax_handlers() );
    }

    /**
     * Get the hooks handlers
     * 
     * @return array
     * 
     */
    public static function get_ajax_handlers() {
        return [
            General_Ajax_Handler::class,
        ];
    }
}