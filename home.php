<?php
/**
 * The template for displaying the blog (home) page
 */

get_header();

$page_for_posts = get_option( 'page_for_posts' );

// Default page header when the blog page is not set and the blog page is the front page
$title = sprintf( __( 'Welcome to %s', 'wst' ), get_bloginfo( 'name' ) );
$description = get_bloginfo( 'description' );

// If the blog page is set, use the title and description of the page
if ( ! empty( $page_for_posts ) ) {
    $title = get_the_title( $page_for_posts );
    $description = get_the_excerpt( $page_for_posts );
}

// If ACF is installed, use the title and description from the page header
if ( class_exists( 'acf' ) ) {

	if ( get_field( 'page_header_title', get_option( 'page_for_posts' ) ) ) {
		$title = get_field( 'page_header_title', get_option( 'page_for_posts' ) );
	}

	if ( get_field( 'page_header_description', get_option( 'page_for_posts' ) ) ) {
		$description = get_field( 'page_header_description', get_option( 'page_for_posts' ) );
	}
}

get_template_part( 'template-parts/section', 'page-header', array(
	'title' => $title,
	'description' => $description,
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
