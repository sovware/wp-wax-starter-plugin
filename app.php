<?php

use WP_Wax_Plugin\Controller;
use WP_Wax_Plugin\Extension\Traits;

final class WP_Wax_Plugin {

    use Traits\Service_Registrar_Trait;

    public static $instance = null;

    /**
     * The Constructor
     * 
     * Making it private so that the class can't
     * be instantiate with new keyword
     * 
     */
    private function __construct() {
        $this->register_serivces( $this->get_controllers() );
    }


    /**
     * Get the instance of the class 
     * 
     * It makes insure that the class doesn't instantiate twice 
     * to maintain the Singleton pattern.
     * 
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new WP_Wax_Plugin();
        }

        return self::$instance;
    }


    /**
     * Get the controllers
     * 
     * @return array
     * 
     */
    public static function get_controllers() {
        return [
            Controller\Asset\Assets_Enqueuer::class,
            Controller\Ajax\Ajax_Handler::class,
            Controller\Hook\Hooks_Handler::class,
            Controller\Shortcode\Shortcodes::class,
        ];
    }
}