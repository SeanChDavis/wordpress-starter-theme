<?php
/**
 * Functions pertaining to the block editor
 */

/**
 * Add editor styles
 *
 * @return void
 */
function wst_editor_styles() {

	add_editor_style( 'https://fonts.googleapis.com/css2?family=Cal+Sans&family=Red+Hat+Display:ital,wght@0,400;0,700;1,400&display=swap' );
	add_editor_style();

	// Inject CSS custom properties globally so they're available throughout the editor
	$custom_colors = '
        :root {
            --body: ' . esc_attr( get_theme_mod( 'body_color', '#002959' ) ) . ';
            --subdued-body: ' . esc_attr( get_theme_mod( 'subdued_body_color', '#315b82' ) ) . ';
            --lightest: ' . esc_attr( get_theme_mod( 'lightest_color', '#f7f9fc' ) ) . ';
            --darkest: ' . esc_attr( get_theme_mod( 'darkest_color', '#002754' ) ) . ';
            --action: ' . esc_attr( get_theme_mod( 'action_color', '#00bca9' ) ) . ';
            --subdued-action: ' . esc_attr( get_theme_mod( 'darkest_color', '#002754' ) ) . ';
        }';

	wp_add_inline_style( 'wp-edit-post', $custom_colors );
}
add_action( 'enqueue_block_editor_assets', 'wst_editor_styles' );


/**
 * Adjust editor styles
 *
 * @param $colors
 * @return mixed
 */
function wst_editor_color_palette() {

	$wst_colors = array(
		array(
			'name'  => __( 'White', 'wst' ),
			'slug'  => 'white',
			'color' => '#fff',
		),
		array(
			'name'  => __( 'Body Text', 'wst' ),
			'slug'  => 'body',
			'color' => get_theme_mod( 'body_color', '#002959' ),
		),
		array(
			'name'  => __( 'Body Text - Subdued', 'wst' ),
			'slug'  => 'subdued-body',
			'color' => get_theme_mod( 'subdued_body_color', '#315b82' ),
		),
		array(
			'name'  => __( 'The Lightest Color', 'wst' ),
			'slug'  => 'the-lightest',
			'color' => get_theme_mod( 'lightest_color', '#f7f9fc' ),
		),
		array(
			'name'  => __( 'The Darkest Color', 'wst' ),
			'slug'  => 'the-darkest',
			'color' => get_theme_mod( 'darkest_color', '#002754' ),
		),
		array(
			'name'  => __( 'Action', 'wst' ),
			'slug'  => 'action',
			'color' => get_theme_mod( 'action_color', '#00bca9' ),
		),
		array(
			'name'  => __( 'Translucent Background - Light', 'wst' ),
			'slug'  => 'translucent-light',
			'color' => 'rgba(255,255,255,0.1)',
		),
		array(
			'name'  => __( 'Translucent Background - Dark', 'wst' ),
			'slug'  => 'translucent-dark',
			'color' => 'rgba(0,0,0,0.1)',
		),
	);

	add_theme_support( 'editor-color-palette', $wst_colors );
}
add_action( 'after_setup_theme', 'wst_editor_color_palette' );