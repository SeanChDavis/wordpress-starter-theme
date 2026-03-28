<?php
/**
 * The template for displaying all default pages
 */

get_header();

get_template_part( 'template-parts/section', 'page-header', wst_page_header_args() );
?>

	<main id="content" class="site-main">
		<div class="container">
			<div class="row">
				<div class="content-col col-12 col-lg-8 pe-lg-4 pe-xxl-5">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile;
					?>
				</div>
				<div class="sidebar-col col-12 col-lg-4 pt-5 pt-lg-0 ps-lg-4 ps-xxl-5">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main>

<?php
get_footer();
