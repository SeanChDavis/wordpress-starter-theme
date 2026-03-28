<?php

/**
 * Theme Customizer settings
 */
function wst_customize_register( $wp_customize ) {

	/**
	 * Add Customizer Sections
	 */

    /**
     * Color scheme
     */
	$wp_customize->add_section( 'wst_colors', array(
		'title'       => __( 'Theme Colors', 'wst' ),
		'description' => __( "These colors are available in the Block Editor. For custom CSS, use the CSS variables displayed above each color picker.", 'wst' ),
	) );

	$wp_customize->add_setting(
		'body_color',
		array(
			'default'           => '#002959',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_color',
			array(
				'label'   => __( 'Body Text Color', 'wst' ),
                'description' => __( 'This is the default color for body text. Also used for subdued links and other elements.', 'wst' ) . '<small><strong><br>CSS variable: var(--body)</strong></small>',
				'section' => 'wst_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'subdued_body_color',
		array(
			'default'           => '#315b82',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'subdued_body_color',
			array(
				'label'   => __( 'Body Text Color - Subdued', 'wst' ),
				'description' => __( 'Typically the same hue as Body Text, but slightly lighter. Primarily used for subtitles.', 'wst' ) . '<small><strong><br>CSS variable: var(--subdued-body)</strong></small>',
				'section' => 'wst_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'lightest_color',
		array(
			'default'           => '#f7f9fc',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'lightest_color',
			array(
				'label'   => __( 'Lightest Color', 'wst' ),
				'description' => __( "<strong>Extremely</strong> light, very close to white. Used for backgrounds that shouldn't be white, but are still very light.", 'wst' ) . '<small><strong><br>CSS variable: var(--lightest)</strong></small>',
				'section' => 'wst_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'darkest_color',
		array(
			'default'           => '#002754',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'darkest_color',
			array(
				'label'   => __( 'Darkest Color', 'wst' ),
				'description' => __( "<strong>Extremely</strong> dark, similar to (or same as) Body Text. Used for backgrounds and other contrasting elements.", 'wst' ) . '<small><strong><br>CSS variable: var(--darkest)</strong></small>',
				'section' => 'wst_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'action_color',
		array(
			'default'           => '#00bca9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'action_color',
			array(
				'label'   => __( 'Action Color', 'wst' ),
				'description' => __( 'Buttons, links, and other action-oriented elements. Used sparingly for calls to action.', 'wst' ) . '<small><strong><br>CSS variable: var(--action)</strong></small>',
				'section' => 'wst_colors',
			)
		)
	);
}
add_action( 'customize_register', 'wst_customize_register' );

/**
 * Add color scheme CSS variables to front-end <head>
 *
 * These styles available in the Block Editor for customization, but are not used as default Block Editor styles.
 */
function wst_customizer_head_styles() {
	?>
    <style>
		:root{
			--body: <?php echo get_theme_mod( 'body_color', '#002959' ); ?>;
			--subdued-body: <?php echo get_theme_mod( 'subdued_body_color', '#315b82' ); ?>;
            --lightest: <?php echo get_theme_mod( 'lightest_color', '#f7f9fc' ); ?>;
            --darkest: <?php echo get_theme_mod( 'darkest_color', '#002754' ); ?>;
            --action: <?php echo get_theme_mod( 'action_color', '#00bca9' ); ?>;
            --subdued-action: <?php echo get_theme_mod( 'darkest_color', '#002754' ); ?>;
		}
    </style>
	<?php
}
add_action( 'wp_head', 'wst_customizer_head_styles' );

/**
 * Bind JS handlers for Customizer controls
 */
function wst_customize_preview_init() {
	wp_enqueue_script( 'wst-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), filemtime( get_theme_file_path( 'assets/js/customizer.js' ) ), true );
}
add_action( 'customize_preview_init', 'wst_customize_preview_init' );