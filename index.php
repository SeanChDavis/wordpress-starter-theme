<?php
/**
 * The main template file. The final fallback if no other template is found.
 */

get_header();

get_template_part( 'template-parts/section', 'page-header', array(
	'title' => get_the_title(),
) );
?>

	<main id="content" class="site-main">
		<div class="container">
			<div class="row">
				<div class="content-col col-12 col-lg-8 pe-lg-4 pe-xxl-5">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
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
