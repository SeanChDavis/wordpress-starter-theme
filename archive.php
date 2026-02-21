<?php
/**
 * The template for displaying archive pages
 */

get_header();

get_template_part( 'template-parts/section', 'page-header', array(
	'title' => get_the_archive_title(),
	'description' => get_the_archive_description(),
) );
?>

	<main id="content" class="site-main">
		<div class="container">
			<?php
			if ( have_posts() ) :
				?>
				<div class="grid-items-row row gy-5 gx-sm-5">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<div class="col-12 col-lg-6">
							<?php get_template_part( 'template-parts/content', 'grid-item' ); ?>
						</div>
					<?php
					endwhile;
					the_posts_navigation();
					?>
				</div>
			<?php
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</main>

<?php
get_footer();
