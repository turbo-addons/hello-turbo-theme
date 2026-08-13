<?php
/**
 * The archive template file.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="turbo-main-content">
	<?php if ( have_posts() ) : ?>

		<header class="turbo-page-header">
			<?php
			the_archive_title( '<h1 class="turbo-page-title">', '</h1>' );
			the_archive_description( '<div class="turbo-archive-description">', '</div>' );
			?>
		</header>

		<div class="turbo-posts-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			?>
		</div>

		<nav class="turbo-pagination" aria-label="<?php esc_attr_e( 'Posts navigation', 'helloturbo' ); ?>">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => esc_html__( '&laquo; Previous', 'helloturbo' ),
					'next_text' => esc_html__( 'Next &raquo;', 'helloturbo' ),
				)
			);
			?>
		</nav>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>
</main>

<?php
if ( 'none' !== turbo_get_current_sidebar_layout() ) {
	get_sidebar();
}
get_footer();
