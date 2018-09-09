<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

// Add our old Sidebars section
// This section is no longer used but is kept around for back compat
$wp_customize->add_section(
	'generate_spacing_sidebar',
	array(
		'title' => __( 'Sidebars', 'generate-spacing' ),
		'capability' => 'edit_theme_options',
		'priority' => 15,
		'panel' => 'generate_spacing_panel'
	)
);

// Add our controls to the Layout panel if it exists
// If not, use the old section
$widget_section = ( $wp_customize->get_panel( 'generate_layout_panel' ) ) ? 'generate_layout_sidebars' : 'generate_spacing_sidebar';

// Widget padding top
$wp_customize->add_setting( 'generate_spacing_settings[widget_top]', 
	array( 
		'default' => $defaults['widget_top'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Widget padding right
$wp_customize->add_setting( 'generate_spacing_settings[widget_right]', 
	array( 
		'default' => $defaults['widget_right'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Widget padding bottom
$wp_customize->add_setting( 'generate_spacing_settings[widget_bottom]', 
	array( 
		'default' => $defaults['widget_bottom'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Widget padding left
$wp_customize->add_setting( 'generate_spacing_settings[widget_left]', 
	array( 
		'default' => $defaults['widget_left'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Make use of the widget padding settings
$wp_customize->add_control(
	new GeneratePress_Spacing_Control(
		$wp_customize,
		'widget_spacing',
		array(
			'type' 		 => 'generatepress-spacing',
			'label'      => esc_html__( 'Widget Padding', 'generate-spacing' ),
			'section'    => $widget_section,
			'settings'   => array(
				'top'    => 'generate_spacing_settings[widget_top]',
				'right'  => 'generate_spacing_settings[widget_right]',
				'bottom' => 'generate_spacing_settings[widget_bottom]',
				'left'   => 'generate_spacing_settings[widget_left]'
			),
			'element'	 => 'widget',
			'priority'   => 99
		)
	)
);

// Left sidebar width
$wp_customize->add_setting(
	'generate_spacing_settings[left_sidebar_width]', array(
		'default' => $defaults['left_sidebar_width'],
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new Generate_Customize_Spacing_Slider_Control(
		$wp_customize,
		'generate_spacing_settings[left_sidebar_width]', 
		array(
			'label' => __( 'Left Sidebar Width', 'generate-spacing' ), 
			'section' => $widget_section,
			'settings' => 'generate_spacing_settings[left_sidebar_width]',
			'priority' => 125,
			'type' => 'gp-spacing-slider',
			'default_value' => $defaults['left_sidebar_width'],
			'unit' => '%',
			'edit_field' => false,
		)
	)
);

// Right sidebar width
$wp_customize->add_setting(
	'generate_spacing_settings[right_sidebar_width]', array(
		'default' => $defaults['right_sidebar_width'],
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new Generate_Customize_Spacing_Slider_Control(
		$wp_customize,
		'generate_spacing_settings[right_sidebar_width]', 
		array(
			'label' => __( 'Right Sidebar Width', 'generate-spacing' ), 
			'section' => $widget_section,
			'settings' => 'generate_spacing_settings[right_sidebar_width]',
			'priority' => 130,
			'type' => 'gp-spacing-slider',
			'default_value' => $defaults['right_sidebar_width'],
			'unit' => '%',
			'edit_field' => false,
		)
	)
);