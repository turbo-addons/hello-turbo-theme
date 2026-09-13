<?php
/**
 * The search results template.
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
			<h1 class="helloturbo-page-title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search Results for: %s', 'helloturbo' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header>

		<div class="helloturbo-posts-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;
			?>
		</div>

		<nav class="helloturbo-pagination" aria-label="<?php esc_attr_e( 'Search results navigation', 'helloturbo' ); ?>">
			<?php the_posts_pagination(); ?>
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
