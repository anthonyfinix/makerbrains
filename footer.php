<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package estore
 */

?>

<footer id="colophon" class="site-footer">
	<div class="flex row container py-3">
		<div class="col-4">
			<div class="logo-wrapper mr-4"><?php the_custom_logo(); ?></div>
		</div>
		<div class="col-4">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer_1',
					'menu_class'        => 'footer-1-navigation',
				)
			);
			?>
		</div>
		<div class="col-4">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer_2',
					'menu_class'        => 'footer-2-navigation',
				)
			);
			?>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>