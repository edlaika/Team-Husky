<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_fonts_secondary_nav_customizer' ) ) :
/**
 * Adds our Secondary Nav typography options
 *
 * These options are in their own function so we can hook it in late to
 * make sure Secondary Nav is activated.
 *
 * 1000 priority is there to make sure Secondary Nav is registered (999)
 * as we check to see if the layout control exists.
 *
 * Secondary Nav now uses 100 as a priority.
 */
add_action( 'customize_register', 'generate_fonts_secondary_nav_customizer', 1000 );
function generate_fonts_secondary_nav_customizer( $wp_customize ) {
	
	// Bail if we don't have our defaults function
	if ( ! function_exists( 'generate_secondary_nav_get_defaults' ) ) {
		return;
	}
	
	// Make sure Secondary Nav is activated
	if ( ! $wp_customize->get_section( 'secondary_nav_section' ) ) {
		return;
	}
	
	// Get our controls
	require_once trailingslashit( dirname(__FILE__) ) . 'customizer/control.php';
	
	// Get our defaults
	$defaults = generate_secondary_nav_get_defaults();
	
	// Register our custom controls
	if ( method_exists( $wp_customize,'register_control_type' ) ) {
		$wp_customize->register_control_type( 'Generate_Google_Font_Dropdown_Custom_Control' );
		$wp_customize->register_control_type( 'Generate_Select_Control' );
		$wp_customize->register_control_type( 'Generate_Customize_Slider_Control' );
		$wp_customize->register_control_type( 'Generate_Hidden_Input_Control' );
	}
	
	// Add our section
	$wp_customize->add_section(
		'secondary_font_section',
		array(
			'title' => __( 'Secondary Navigation','generate-typography' ),
			'capability' => 'edit_theme_options',
			'description' => '',
			'priority' => 51,
			'panel' => 'generate_typography_panel'
		)
	);
	
	// Font family
	$wp_customize->add_setting( 
		'generate_secondary_nav_settings[font_secondary_navigation]', 
		array(
			'default' => $defaults['font_secondary_navigation'],
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
			
	$wp_customize->add_control( 
		new Generate_Google_Font_Dropdown_Custom_Control( 
			$wp_customize, 
			'google_font_site_secondary_navigation_control', 
			array(
				'label' => __('Secondary navigation','generate-typography'),
				'section' => 'secondary_font_section',
				'settings' => 'generate_secondary_nav_settings[font_secondary_navigation]',
				'priority' => 120
			)
		)
	);
	
	// Category
	$wp_customize->add_setting( 
		'font_secondary_navigation_category', 
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Hidden_Input_Control( 
			$wp_customize, 
			'font_secondary_navigation_category', 
			array(
				'section' => 'secondary_font_section',
				'settings' => 'font_secondary_navigation_category',
				'type' => 'gp-hidden-input',
				'priority' => 120
			)
		)
	);
	
	// Variants
	$wp_customize->add_setting( 
		'font_secondary_navigation_variants', 
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Hidden_Input_Control( 
			$wp_customize, 
			'font_secondary_navigation_variants', 
			array(
				'section' => 'secondary_font_section',
				'settings' => 'font_secondary_navigation_variants',
				'type' => 'gp-hidden-input',
				'priority' => 120
			)
		)
	);
	
	// Font weight
	$wp_customize->add_setting( 
		'generate_secondary_nav_settings[secondary_navigation_font_weight]', 
		array(
			'default' => $defaults['secondary_navigation_font_weight'],
			'type' => 'option',
			'sanitize_callback' => ( class_exists( 'Generate_Select_Control' ) ) ? 'generate_secondary_nav_sanitize_choices' : 'generate_sanitize_font_weight',
			'transport' => 'postMessage'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Select_Control( 
			$wp_customize, 
			'generate_secondary_nav_settings[secondary_navigation_font_weight]', 
			array(
				'label' => __('Font weight','generate-typography'),
				'section' => 'secondary_font_section',
				'settings' => 'generate_secondary_nav_settings[secondary_navigation_font_weight]',
				'priority' => 140,
				'type' => 'gp-typography-select',
				'choices' => array(
					'normal' => 'normal',
					'bold' => 'bold',
					'100' => '100',
					'200' => '200',
					'300' => '300',
					'400' => '400',
					'500' => '500',
					'600' => '600',
					'700' => '700',
					'800' => '800',
					'900' => '900'
				)
			)
		)
	);
	
	// Font transform
	$wp_customize->add_setting( 
		'generate_secondary_nav_settings[secondary_navigation_font_transform]', 
		array(
			'default' => $defaults['secondary_navigation_font_transform'],
			'type' => 'option',
			'sanitize_callback' => ( class_exists( 'Generate_Select_Control' ) ) ? 'generate_secondary_nav_sanitize_choices' : 'generate_sanitize_text_transform',
			'transport' => 'postMessage'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Select_Control( 
			$wp_customize, 
			'generate_secondary_nav_settings[secondary_navigation_font_transform]', 
			array(
				'label' => __('Text transform','generate-typography'),
				'section' => 'secondary_font_section',
				'settings' => 'generate_secondary_nav_settings[secondary_navigation_font_transform]',
				'priority' => 160,
				'type' => 'gp-typography-select',
				'choices' => array(
					'none' => 'none',
					'capitalize' => 'capitalize',
					'uppercase' => 'uppercase',
					'lowercase' => 'lowercase'
				)
			)
		)
	);
	
	// Font size
	$wp_customize->add_setting( 
		'generate_secondary_nav_settings[secondary_navigation_font_size]', 
		array(
			'default' => $defaults['secondary_navigation_font_size'],
			'type' => 'option',
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		)
	);
			
	$wp_customize->add_control( 
		new Generate_Customize_Slider_Control( 
			$wp_customize, 
			'generate_secondary_nav_settings[secondary_navigation_font_size]', 
			array(
				'label' => __('Font size','generate-typography'),
				'section' => 'secondary_font_section',
				'settings' => 'generate_secondary_nav_settings[secondary_navigation_font_size]',
				'priority' => 165,
				'type' => 'gp-typography-slider',
				'default_value' => $defaults['secondary_navigation_font_size'],
				'unit' => 'px'
			)
		)
	);
}
endif;