<?php
namespace Alamin\SimplePostViewCount;

/**
 * Class PostViewCount
 *
 * This class is responsible for counting the number of views for each post.
 */
class PostViewCount {
	/**
	 * PostViewCount constructor.
	 *
	 * Initializes the class and hooks the count_post_views method to the wp_head action.
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'count_post_views' ) );
	}

	/**
	 * Count_post_views method.
	 *
	 * This method is called on the wp_head action and counts the number of views for the current post.
	 * If the post is a single post, it retrieves the post ID, gets the current view count from the post meta,
	 * and updates the view count accordingly.
	 */
	public function count_post_views() {
		if ( is_single() ) {
			$post_id = get_the_ID();
			$count   = get_post_meta( $post_id, 'view_count', true );
			if ( '' === $count ) {
				$count = 0;
				delete_post_meta( $post_id, 'view_count' );
				add_post_meta( $post_id, 'view_count', '0' );
			} else {
				++$count;
				update_post_meta( $post_id, 'view_count', $count );
			}
		}
	}
}
