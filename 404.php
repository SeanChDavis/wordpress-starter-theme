<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();

get_template_part( 'template-parts/section', 'page-header', array(
	'title' => __( '404, unfortunately.', 'wst' ),
	'description' => __( 'It looks like nothing was found at this location. Try searching.', 'wst' ),
) );
?>

	<main id="content" class="site-main">
		<div class="container">
			<?php get_search_form(); ?>
		</div>
	</main>

<?php
get_footer();
