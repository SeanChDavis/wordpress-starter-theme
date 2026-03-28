<?php
/**
 * Template Name: Wide
 *
 * Displays the page with a page-width content column. Good for Gutenberg fun.
 */

get_header();

get_template_part( 'template-parts/section', 'page-header', wst_page_header_args() );
?>

	<main id="content" class="site-main">
		<div class="container">
			<div class="row">
				<div class="content-col col-12">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'page' );
					endwhile;
					?>
				</div>
			</div>
		</div>
	</main>

<?php
get_footer();
