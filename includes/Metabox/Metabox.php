<?php
namespace Alamin\SimplePostViewCount\Metabox;

/**
 * Class Metabox
 *
 * This class handles the creation and functionality of a custom metabox for post view count.
 */
class Metabox {
	/**
	 * Metabox constructor.
	 *
	 * Initializes the class by adding necessary action hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ) );
	}

	/**
	 * Adds the metabox to the post editor screen.
	 */
	public function add_metabox() {
		add_meta_box(
			'post_view_count',
			__( 'Post View Count', 'simple-post-view-count' ),
			array( $this, 'render_metabox' ),
			'post',
			'side',
			'high'
		);
	}

	/**
	 * Renders the content of the metabox.
	 *
/**
	 * Renders the content of the metabox.
	 *
	 * @param \WP_Post $post The current post object.
	 */
	public function render_metabox( $post ) {
		$view_count = get_post_meta( $post->ID, 'view_count', true );
		wp_nonce_field( basename( __FILE__ ), 'view_count_nonce' );
		?>
	<p>
		<label for="view_count"><?php esc_html_e( 'View Count:', 'simple-post-view-count' ); ?></label>
		<input type="text" id="view_count" name="view_count" value="<?php echo esc_attr( $view_count ); ?>">
	</p>
		<?php
	}

	/**
	 * Saves the metabox data when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_metabox( $post_id ) {

		if ( ! isset( $_POST['view_count_nonce'] ) || ! wp_verify_nonce( wp_unslash( sanitize_text_field( wp_unslash( $_POST['view_count_nonce'] ) ) ), basename( __FILE__ ) ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['view_count'] ) ) {
			$view_count = isset( $_POST['view_count'] ) ? sanitize_text_field( wp_unslash( $_POST['view_count'] ) ) : '';
			update_post_meta( $post_id, 'view_count', sanitize_text_field( $view_count ) );
		}
	}
}
