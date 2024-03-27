<?php

namespace Alamin\SimplePostViewCount\Views;
/**
 * Class ViewCounter
 *
 * This class is responsible for displaying the view count of a post using a shortcode.
 */
class ViewCounter {
	/**
	 * ViewCounter constructor.
	 *
	 * Initializes the ViewCounter class and registers the shortcode.
	 */
	public function __construct() {
		add_shortcode( 'post-views', array( $this, 'display_view_count' ) );
	}

	/**
	 * Display the view count of a post.
	 *
	 * @param array $atts The shortcode attributes.
	 * @return string The HTML markup for displaying the view count.
	 */
	public function display_view_count( $atts ) {
		$atts = shortcode_atts(
			array(
				'id' => 0,
			),
			$atts
		);

		$post_id = $atts['id'];
		$count   = get_post_meta( $post_id, 'view_count', true );
		$views   = $count ? $count : 0;

		ob_start();
		?>
		<div class="views-section">
			<div class="views-card">
				<h1 >Post Views</h1>
				<p >Total Views</p>
				<h3 id="counter"><?php echo esc_html( $views ); ?><h3>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}