<?php
/**
 * The main template file.
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

		<?php if ( is_home() && ! is_front_page() && get_theme_mod( 'helloturbo_page_title_enable', true ) ) : ?>
			<header class="helloturbo-page-header">
				<h1 class="helloturbo-page-title"><?php echo esc_html( single_post_title( '', false ) ); ?></h1>
			</header>
		<?php endif; ?>

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
