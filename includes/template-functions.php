<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wst_body_classes( $classes ) {
	global $post;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of page-{slug} for every page.
	if ( isset( $post ) ) {
		$classes[] = 'page-' . sanitize_html_class( $post->post_name );

		if ( is_front_page() ) {
			$classes[] = 'page-front';
		}
	}

	// Adds a class of has-post-thumbnail if the page has a featured image.
	if ( ( is_single() || is_page_template( 'template-narrow.php' ) ) && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	// Adds a class of page-header-centered if the page should have a centered page header.
	if ( is_single() || is_page_template( 'template-narrow.php' ) ) {
		$classes[] = 'page-header-centered';
	}

	return $classes;
}
add_filter( 'body_class', 'wst_body_classes' );

/**
 * Only show posts in search results and increase the posts per page.
 *
 * @param $query
 *
 * @return mixed
 */
function wst_posts_only_search( $query ) {

	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$query->set( 'post_type', 'post' );
		$query->set( 'posts_per_page', 20 );
	}
	return $query;
}
add_action( 'pre_get_posts', 'wst_posts_only_search' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wst_pingback_header() {

	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wst_pingback_header' );

/**
 * Add excerpts to pages.
 *
 * @return void
 */
function wst_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wst_add_excerpts_to_pages' );

/**
 * Returns page header args (title and description) for use with the
 * section-page-header template part. Applies ACF field overrides when available.
 *
 * @param int|null $post_id Optional post ID. Defaults to current post in the loop.
 * @return array { title: string, description: string }
 */
function wst_page_header_args( $post_id = null ) {
	$title       = get_the_title( $post_id );
	$description = has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : '';

	if ( class_exists( 'acf' ) ) {
		$acf_title = get_field( 'page_header_title', $post_id );
		if ( $acf_title ) {
			$title = $acf_title;
		}

		$acf_description = get_field( 'page_header_description', $post_id );
		if ( $acf_description ) {
			$description = $acf_description;
		}
	}

	return array(
		'title'       => $title,
		'description' => $description,
	);
}
