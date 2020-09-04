<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ISN_ACADEMY
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- ----Extra Style---- -->
	<link href="<?php home_url();?>/wp-content/themes/isn_academy/extra-style.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
	<!-- Font Awesome -->
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'isn_academy' ); ?></a>

	<header id="masthead" class="site-header d-flex align-items-center justify-content-between">
		<div class="site-branding">
			<?php
				the_custom_logo(); 
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation d-flex justify-content-end">
			<button class="menu-toggle nav-button" aria-controls="primary-menu" aria-expanded="false">
				<span id="nav-icon3">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
