<?php

/**
 * estore Theme Customizer
 *
 * @package estore
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function estore_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
	$wp_customize->add_setting('mobile_number_settings', array('default' => ''));
	$wp_customize->add_setting('email_address_settings', array('default' => ''));
	$wp_customize->add_setting('facebook_username_settings', array('default' => ''));
	$wp_customize->add_setting('twitter_username_settings', array('default' => ''));
	$wp_customize->add_control('mobile_number_control', array(
		'label' => 'Mobile Number',
		'section' => 'title_tagline',
		'settings' => 'mobile_number_settings',
		'type' => 'text'
	));
	$wp_customize->add_control('email_address_control', array(
		'label' => 'Email Address',
		'section' => 'title_tagline',
		'settings' => 'email_address_settings',
		'type' => 'text'
	));
	$wp_customize->add_control('facebook_username_control', array(
		'label' => 'Facebook username',
		'section' => 'title_tagline',
		'settings' => 'facebook_username_settings',
		'type' => 'text'
	));
	$wp_customize->add_control('twitter_username_control', array(
		'label' => 'Twitter username',
		'section' => 'title_tagline',
		'settings' => 'twitter_username_settings',
		'type' => 'text'
	));
?>
<?php
	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'estore_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'estore_customize_partial_blogdescription',
			)
		);
	}
}
add_action('customize_register', 'estore_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function estore_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function estore_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function estore_customize_preview_js()
{
	wp_enqueue_script('estore-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'estore_customize_preview_js');
