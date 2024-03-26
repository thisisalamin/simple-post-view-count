<?php
namespace Alamin\SimplePostViewCount\Shortcode;

/**
 * Class ViewCount
 *
 * This class handles the display of a shortcode column in the WordPress admin panel for post view counts.
 */
class ViewCount {
	/**
	 * ViewCount constructor.
	 *
	 * Initializes the class by adding filters and actions.
	 */
	public function __construct() {
		add_filter( 'manage_posts_columns', array( $this, 'add_shortcode_column' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'display_shortcode_column' ), 10, 2 );
	}

	/**
	 * Adds a shortcode column to the list of columns in the WordPress admin panel.
	 *
	 * @param array $columns The existing columns in the admin panel.
	 * @return array The modified columns with the added shortcode column.
	 */
	public function add_shortcode_column( $columns ) {
		$columns['shortcode'] = 'Shortcode';
		return $columns;
	}

	/**
	 * Displays the shortcode in the shortcode column for each post in the WordPress admin panel.
	 *
	 * @param string $column The current column being displayed.
	 * @param int    $post_id The ID of the current post being displayed.
	 */
	public function display_shortcode_column( $column, $post_id ) {
		if ( 'shortcode' === $column ) {
			echo '[post-views id="' . esc_attr( $post_id ) . '"]';
		}
	}
}
