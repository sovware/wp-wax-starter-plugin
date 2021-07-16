<?php

namespace WP_Wax_Plugin\Extension\Abstracts;

abstract class Enqueuer {
    public static $js_scripts     = [];
    public static $css_scripts    = [];
    public static $script_version = false;
    public static $load_min       = true;
    public static $css_base_path  = '';
    public static $js_base_path   = '';

    /**
	 * Load Assets
	 *
	 * @return void
	 */
    abstract public static function load_assets();

    /**
	 * Enqueue Public Scripts
	 *
	 * @return void
	 */
	public static function enqueue_public_scripts( $page = '', $fource_enqueue = false ) {
		// CSS
		self::register_css_scripts();
		self::enqueue_css_scripts_by_group( [ 'group' => 'public', 'page' => $page, 'fource_enqueue' => $fource_enqueue ] );

		// JS
		self::register_js_scripts();
		self::enqueue_js_scripts_by_group( [ 'group' => 'public', 'page' => $page, 'fource_enqueue' => $fource_enqueue ] );
	}


	/**
	 * Enqueue Admin Scripts
	 *
	 * @return void
	 */
	public static function enqueue_admin_scripts( $page = '' ) {
		// CSS
		self::register_css_scripts();
		self::enqueue_css_scripts_by_group( [ 'group' => 'admin', 'page' => $page ] );

		// JS
		self::register_js_scripts();
		self::enqueue_js_scripts_by_group( [ 'group' => 'admin', 'page' => $page ] );
	}

	/**
	 * Enqueue Block Editor Scripts
	 *
	 * @return void
	 */
	public static function enqueue_block_editor_assets( $page = '' ) {
		// CSS
		self::register_css_scripts();
		self::enqueue_css_scripts_by_group( [ 'group' => 'block-editor', 'page' => $page ] );

		// JS
		self::register_js_scripts();
		self::enqueue_js_scripts_by_group( [ 'group' => 'block-editor', 'page' => $page ] );
	}

    /**
	 * Add CSS Scripts
	 *
	 * @return void
	 */
    public static function add_css_scripts( array $scripts = [] ) {
        self::$css_scripts = array_merge( self::$css_scripts, $scripts );
    }

    /**
	 * Add JS Scripts
	 *
	 * @return void
	 */
    public static function add_js_scripts( array $scripts = [] ) {
        self::$js_scripts = array_merge( self::$js_scripts, $scripts );
    }

    /**
	 * Apply Hook to Scripts
	 *
	 * @return void
	 */
	public static function apply_hook_to_scripts() {
		self::$css_scripts = apply_filters( 'wp_wax_plugin_css_scripts', self::$css_scripts );
		self::$js_scripts  = apply_filters( 'wp_wax_plugin_js_scripts', self::$js_scripts );
	}

	/**
	 * Register CSS Scripts
	 *
	 * @return void
	 */
	public static function register_css_scripts( array $args = [] ) {
		$default = [ 'scripts' => self::$css_scripts ];
		$args    = array_merge( $default, $args );

		foreach( $args['scripts'] as $handle => $script_args ) {
			$default = [
				'file_name' => $handle,
				'base_path' => self::$css_base_path,
				'deps'      => [],
				'ver'       => self::$script_version,
				'media'     => 'all',
				'link'      => ''
			];

			$script_args = array_merge( $default, $script_args );
			$src = $script_args['base_path'] . self::get_script_file_name( $script_args ) . '.css';

			if ( ! empty( $script_args['link'] ) ) {
				$src = $script_args['link'];
			}

			wp_register_style( $handle, $src, $script_args['deps'], $script_args['ver'], $script_args['media']);
		}
	}

	/**
	 * Enqueue CSS Scripts
	 *
	 * @return void
	 */
	public static function enqueue_css_scripts_by_group( array $args = [] ) {
		$default = [ 'scripts' => self::$css_scripts, 'group' => 'public' ];
		$args    = array_merge( $default, $args );

		foreach( $args['scripts'] as $handle => $script_args ) {

			if ( ! self::can_enqueue_asset( $handle, $script_args, $args ) ) continue;

			wp_enqueue_style( $handle );
		}
	}


	/**
	 * Register JS Scripts by Group
	 *
	 * @param array $args
	 * @return void
	 */
	public static function register_js_scripts( array $args = [] ) {
		$default = [ 'scripts' => self::$js_scripts ];
		$args    = array_merge( $default, $args );

		foreach( $args['scripts'] as $handle => $script_args ) {
			$default = [
				'file_name' => $handle,
				'base_path' => self::$js_base_path,
				'link'      => '',
				'deps'      => [],
				'ver'       => self::$script_version,
				'has_rtl'   => false,
				'in_footer' => true,
			];

			$script_args = array_merge( $default, $script_args );
			$src = $script_args['base_path'] . self::get_script_file_name( $script_args ) . '.js';

			if ( ! empty( $script_args['link'] ) ) {
				$src = $script_args['link'];
			}

			wp_register_script( $handle, $src, $script_args['deps'], $script_args['ver'], $script_args['in_footer']);
		}
	}

	/**
	 * Enqueue JS Scripts
	 *
	 * @return void
	 */
	public static function enqueue_js_scripts_by_group( array $args = [] ) {
		$default = [ 'scripts' => self::$js_scripts, 'group' => 'public' ];
		$args    = array_merge( $default, $args );

		foreach( $args['scripts'] as $handle => $script_args ) {

			if ( ! self::can_enqueue_asset( $handle, $script_args, $args ) ) continue;

			if ( ! empty( $script_args['before_enqueue'] ) ) {
				self::handle_script_before_enqueue_task( $script_args['before_enqueue'] );
			}

			wp_enqueue_script( $handle );
			self::add_localize_data_to_script( $handle, $script_args );
		}
	}

	// can_enqueue_asset
	public static function can_enqueue_asset( $script_id = '', $script_args = [], $group_args = [] ) {

		$in_group = true;
		if ( isset( $script_args['group'] ) ) {
			if ( is_string( $script_args['group'] ) && ( $group_args['group'] !== $script_args['group'] ) ) {
				$in_group = false;
			}

			if ( is_array( $script_args['group'] ) && ! in_array( $group_args['group'], $script_args['group'] ) ) {
				$in_group = false;
			}

			if (  is_string( $script_args['group'] ) && 'global' === $script_args['group']  ) {
				$in_group = true;
			}

			if (  is_array( $script_args['group'] ) && in_array( 'global', $script_args['group'] )  ) {
				$in_group = true;
			}
		}

		if ( ! $in_group ) return false;

		if ( ( ! empty( $script_args['fource_enqueue'] ) || ! empty( $group_args['fource_enqueue'] ) ) ) {
			return true;
		}

		if ( ( isset( $script_args['enable'] ) && false === $script_args['enable'] ) ) {
			return false;
		}

		if ( ! empty( $script_args['section'] ) ) return false;

		if ( ( isset( $group_args['page'] ) && isset( $script_args[ 'page' ] ) ) ) {
			if ( is_string( $script_args[ 'page' ] ) && $group_args['page'] !== $script_args[ 'page' ] ) return false;
			if ( is_array( $script_args[ 'page' ] ) && ! in_array( $group_args['page'], $script_args[ 'page' ] ) ) return false;
		}

		return true;
	}

	// handle_script_before_enqueue_task
	public static function handle_script_before_enqueue_task( $task = [] ) {
		if ( is_array( $task ) && ! self::is_assoc_array( $task ) && ( count( $task ) > 1 )) {
			$class_name  = $task[0];
			$method_name = $task[1];
			$args        = ( isset( $task[2] ) ) ? $task[2] : '';

			if ( class_exists( $class_name ) && method_exists( $class_name, $method_name ) ) {
				$class = new $class_name;
				$class->$method_name( $args );
			}
		}
	}

	
	/**
	 *  Add localize data to script
	 *
	 * @param string $handle
	 * @param array $script_args
	 * @return void
	 */
	public static function add_localize_data_to_script( $handle, $script_args ) {

		if ( ! is_array( $script_args ) ) { return; }
		if ( empty( $script_args['localize_data'] ) ) { return false; }

		if ( self::is_assoc_array( $script_args['localize_data'] ) ) {
			if ( ! self::has_valid_localize_data( $script_args['localize_data'] ) ) {
				return;
			}

			wp_localize_script( $handle, $script_args['localize_data']['object_name'], $script_args['localize_data']['data'] );
			return;
		}

		foreach ( $script_args['localize_data'] as $script_args_item ) {

			if ( ! self::has_valid_localize_data( $script_args_item ) ) {
				return;
			}

			wp_localize_script( $handle, $script_args_item['object_name'], $script_args_item['data'] );
		}
	}

	// has_valid_localize_data
	public static function has_valid_localize_data( array $localize_data = [] ) {

		if ( empty( $localize_data['object_name'] ) ) { return false; }
		if ( ! is_string( $localize_data['object_name'] ) ) { return false; }
		if ( empty( $localize_data['data'] ) ) { return false; }
		if ( ! is_array(  $localize_data['data'] ) ) { return false; }

		return true;
	}

	// is_assoc_array
	public static function is_assoc_array( array $arr = [] ) {
		if ( array() === $arr ) { return false; }

		return array_keys( $arr) !== range( 0, count($arr) - 1 );
	}


	/**
	 * Get Script File Name
	 *
	 * @param array $args
	 * @return $file_name
	 */
	public static function get_script_file_name( array $args = [] ) {
		$default = [ 'has_min' => true, 'has_rtl' => true ];
		$args    = array_merge( $default, $args );

		$file_name  = ( ! empty( $args['file_name'] ) ) ? $args['file_name'] : '';
		$has_min    = ( ! empty( $args['has_min'] ) ) ? true : false;
		$has_rtl    = ( ! empty( $args['has_rtl'] ) ) ? true : false;


		$load_min = self::$load_min;
		$is_rtl   =  is_rtl();

		if ( $has_min && $load_min ) {
			$file_name = "{$file_name}.min";
		}

		if ( $has_rtl && $is_rtl ) {
			$file_name = "{$file_name}.rtl";
		}

		return $file_name;
	}
}