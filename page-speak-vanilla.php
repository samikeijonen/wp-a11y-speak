<?php
/**
 * Template Name: A11y speak vanilla
 *
 * Vanilla JS solution for using a11y speak.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_a11y_speak
 */

get_header(); ?>

	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'a11y-speak' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
