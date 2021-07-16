<?php

namespace WP_Wax_Plugin\Extension\Traits;

trait Service_Registrar_Trait {

    /**
     * Register Serivces
     * 
     * @param array $services
     * @return void
     */
    private function register_serivces( $services = [] ) {

        if (  ! is_array( $services ) ) {
            return;
        }

        foreach ( $services as $service ) {
            if ( ! class_exists( $service ) ) {
                continue;
            }

            new $service();
        }
    }
}