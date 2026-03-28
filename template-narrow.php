<?php
/**
 * Template Name: Narrow
 *
 * Displays the page with a narrow, centered content column. Similar to a single blog post.
 */

get_header();

get_template_part( 'template-parts/section', 'page-header', wst_page_header_args() );
?>

	<main id="content" class="site-main">
		<div class="container">
			<div class="row justify-content-around">
				<div class="content-col col-12 col-lg-9 col-xl-8 col-xxl-7">
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
