<?php
/**
 * Page section - header
 */

// The page title
$title = get_the_title();
if ( isset( $args['title'] ) && ! empty( $args['title'] ) ) {
	$title = $args['title'];
}

// The page description
$description = '';
if ( isset( $args['description'] ) && ! empty( $args['description'] ) ) {
	$description = $args['description'];
}
?>

<section class="page-header background-lightest">
    <div class="inner">
        <div class="container">

            <?php if ( ! empty( $title ) ) { ?>
                <h1 class="page-title"><?php echo $title; ?></h1>
            <?php } ?>

            <?php if ( ! empty( $description ) ) { ?>
                <div class="page-description">
                    <?php echo wpautop( $description ); ?>
                </div>
            <?php } ?>

            <?php if ( is_single() ) { ?>
                <div class="entry-meta">
                    <?php wst_posted_on(); ?>
                </div>
            <?php } ?>

            <?php if ( is_search() ) { ?>
                <div class="search-form mt-5">
                    <?php get_search_form(); ?>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
