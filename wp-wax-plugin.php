<?php
/**
 * Plugin Name: WP Wax Starter Plugin
 * Plugin URI: https://github.com/sovware/wp-wax-starter-plugin
 * Description: This is a WordpPress starter plugin based on MVC design pattern
 * Version: 1.0.0
 * Author: wpWax
 * Author URI: https://wpwax.com
 * License: GPLv2 or later
 * Text Domain: wp-wax-starter-plugin
 * Domain Path: /languages
 */

// prevent direct access to the file
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

// Plugin Root File.
if ( ! defined( 'WP_WAX_PLIGIN_FILE' ) ) {
    define( 'WP_WAX_PLIGIN_FILE',  __FILE__ );
}

include trailingslashit( dirname( WP_WAX_PLIGIN_FILE ) ) . 'vendor/autoload.php';
include trailingslashit( dirname( WP_WAX_PLIGIN_FILE ) ) . 'config.php';
include trailingslashit( dirname( WP_WAX_PLIGIN_FILE ) ) . 'app.php';

if ( class_exists( 'WP_Wax_Plugin' ) ) {
    function WP_Wax_Plugin() {
        return WP_Wax_Plugin::get_instance();
    }
    
    WP_Wax_Plugin();
}
