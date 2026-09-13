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

<main id="primary" class="helloturbo-main-content" tabindex="-1">
	<?php if ( have_posts() ) : ?>

		<header class="helloturbo-page-header">
			<?php
			the_archive_title( '<h1 class="helloturbo-page-title">', '</h1>' );
			the_archive_description( '<div class="helloturbo-archive-description">', '</div>' );
			?>
		</header>

		<div class="helloturbo-posts-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			?>
		</div>

		<nav class="helloturbo-pagination" aria-label="<?php esc_attr_e( 'Posts navigation', 'helloturbo' ); ?>">
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
if ( 'none' !== helloturbo_get_current_sidebar_layout() ) {
	get_sidebar();
}
get_footer();
