<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package estore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	wp_body_open();
	$cart_count = WC()->cart->get_cart_contents_count();
	?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'estore'); ?></a>
		<header id="masthead" class="header-wrapper">
			<div class="top-header">
				<div class="container flex">
					<div class="mobile-wrapper">
						<span class="material-symbols-rounded sm">call</span>
						<p><?php echo get_theme_mod('mobile_number_settings') ?></p>
					</div>
					<div class="email-wrapper">
						<span class="material-symbols-rounded sm">mail</span>
						<p><?php echo get_theme_mod('email_address_settings') ?></p>
					</div>

				</div>
			</div>
			<div class="site-branding">
				<div class="container flex align-items-center">
					<div class="logo-wrapper mr-4"><?php the_custom_logo(); ?></div>
					<div class="search-bar-wrapper flex align-items-center grow">
						<button class="category-button pl-4 py-3">All Products</button>
						<input class="search-bar grow" placeholder="Search Products" type="text">
					</div>
					<div class="icons-wrapper ml-auto flex">
						<a class="cart-wrapper position-relative" href="<?php echo wc_get_cart_url() ?>">
							<span class="material-symbols-rounded shopping-cart md">shopping_cart</span>
							<?php if ($cart_count > 0) {
								echo "<span class=\"cart-count\">" . $cart_count . "</span>";
							} ?>
						</a>
						<span class="material-symbols-rounded user-account md ml-3">account_circle</span>
					</div>
				</div>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<div class="container m-auto flex align-items-center">
					<button class="category-button py-2"><span class="material-symbols-rounded">
							apps
						</span>Categories</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main-navigation',
							'menu_class'        => 'main-navigation-menu',
						)
					);
					?>
				</div>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->