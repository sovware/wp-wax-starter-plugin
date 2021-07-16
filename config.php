<?php
// Plugin version.
if ( ! defined( 'WP_WAX_PLIGIN_VERSION' ) ) {
    define( 'WP_WAX_PLIGIN_VERSION', '1.0.0' );
}
// Script version.
if ( ! defined( 'WP_WAX_SCRIPT_VERSION' ) ) {
    define( 'WP_WAX_SCRIPT_VERSION', WP_WAX_PLIGIN_VERSION );
}
// Script version.
if ( ! defined( 'WP_WAX_LOAD_MIN_FILES' ) ) {
    define( 'WP_WAX_LOAD_MIN_FILES', false );
}
if ( ! defined( 'WP_WAX_PLIGIN_BASE' ) ) {
    define( 'WP_WAX_PLIGIN_BASE', trailingslashit( dirname( WP_WAX_PLIGIN_FILE ) ) );
}
// Plugin Folder Path.
if ( ! defined( 'WP_WAX_PLIGIN_DIR' ) ) {
    define( 'WP_WAX_PLIGIN_DIR', trailingslashit( plugin_dir_path( WP_WAX_PLIGIN_FILE ) ) );
}
// Plugin Folder URL.
if ( ! defined( 'WP_WAX_PLIGIN_URL' ) ) {
    define( 'WP_WAX_PLIGIN_URL', trailingslashit( plugin_dir_url( WP_WAX_PLIGIN_FILE ) ) );
}
// Plugin Assets Path
if ( ! defined( 'WP_WAX_PLIGIN_ASSETS' ) ) {
    define( 'WP_WAX_PLIGIN_ASSETS', WP_WAX_PLIGIN_URL . 'assets/' );
}
// Plugin Assets CSS
if ( ! defined( 'WP_WAX_PLIGIN_CSS' ) ) {
    define( 'WP_WAX_PLIGIN_CSS', WP_WAX_PLIGIN_URL . 'assets/css/' );
}
// Plugin Assets JS
if ( ! defined( 'WP_WAX_PLIGIN_JS' ) ) {
    define( 'WP_WAX_PLIGIN_JS', WP_WAX_PLIGIN_URL . 'assets/js' );
}
// Plugin Templates Path
if ( ! defined( 'WP_WAX_PLIGIN_TEMPLATES_DIR' ) ) {
    define( 'WP_WAX_PLIGIN_TEMPLATES_DIR', WP_WAX_PLIGIN_BASE . 'templates/' );
}
// Plugin Language File Path
if ( ! defined('WP_WAX_PLIGIN_LANG_DIR' ) ) {
    define( 'WP_WAX_PLIGIN_LANG_DIR', WP_WAX_PLIGIN_BASE . 'languages' );
}
// Plugin Name
if ( ! defined('WP_WAX_PLIGIN_NAME') ) {
    define( 'WP_WAX_PLIGIN_NAME', 'WP WaX Plugin' );
}