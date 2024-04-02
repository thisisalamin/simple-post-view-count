<?php
/**
 * Plugin Name: Simple Post View Count
 * Plugin URI: https://github.com/thisisalamin/simple-post-view-count
 * Description: A simple plugin to count the views of a post and display it in the admin column, post content, and post metabox.
 * Version: 1.0.1
 * Author: Mohamad Alamin
 * Author URI: https://www.linkedin.com/in/thisismdalamin/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-post-view-count
 *
 * @package simple-post-view-count
 */

// Include the Composer autoloader.
require __DIR__ . '/vendor/autoload.php';

// Exit if this file is accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define the plugin path and URL.
define( 'SPVC_PATH', plugin_dir_path( __FILE__ ) );
define( 'SPVC_URL', plugin_dir_url( __FILE__ ) );

// Check if the main plugin class doesn't exist before defining it.
if ( ! class_exists( 'Simple_Post_View_Count' ) ) {
	/**
	 * Class Simple_Post_View_Count
	 *
	 * Description of the class.
	 */
	class Simple_Post_View_Count {

		/**
		 * Class constructor.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'init' ) );
		}

		/**
		 * Initialize the plugin.
		 */
		public function init() {
			// Instantiate the classes for post view count, admin column, shortcode, and metabox.
			new Alamin\SimplePostViewCount\PostViewCount();
			new Alamin\SimplePostViewCount\Admin\Column();
			new Alamin\SimplePostViewCount\Shortcode\ViewCount();
			new Alamin\SimplePostViewCount\Metabox\Metabox();
			new Alamin\SimplePostViewCount\Views\ViewCounter();
			new Alamin\SimplePostViewCount\Views\Assets();
		}
	}
}

// Instantiate the main plugin class.
new Simple_Post_View_Count();
