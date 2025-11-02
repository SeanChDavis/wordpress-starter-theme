<?php

/**
 * Register block pattern category.
 *
 * @return void
 */
function wst_register_block_pattern_category() {

	register_block_pattern_category(
		'wst-page-sections-elements',
		array(
			'label' => __( 'WST Page Sections & Elements', 'wst' )
		)
	);
}
add_action( 'init', 'wst_register_block_pattern_category' );
