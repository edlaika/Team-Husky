<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_spacing_secondary_nav_customizer' ) ) :
/**
 * Adds our Secondary Nav spacing options
 *
 * These options are in their own function so we can hook it in late to
 * make sure Secondary Nav is activated.
 *
 * 1000 priority is there to make sure Secondary Nav is registered (999)
 * as we check to see if the layout control exists.
 *
 * Secondary Nav now uses 100 as a priority.
 */
add_action( 'customize_register', 'generate_spacing_secondary_nav_customizer', 1000 );
function generate_spacing_secondary_nav_customizer( $wp_customize ) {
	
	// Bail if we don't have our defaults
	if ( ! function_exists( 'generate_secondary_nav_get_defaults' ) ) {
		return;
	}
	
	// Make sure Secondary Nav is activated
	if ( ! $wp_customize->get_section( 'secondary_nav_section' ) ) {
		return;
	}

	// Get our controls
	require_once plugin_dir_path( __FILE__ ) . 'controls.php';

	// Get our defaults
	$defaults = generate_secondary_nav_get_defaults();
	
	// Remove our old label control if it exists
	// It only would if the user is using an old Secondary Nav add-on version
	if ( $wp_customize->get_control( 'generate_secondary_navigation_spacing_title' ) ) $wp_customize->remove_control( 'generate_secondary_navigation_spacing_title' );
	
	// Menu item width
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[secondary_menu_item]', array(
			'default' => $defaults['secondary_menu_item'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new Generate_Customize_Spacing_Slider_Control(
			$wp_customize,
			'generate_secondary_nav_settings[secondary_menu_item]', 
			array(
				'label' => __( 'Menu Item Width', 'generate-spacing' ), 
				'section' => 'secondary_nav_section',
				'settings' => 'generate_secondary_nav_settings[secondary_menu_item]',
				'priority' => 220,
				'type' => 'gp-spacing-slider',
				'default_value' => $defaults['secondary_menu_item'],
				'unit' => 'px',
			)
		)
	);
	
	// Menu item height
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[secondary_menu_item_height]', array(
			'default' => $defaults['secondary_menu_item_height'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new Generate_Customize_Spacing_Slider_Control(
			$wp_customize,
			'generate_secondary_nav_settings[secondary_menu_item_height]', 
			array(
				'label' => __( 'Menu Item Height', 'generate-spacing' ), 
				'section' => 'secondary_nav_section',
				'settings' => 'generate_secondary_nav_settings[secondary_menu_item_height]',
				'priority' => 240,
				'type' => 'gp-spacing-slider',
				'default_value' => $defaults['secondary_menu_item_height'],
				'unit' => 'px',
			)
		)
	);
	
	// Sub-menu height
	$wp_customize->add_setting(
		'generate_secondary_nav_settings[secondary_sub_menu_item_height]', array(
			'default' => $defaults['secondary_sub_menu_item_height'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new Generate_Customize_Spacing_Slider_Control(
			$wp_customize,
			'generate_secondary_nav_settings[secondary_sub_menu_item_height]', 
			array(
				'label' => __( 'Sub-Menu Item Height', 'generate-spacing' ), 
				'section' => 'secondary_nav_section',
				'settings' => 'generate_secondary_nav_settings[secondary_sub_menu_item_height]',
				'priority' => 260,
				'type' => 'gp-spacing-slider',
				'default_value' => $defaults['secondary_sub_menu_item_height'],
				'unit' => 'px',
			)
		)
	);
}
endif;