<?php

namespace Alamin\SimplePostViewCount\Views;
/**
 * Class Assets
 *
 * Handles the loading of CSS and JavaScript assets for the plugin.
 */
class Assets {
	/**
	 * Assets constructor.
	 *
	 * Registers the 'load_scripts' method to be called when 'wp_enqueue_scripts' action is triggered.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	/**
	 * Load CSS and JavaScript assets.
	 */
	public function load_scripts() {
		$assets_dir = SPVC_URL;
		if ( ! is_admin() ) {
			wp_enqueue_style(
				'spvc-style',
				$assets_dir . 'assets/css/style.css',
				array(),
				'1.0',
				'all'
			);

			wp_enqueue_script(
				'spvc-script',
				$assets_dir . 'assets/js/main.js',
				array( 'jquery' ),
				'1.0',
				true
			);
		}
	}
}
