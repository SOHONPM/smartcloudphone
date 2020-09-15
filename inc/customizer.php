<?php

/** 
 * Theme customizer
 *
 * Learn more: https://codex.wordpress.org/Theme_Customization_API
 *
 * @since   1.0.0
 * @package themezero
 */


/**
 *  Register Theme Option
 */
function themezero_customize_register($wp_customize)
{


	$wp_customize->add_section('themezero_theme_option', array(
		'title'    => __('Theme options', 'themezero'),
		'priority' => 120,
	));

	$wp_customize->add_setting('header_info', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'default' => '',
		'transport' => 'refresh',
		'themezero_sanitize_js_callback' => '',
	));

	$wp_customize->add_control('header_top_left', array(
		'type' => 'text',
		'label'      => __('Header Top Left', 'themezero'),
		'section'    => 'themezero_theme_option',
		'settings'   => 'header_info',
	));

	$wp_customize->add_setting('header_info_2', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'default' => '',
		'transport' => 'refresh',
		'themezero_sanitize_js_callback' => '',
	));

	$wp_customize->add_control('header_top_right', array(
		'type' => 'textarea',
		'label'      => __('Header Top right', 'themezero'),
		'section'    => 'themezero_theme_option',
		'settings'   => 'header_info_2',
	));


	$wp_customize->add_setting('header_button', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'default' => '',
		'transport' => 'refresh',
		'themezero_sanitize_js_callback' => '',
	));

	$wp_customize->add_control('header_top_button', array(
		'type' => 'textarea',
		'label'      => __('Header Button', 'themezero'),
		'section'    => 'themezero_theme_option',
		'settings'   => 'header_button',
	));

	$wp_customize->add_setting('copyright', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'default' => '',
		'transport' => 'refresh',
		'themezero_sanitize_js_callback' => '',
	));

	$wp_customize->add_control('copyright', array(
		'type' => 'textarea',
		'label'      => __('Copyright', 'themezero'),
		'section'    => 'themezero_theme_option',
		'settings'   => 'copyright',
	));
}


/**
 *  Sanitize Input Field
 */
function themezero_sanitize_text_input($input)
{
	if (!isset($input)) {
		return;
	}
	$output = sanitize_text_field($input);

	return $output;
}


/**
 *  Sanitize Link Field
 */
function themezero_sanitize_link_input($input)
{
	if (!isset($input)) {
		return;
	}
	$output = esc_url($input);

	return $output;
}

add_action('customize_register', 'themezero_customize_register');

function my_custom_post_feature()
{
	$labels = array(
		'name'               => _x('Features', 'post type general name'),
		'singular_name'      => _x('Feature', 'post type singular name'),
		'add_new'            => _x('Add New', 'book'),
		'add_new_item'       => __('Add New Feature'),
		'edit_item'          => __('Edit Feature'),
		'new_item'           => __('New Feature'),
		'all_items'          => __('All Features'),
		'view_item'          => __('View Feature'),
		'search_items'       => __('Search Features'),
		'not_found'          => __('No Features found'),
		'not_found_in_trash' => __('No Features found in the Trash'),
		// 'parent_item_colon'  => ’,
		'menu_name'          => 'Features'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our features and feature specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
		'has_archive'   => true,
	);
	register_post_type('feature', $args);
}
add_action('init', 'my_custom_post_feature');
