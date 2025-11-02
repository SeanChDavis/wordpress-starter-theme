<?php
/**
 * The template for displaying all default pages
 */

get_header();

$title = get_the_title();
$description = has_excerpt() ? get_the_excerpt() : '';

if ( class_exists( 'acf' ) ) {

	if ( get_field( 'page_header_title' ) ) {
		$title = get_field( 'page_header_title' );
	}

	if ( get_field( 'page_header_description' ) ) {
		$description = get_field( 'page_header_description' );
	}
}

get_template_part( 'template-parts/section', 'page-header', array(
	'title' => $title,
	'description' => $description,
) );
?>

	<main id="content" class="site-main">
        <div class="inner">
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
        </div>
	</main>

<?php
get_footer();
