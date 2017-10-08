<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_a11y_speak
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
		?>
		<h2><?php esc_html_e( 'Filter cities from array', 'wp-a11y-speak' ); ?></h2>
		<form class="filter-cities" id="filter-cities">
			<p>
				<label for="select-city"><?php esc_html_e( 'Select city', 'wp-a11y-speak' ); ?></label>
				<select id="select-city">
					<option value="Kuorinka" selected>Kuorinka</option>
					<option value="Helsinki">Helsinki</option>
					<option value="Kuopio">Kuopio</option>
					<option value="Joensuu">Joensuu</option>
					<option value="Tampere">Tampere</option>
				</select>
			</p>
		</form>

		<ul class="show-results" id="show-results"></ul>

		<h2><?php esc_html_e( 'Filter posts via REST API', 'wp-a11y-speak' ); ?></h2>
		<form class="filter-cities" id="filter-cities">
			<p>
				<label for="select-category"><?php esc_html_e( 'Select category', 'wp-a11y-speak' ); ?></label>
				<select id="select-category">
					<?php
					$terms = get_terms( array(
						'taxonomy'   => 'category',
						'hide_empty' => true,
						'orderby'    => 'name',
					) );

					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
						foreach ( $terms as $term ) :
							echo '<option value="' . $term->term_id . '"' . selected( $term->slug, 'accessibility', false ) . '>' . esc_html( $term->name ) . '</option>';
						endforeach;
					endif;
					?>
				</select>
			</p>
		</form>

		<ul class="show-posts" id="show-posts"></ul>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
