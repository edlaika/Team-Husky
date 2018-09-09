<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

// Add our old navigation section
$wp_customize->add_section(
	'generate_spacing_navigation',
	array(
		'title' => __( 'Primary Navigation', 'generate-spacing' ),
		'capability' => 'edit_theme_options',
		'priority' => 15,
		'panel' => 'generate_spacing_panel'
	)
);

// If our new Layout section doesn't exist, use the old navigation section
$navigation_section = ( $wp_customize->get_panel( 'generate_layout_panel' ) ) ? 'generate_layout_navigation' : 'generate_spacing_navigation';

// Menu item width
$wp_customize->add_setting(
	'generate_spacing_settings[menu_item]', array(
		'default' => $defaults['menu_item'],
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new Generate_Customize_Spacing_Slider_Control(
		$wp_customize,
		'generate_spacing_settings[menu_item]', 
		array(
			'label' => __( 'Menu Item Width', 'generate-spacing' ), 
			'section' => $navigation_section,
			'settings' => 'generate_spacing_settings[menu_item]',
			'priority' => 220,
			'type' => 'gp-spacing-slider',
			'default_value' => $defaults['menu_item'],
			'unit' => 'px',
		)
	)
);

// Menu item height
$wp_customize->add_setting(
	'generate_spacing_settings[menu_item_height]', array(
		'default' => $defaults['menu_item_height'],
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new Generate_Customize_Spacing_Slider_Control(
		$wp_customize,
		'generate_spacing_settings[menu_item_height]', 
		array(
			'label' => __( 'Menu Item Height', 'generate-spacing' ), 
			'section' => $navigation_section,
			'settings' => 'generate_spacing_settings[menu_item_height]',
			'priority' => 240,
			'type' => 'gp-spacing-slider',
			'default_value' => $defaults['menu_item_height'],
			'unit' => 'px',
		)
	)
);

// Sub-menu item height
$wp_customize->add_setting(
	'generate_spacing_settings[sub_menu_item_height]', array(
		'default' => $defaults['sub_menu_item_height'],
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new Generate_Customize_Spacing_Slider_Control(
		$wp_customize,
		'generate_spacing_settings[sub_menu_item_height]', 
		array(
			'label' => __( 'Sub-Menu Item Height', 'generate-spacing' ), 
			'section' => $navigation_section,
			'settings' => 'generate_spacing_settings[sub_menu_item_height]',
			'priority' => 260,
			'type' => 'gp-spacing-slider',
			'default_value' => $defaults['sub_menu_item_height'],
			'unit' => 'px',
		)
	)
);