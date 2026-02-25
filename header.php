<?php
/**
 * The theme header
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wst' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container tiny">
			<div class="site-header-row row justify-content-between">
				<div class="branding-col col-6 col-md-4 col-lg-3 col-xxl-4">
					<div class="site-branding">
						<?php
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						}
						?>
					</div>
				</div>
				<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
					<div class="nav-col col-6 col-md-8 col-lg-9 col-xxl-8 text-end">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Menu', 'wst' ); ?></button>
							<?php
							wp_nav_menu(
									array(
											'theme_location' => 'primary-menu',
											'menu_id'        => 'primary-menu',
									)
							);
							?>
							<button class="close-menu"><?php _e( 'Close Menu', 'wst' ); ?></button>
						</nav>
					</div>
				<?php } ?>
			</div>
		</div>
	</header>
