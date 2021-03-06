<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

// Add our old Spacing section
$wp_customize->add_section(
	'generate_spacing_content',
	array(
		'title' => __( 'Content', 'generate-spacing' ),
		'capability' => 'edit_theme_options',
		'priority' => 10,
		'panel' => 'generate_spacing_panel'
	)
);

// If we don't have a layout panel, use our old spacing section
if ( $wp_customize->get_panel( 'generate_layout_panel' ) ) {
	$content_section = 'generate_layout_container';
} else {
	$content_section = 'generate_spacing_content';
}

// Separating space
$wp_customize->add_setting(
	'generate_spacing_settings[separator]', array(
		'default' => $defaults['separator'],
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new Generate_Customize_Spacing_Slider_Control(
		$wp_customize,
		'generate_spacing_settings[separator]', 
		array(
			'label' => __( 'Separating Space', 'generate-spacing' ), 
			'section' => $content_section,
			'settings' => 'generate_spacing_settings[separator]',
			'priority' => 80,
			'type' => 'gp-spacing-slider',
			'default_value' => $defaults['separator'],
			'unit' => 'px'
		)
	)
);

// Content padding top
$wp_customize->add_setting( 'generate_spacing_settings[content_top]', 
	array( 
		'default' => $defaults['content_top'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Content padding right
$wp_customize->add_setting( 'generate_spacing_settings[content_right]', 
	array( 
		'default' => $defaults['content_right'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Content padding bottom
$wp_customize->add_setting( 'generate_spacing_settings[content_bottom]', 
	array( 
		'default' => $defaults['content_bottom'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Content padding left
$wp_customize->add_setting( 'generate_spacing_settings[content_left]', 
	array( 
		'default' => $defaults['content_left'], 
		'type' => 'option',
		'sanitize_callback' => 'absint', 
		'transport' => 'postMessage' 
	) 
);

// Make use of the content padding settings
$wp_customize->add_control(
	new GeneratePress_Spacing_Control(
		$wp_customize,
		'content_spacing',
		array(
			'type' 		 => 'generatepress-spacing',
			'label'      => esc_html__( 'Content Padding', 'generate-spacing' ),
			'section'    => $content_section,
			'settings'   => array(
				'top'    => 'generate_spacing_settings[content_top]',
				'right'  => 'generate_spacing_settings[content_right]',
				'bottom' => 'generate_spacing_settings[content_bottom]',
				'left'   => 'generate_spacing_settings[content_left]'
			),
			'element'	 => 'content',
			'priority'   => 99
		)
	)
);

// If mobile_content_top is set, the rest of them are too
// We have to check as these defaults are set in the theme
if ( isset( $defaults[ 'mobile_content_top' ] ) ) {
	// Mobile content padding top
	$wp_customize->add_setting( 'generate_spacing_settings[mobile_content_top]', 
		array( 
			'default' => $defaults['mobile_content_top'], 
			'type' => 'option',
			'sanitize_callback' => 'absint', 
			'transport' => 'postMessage' 
		) 
	);

	// Content padding right
	$wp_customize->add_setting( 'generate_spacing_settings[mobile_content_right]', 
		array( 
			'default' => $defaults['mobile_content_right'], 
			'type' => 'option',
			'sanitize_callback' => 'absint', 
			'transport' => 'postMessage' 
		) 
	);

	// Content padding bottom
	$wp_customize->add_setting( 'generate_spacing_settings[mobile_content_bottom]', 
		array( 
			'default' => $defaults['mobile_content_bottom'], 
			'type' => 'option',
			'sanitize_callback' => 'absint', 
			'transport' => 'postMessage' 
		) 
	);

	// Content padding left
	$wp_customize->add_setting( 'generate_spacing_settings[mobile_content_left]', 
		array( 
			'default' => $defaults['mobile_content_left'], 
			'type' => 'option',
			'sanitize_callback' => 'absint', 
			'transport' => 'postMessage' 
		) 
	);

	// Make use of the content padding settings
	$wp_customize->add_control(
		new GeneratePress_Spacing_Control(
			$wp_customize,
			'mobile_content_spacing',
			array(
				'type' 		 => 'generatepress-spacing',
				'label'      => esc_html__( 'Mobile Content Padding', 'generate-spacing' ),
				'section'    => $content_section,
				'settings'   => array(
					'top'    => 'generate_spacing_settings[mobile_content_top]',
					'right'  => 'generate_spacing_settings[mobile_content_right]',
					'bottom' => 'generate_spacing_settings[mobile_content_bottom]',
					'left'   => 'generate_spacing_settings[mobile_content_left]'
				),
				'element'	 => 'mobile_content',
				'priority'   => 100
			)
		)
	);
}