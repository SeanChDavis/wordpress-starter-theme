<?php
/**
 * The template for displaying search results
 */

get_header();

get_template_part( 'template-parts/section', 'page-header', array(
	'title' => get_search_query(),
	'description' => sprintf( __( 'Search Results for: %s', 'wst' ), '<span>' . get_search_query() . '</span>' ),
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
