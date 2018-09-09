<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

// Run any necessary migration
require_once plugin_dir_path( __FILE__ ) . 'migration.php';

// Include Secondary Nav add-on options
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/secondary-nav-spacing.php';

if ( ! function_exists( 'generate_spacing_customize_register' ) ) :
/* 
 * Add our spacing Customizer options
 * @since 0.1
 */ 
add_action( 'customize_register', 'generate_spacing_customize_register', 99 );
function generate_spacing_customize_register( $wp_customize ) {
	
	// Bail if we don't have our defaults
	if ( ! function_exists( 'generate_spacing_get_defaults' ) )
		return;
	
	// A setting is required for our labels
	$wp_customize->add_setting('generate_spacing_headings');
	
	// Add our controls
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/controls.php';

	// Get our defaults
	$defaults = generate_spacing_get_defaults();
	
	// Register our custom control types
	if ( method_exists( $wp_customize,'register_control_type' ) ) {
		$wp_customize->register_control_type( 'Generate_Customize_Spacing_Slider_Control' );
		$wp_customize->register_control_type( 'GeneratePress_Spacing_Control' );
	}
	
	// Add our Spacing panel
	// This is only used if the Layout panel in the free theme doesn't exist
	if ( class_exists( 'WP_Customize_Panel' ) ) :
		if ( ! $wp_customize->get_panel( 'generate_spacing_panel' ) ) {
			$wp_customize->add_panel( 'generate_spacing_panel', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Spacing','generate-spacing' ),
				'description'    => __( 'Change the spacing for various elements using pixels.', 'generate-spacing' ),
				'priority'		 => 35
			) );
		}
	endif;
	
	// Include top bar spacing
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/top-bar-spacing.php';
	
	// Include header spacing
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/header-spacing.php';
	
	// Include content spacing
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/content-spacing.php';
	
	// Include widget spacing
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/sidebar-spacing.php';
	
	// Include navigation spacing
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/navigation-spacing.php';
	
	// Include footer spacing
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer/footer-spacing.php';
	
}
endif;

if ( ! function_exists( 'generate_right_sidebar_width' ) ) :
/* 
 * Set our right sidebar width
 */ 
add_filter( 'generate_right_sidebar_width', 'generate_right_sidebar_width' );
function generate_right_sidebar_width( $width )
{
	// Bail if we don't have our defaults
	if ( ! function_exists( 'generate_spacing_get_defaults' ) )
		return $width;
	
	$spacing_settings = wp_parse_args( 
		get_option( 'generate_spacing_settings', array() ), 
		generate_spacing_get_defaults() 
	);
	
	return absint( $spacing_settings['right_sidebar_width'] );
}
endif;

if ( ! function_exists( 'generate_left_sidebar_width' ) ) :
/* 
 * Set our left sidebar width
 */ 
add_filter( 'generate_left_sidebar_width', 'generate_left_sidebar_width' );
function generate_left_sidebar_width( $width )
{
	// Bail if we don't have our defaults
	if ( ! function_exists( 'generate_spacing_get_defaults' ) )
		return $width;
	
	$spacing_settings = wp_parse_args( 
		get_option( 'generate_spacing_settings', array() ), 
		generate_spacing_get_defaults() 
	);
	
	return absint( $spacing_settings['left_sidebar_width'] );
}
endif;

if ( ! function_exists( 'generate_spacing_sanitize_choices' ) ) :
/**
 * Sanitize choices
 */
function generate_spacing_sanitize_choices( $input, $setting ) {
	
	// Ensure input is a slug
	$input = sanitize_key( $input );
	
	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
endif;

if ( ! function_exists( 'generate_spacing_customizer_live_preview' ) ) :
/* 
 * Add our live preview JS
 */ 
add_action( 'customize_preview_init', 'generate_spacing_customizer_live_preview' );
function generate_spacing_customizer_live_preview()
{
	wp_enqueue_script( 
		  'generate-spacing-customizer',
		  trailingslashit( plugin_dir_url( __FILE__ ) ) . 'customizer/js/customizer.js',
		  array( 'jquery','customize-preview' ),
		  GENERATE_SPACING_VERSION,
		  true
	);
	
	wp_localize_script( 'generate-spacing-customizer', 'gp_spacing', array(
		'mobile' => apply_filters( 'generate_mobile_media_query', '(max-width:768px)' ),
		'not_mobile' => apply_filters( 'generate_not_mobile_media_query', '(min-width:769px)' )
	) );
}
endif;

if ( ! function_exists( 'generate_include_spacing_defaults' ) ) :
/**
 * Check if we should include our default.css file
 * @since 1.3.42
 */
function generate_include_spacing_defaults() {
	return true;
}
endif;