<?php
namespace Alamin\SimplePostViewCount\Admin;

/**
 * Class Column
 *
 * This class is responsible for adding a custom column 'Views' to the WordPress posts list table in the admin area.
 * It also handles displaying the view count for each post, making the column sortable, and ordering the posts by view count.
 */
class Column {

	/**
	 * Constructor method.
	 *
	 * Initializes the class by adding necessary hooks and filters.
	 */
	public function __construct() {
		add_filter( 'manage_posts_columns', array( $this, 'add_views_column' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'display_views_column' ), 10, 2 );
		add_filter( 'manage_edit-post_sortable_columns', array( $this, 'sortable_views_column' ) );
		add_action( 'pre_get_posts', array( $this, 'view_count_orderby' ) );
	}

	/**
	 * Adds the 'Views' column to the posts list table.
	 *
	 * @param array $columns The existing columns in the posts list table.
	 * @return array The modified columns array with the 'Views' column added.
	 */
	public function add_views_column( $columns ) {
		$columns['view_count'] = 'Views';
		return $columns;
	}

	/**
	 * Displays the view count for each post in the 'Views' column.
	 *
	 * @param string $column The current column being displayed.
	 * @param int    $post_id The ID of the current post.
	 */
	public function display_views_column( $column, $post_id ) {
		if ( 'view_count' === $column ) {
			$count = get_post_meta( $post_id, 'view_count', true );
			if ( '' === $count ) {
				$count = 0;
				update_post_meta( $post_id, 'view_count', $count );
			}
			echo esc_html( $count );
		}
	}

	/**
	 * Makes the 'Views' column sortable in the posts list table.
	 *
	 * @param array $columns The existing sortable columns in the posts list table.
	 * @return array The modified sortable columns array with the 'Views' column added.
	 */
	public function sortable_views_column( $columns ) {
		$columns['view_count'] = 'view_count';
		return $columns;
	}

	/**
	 * Orders the posts by view count when the 'Views' column is selected for sorting.
	 *
	 * @param \WP_Query $query The WordPress query object.
	 */
	public function view_count_orderby( $query ) {
		if ( ! is_admin() ) {
			return;
		}

		$orderby = $query->get( 'orderby' );

		if ( 'view_count' === $orderby ) {
			$query->set( 'meta_key', 'view_count' );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}
}
