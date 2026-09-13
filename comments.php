<?php
/**
 * The template for displaying comments.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="helloturbo-comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="helloturbo-comments-title">
			<?php
			$helloturbo_comment_count = get_comments_number();
			if ( '1' === $helloturbo_comment_count ) {
				printf(
					/* translators: %s: post title */
					esc_html__( 'One thought on &ldquo;%s&rdquo;', 'helloturbo' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count, 2: post title */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $helloturbo_comment_count, 'comments title', 'helloturbo' ) ),
					esc_html( number_format_i18n( $helloturbo_comment_count ) ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="helloturbo-comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();
	endif;

	comment_form();
	?>
</div>
