<?php
/**
 * The template for displaying the fat footer
 */

// Set the fat footer area IDs
$fat_footer_areas = array(
	'ff_a1' => array( 'name' => 'fat-footer-area-one' ),
	'ff_a2' => array( 'name' => 'fat-footer-area-two' ),
	'ff_a3' => array( 'name' => 'fat-footer-area-three' ),
	'ff_a4' => array( 'name' => 'fat-footer-area-four' ),
);

// Check each fat footer area to see if it has any widgets
$is_area_one_active = is_active_sidebar( $fat_footer_areas['ff_a1']['name'] );
$is_area_two_active = is_active_sidebar( $fat_footer_areas['ff_a2']['name'] );
$is_area_three_active = is_active_sidebar( $fat_footer_areas['ff_a3']['name'] );
$is_area_four_active = is_active_sidebar( $fat_footer_areas['ff_a4']['name'] );

// Set a flag to determine if any fat footer areas are active
$has_active_areas = $is_area_one_active || $is_area_two_active || $is_area_three_active || $is_area_four_active;

// If any fat footer areas are active, display the fat footer
if ( $has_active_areas ) {
	?>
	<section class="fat-footer-section background-lightest">
		<div class="container small">
			<div class="fat-footer-row row justify-content-between g-4">
				<?php
				// If area one is active, display it
				if ( $is_area_one_active ) {
					?>
					<div class="fat-col col-12 col-lg-5 mb-4 mb-md-5 mb-lg-0">
						<?php dynamic_sidebar( $fat_footer_areas['ff_a1']['name'] ); ?>
					</div>
					<?php
				}

				// If area two, three, or four are active, display the container and the active areas
				if ( $is_area_two_active || $is_area_three_active || $is_area_four_active ) { ?>
					<div class="columns-col col-12 col-lg-6">
						<div class="columns-col-row row g-4">
							<?php if ( $is_area_two_active ) { ?>
								<div class="single-col col-12 col-md-4">
									<?php dynamic_sidebar( $fat_footer_areas['ff_a2']['name'] ); ?>
								</div>
							<?php } ?>
							<?php if ( $is_area_three_active ) { ?>
								<div class="single-col col-12 col-md-4">
									<?php dynamic_sidebar( $fat_footer_areas['ff_a3']['name'] ); ?>
								</div>
							<?php } ?>
							<?php if ( $is_area_four_active ) { ?>
								<div class="single-col col-12 col-md-4">
									<?php dynamic_sidebar( $fat_footer_areas['ff_a4']['name'] ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</section>
	<?php
}