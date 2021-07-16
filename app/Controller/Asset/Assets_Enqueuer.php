<?php

namespace WP_Wax_Plugin\Controller\Asset;

use WP_Wax_Plugin\Extension\Abstracts\Enqueuer;
use WP_Wax_Plugin\Helper\Asset_Helper;

/**
 * Assets Enqueuer
 * 
 * @since 1.0.1
 * @package WP_Wax_Plugin\Controller
 */
class Assets_Enqueuer extends Enqueuer {

    public function __construct() {
        // Load Assets
        add_action( 'init', [ $this, 'load_assets' ] );

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_public_scripts' ] );

        // Enqueue Admin Scripts
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );

        // Enqueue Block Editor Scripts
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
    }

    /**
	 * Load Assets
	 *
	 * @return void
	 */
	public static function load_assets() {
		// Set Script Version
		self::$script_version = Asset_Helper::get_script_version();

		// Load Public Assets
		self::add_css_scripts( Public_Assets::get_css_scripts() );
		self::add_js_scripts( Public_Assets::get_js_scripts() );

		// Load Admin Assets
		self::add_css_scripts( Admin_Assets::get_css_scripts() );
		self::add_js_scripts( Admin_Assets::get_js_scripts() );
		
		// Load Block Editor Assets
		self::add_css_scripts( Block_Editor_Assets::get_css_scripts() );
		self::add_js_scripts( Block_Editor_Assets::get_js_scripts() );
	}
}