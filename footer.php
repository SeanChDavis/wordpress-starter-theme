<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 */

get_template_part( 'template-parts/section', 'fat-footer' );
?>

	<footer id="colophon" class="site-footer background-lightest">
		<div class="container tiny">
			<div class="site-info-row row justify-content-between text-center text-lg-start">
				<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
					<div class="footer-menu-col col-12 col-lg-6 text-lg-end order-lg-2 mb-3 mb-lg-0">
						<?php
						wp_nav_menu(
								array(
										'theme_location' => 'footer-menu',
										'menu_id'        => 'footer-menu',
										'depth'          => 1,
								)
						);
						?>
					</div>
				<?php } ?>
				<div class="site-info-col col-12 col-lg-6 order-lg-1">
					<div class="site-info">
						<?php $home_link = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'; ?>
						<span class="site-copyright"><?php echo $home_link . ' &copy; ' . date( 'Y' ); ?></span>
						<?php if ( ! empty( get_bloginfo( 'description' ) ) ) { ?>
							<span class="site-description"> - <?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
