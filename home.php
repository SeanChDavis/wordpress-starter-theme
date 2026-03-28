<?php
/**
 * The template for displaying the blog (home) page
 */

get_header();

$page_for_posts = get_option( 'page_for_posts' );

// If a blog page is set, use its title/description (with ACF overrides).
// Otherwise fall back to the site name and tagline.
$header_args = ! empty( $page_for_posts )
	? wst_page_header_args( $page_for_posts )
	: array(
		'title'       => sprintf( __( 'Welcome to %s', 'wst' ), get_bloginfo( 'name' ) ),
		'description' => get_bloginfo( 'description' ),
	);

get_template_part( 'template-parts/section', 'page-header', $header_args );
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
