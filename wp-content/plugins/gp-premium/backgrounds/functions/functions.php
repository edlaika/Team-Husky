<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'generate_get_background_defaults' ) ) :
/**
 * Set default options
 * @since 0.1
 */
function generate_get_background_defaults()
{
	$generate_background_defaults = array(
		'body_image' => '',
		'body_repeat' => '',
		'body_size' => '',
		'body_attachment' => '',
		'body_position' => '',
		'top_bar_image' => '',
		'top_bar_repeat' => '',
		'top_bar_size' => '',
		'top_bar_attachment' => '',
		'top_bar_position' => '',
		'header_image' => '',
		'header_repeat' => '',
		'header_size' => '',
		'header_attachment' => '',
		'header_position' => '',
		'nav_image' => '',
		'nav_repeat' => '',
		'nav_item_image' => '',
		'nav_item_repeat' => '',
		'nav_item_hover_image' => '',
		'nav_item_hover_repeat' => '',
		'nav_item_current_image' => '',
		'nav_item_current_repeat' => '',
		'sub_nav_image' => '',
		'sub_nav_repeat' => '',
		'sub_nav_item_image' => '',
		'sub_nav_item_repeat' => '',
		'sub_nav_item_hover_image' => '',
		'sub_nav_item_hover_repeat' => '',
		'sub_nav_item_current_image' => '',
		'sub_nav_item_current_repeat' => '',
		'content_image' => '',
		'content_repeat' => '',
		'content_size' => '',
		'content_attachment' => '',
		'content_position' => '',
		'sidebar_widget_image' => '',
		'sidebar_widget_repeat' => '',
		'sidebar_widget_size' => '',
		'sidebar_widget_attachment' => '',
		'sidebar_widget_position' => '',
		'footer_widget_image' => '',
		'footer_widget_repeat' => '',
		'footer_widget_size' => '',
		'footer_widget_attachment' => '',
		'footer_widget_position' => '',
		'footer_image' => '',
		'footer_repeat' => '',
		'footer_size' => '',
		'footer_attachment' => '',
		'footer_position' => '',
	);
	
	return apply_filters( 'generate_background_option_defaults', $generate_background_defaults );
}
endif;

// Add our Secondary Navigation settings
require_once plugin_dir_path( __FILE__ ) . 'secondary-nav-backgrounds.php';

if ( ! function_exists( 'generate_backgrounds_customize' ) ) :
/**
 * Build our Customizer options
 * @since 0.1
 */
add_action( 'customize_register', 'generate_backgrounds_customize', 999 );
function generate_backgrounds_customize( $wp_customize )
{
	// Get our defaults
	$defaults = generate_get_background_defaults();
	
	// Get our controls
	require_once plugin_dir_path( __FILE__ ) . 'controls.php';
	
	// Register our custom control
	if ( method_exists( $wp_customize,'register_control_type' ) ) {
		$wp_customize->register_control_type( 'Generate_Backgrounds_Customize_Control' );
	}
	
	// Add our panel
	if ( class_exists( 'WP_Customize_Panel' ) ) :
		if ( ! $wp_customize->get_panel( 'generate_backgrounds_panel' ) ) {
			$wp_customize->add_panel( 'generate_backgrounds_panel', array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Background Images','backgrounds' ),
				'priority'		 => 55
			) );
		}
	endif;
	
	$wp_customize->add_section(
		'backgrounds_section',
		array(
			'title' => __( 'Background Images','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 50
		)
	);
	
	$wp_customize->add_section(
		'generate_backgrounds_body',
		array(
			'title' => __( 'Body','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 5,
			'panel' => 'generate_backgrounds_panel'
		)
	);
	
	/**
	 * Body background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[body_image]', array(
			'default' => $defaults['body_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_backgrounds-body-image', 
			array(
				'section'    => 'generate_backgrounds_body',
				'settings'   => 'generate_background_settings[body_image]',
				'label' => __( 'Body','backgrounds' )
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[body_repeat]',
		array(
			'default' => $defaults['body_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[body_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_body',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[body_repeat]',
			'priority' => 50
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[body_size]',
		array(
			'default' => $defaults['body_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[body_size]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_body',
			'choices' => array(
				'' => __( 'Size (Auto)','backgrounds' ),
				'100% auto' => __( '100% Width','backgrounds' ),
				'cover' => __( 'Cover','backgrounds' ),
				'contain' => __( 'Contain','backgrounds' )
			),
			'settings' => 'generate_background_settings[body_size]',
			'priority' => 100
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[body_attachment]',
		array(
			'default' => $defaults['body_attachment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[body_attachment]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_body',
			'choices' => array(
				'' => __( 'Attachment','backgrounds' ),
				'fixed' => __( 'Fixed','backgrounds' ),
				'local' => __( 'Local','backgrounds' ),
				'inherit' => __( 'Inherit','backgrounds' )
			),
			'settings' => 'generate_background_settings[body_attachment]',
			'priority' => 150
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[body_position]', array(
			'default' => $defaults['body_position'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_html'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Backgrounds_Customize_Control( 
			$wp_customize, 
			'generate_background_settings[body_position]', 
			array(
				'section'    => 'generate_backgrounds_body',
				'settings'   => 'generate_background_settings[body_position]',
				'priority' => 200,
				'label' => 'left top, x% y%, xpos ypos (px)',
				'placeholder' => __('Position','backgrounds')
			)
		)
	);
	
	/**
	 * Top bar background
	 */
	$wp_customize->add_section(
		'generate_backgrounds_top_bar',
		array(
			'title' => __( 'Top Bar','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 5,
			'panel' => 'generate_backgrounds_panel',
			'active_callback' => 'generate_backgrounds_is_top_bar_active'
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[top_bar_image]', array(
			'default' => $defaults['top_bar_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[top_bar_image]', 
			array(
				'section'    => 'generate_backgrounds_top_bar',
				'settings'   => 'generate_background_settings[top_bar_image]',
				'label' => __( 'Top Bar','backgrounds' ),
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[top_bar_repeat]',
		array(
			'default' => $defaults['top_bar_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[top_bar_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_top_bar',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[top_bar_repeat]'
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[top_bar_size]',
		array(
			'default' => $defaults['top_bar_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[top_bar_size]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_top_bar',
			'choices' => array(
				'' => __( 'Size (Auto)','backgrounds' ),
				'100% auto' => __( '100% Width','backgrounds' ),
				'cover' => __( 'Cover','backgrounds' ),
				'contain' => __( 'Contain','backgrounds' )
			),
			'settings' => 'generate_background_settings[top_bar_size]'
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[top_bar_attachment]',
		array(
			'default' => $defaults['top_bar_attachment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[top_bar_attachment]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_top_bar',
			'choices' => array(
				'' => __( 'Attachment','backgrounds' ),
				'fixed' => __( 'Fixed','backgrounds' ),
				'local' => __( 'Local','backgrounds' ),
				'inherit' => __( 'Inherit','backgrounds' )
			),
			'settings' => 'generate_background_settings[top_bar_attachment]'
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[top_bar_position]', array(
			'default' => $defaults['top_bar_position'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_html'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Backgrounds_Customize_Control( 
			$wp_customize, 
			'generate_background_settings[top_bar_position]', 
			array(
				'section'    => 'generate_backgrounds_top_bar',
				'settings'   => 'generate_background_settings[top_bar_position]',
				'label' => 'left top, x% y%, xpos ypos (px)',
				'placeholder' => __('Position','backgrounds')
			)
		)
	);
	
	/**
	 * Header background
	 */
	$wp_customize->add_section(
		'generate_backgrounds_header',
		array(
			'title' => __( 'Header','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 10,
			'panel' => 'generate_backgrounds_panel'
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[header_image]', array(
			'default' => $defaults['header_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_backgrounds-header-image', 
			array(
				'section'    => 'generate_backgrounds_header',
				'settings'   => 'generate_background_settings[header_image]',
				'priority' => 350,
				'label' => __( 'Header','backgrounds' ),
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[header_repeat]',
		array(
			'default' => $defaults['header_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[header_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_header',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[header_repeat]',
			'priority' => 400
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[header_size]',
		array(
			'default' => $defaults['header_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[header_size]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_header',
			'choices' => array(
				'' => __( 'Size (Auto)','backgrounds' ),
				'100% auto' => __( '100% Width','backgrounds' ),
				'cover' => __( 'Cover','backgrounds' ),
				'contain' => __( 'Contain','backgrounds' )
			),
			'settings' => 'generate_background_settings[header_size]',
			'priority' => 450
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[header_attachment]',
		array(
			'default' => $defaults['header_attachment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[header_attachment]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_header',
			'choices' => array(
				'' => __( 'Attachment','backgrounds' ),
				'fixed' => __( 'Fixed','backgrounds' ),
				'local' => __( 'Local','backgrounds' ),
				'inherit' => __( 'Inherit','backgrounds' )
			),
			'settings' => 'generate_background_settings[header_attachment]',
			'priority' => 500
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[header_position]', array(
			'default' => $defaults['header_position'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_html'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Backgrounds_Customize_Control( 
			$wp_customize, 
			'generate_background_settings[header_position]', 
			array(
				'section'    => 'generate_backgrounds_header',
				'settings'   => 'generate_background_settings[header_position]',
				'priority' => 550,
				'label' => 'left top, x% y%, xpos ypos (px)',
				'placeholder' => __('Position','backgrounds')
			)
		)
	);
	
	$wp_customize->add_section(
		'generate_backgrounds_navigation',
		array(
			'title' => __( 'Primary Navigation','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 15,
			'panel' => 'generate_backgrounds_panel'
		)
	);
	
	/**
	 * Navigation background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[nav_image]', array(
			'default' => $defaults['nav_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[nav_image]', 
			array(
				'section'    => 'generate_backgrounds_navigation',
				'settings'   => 'generate_background_settings[nav_image]',
				'priority' => 750,
				'label' => __( 'Navigation','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[nav_repeat]',
		array(
			'default' => $defaults['nav_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[nav_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_navigation',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[nav_repeat]',
			'priority' => 800
		)
	);
	
	/**
	 * Navigation item background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[nav_item_image]', array(
			'default' => $defaults['nav_item_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_backgrounds-nav-item-image', 
			array(
				'section'    => 'generate_backgrounds_navigation',
				'settings'   => 'generate_background_settings[nav_item_image]',
				'priority' => 950,
				'label' => __( 'Navigation Item','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[nav_item_repeat]',
		array(
			'default' => $defaults['nav_item_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[nav_item_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_navigation',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[nav_item_repeat]',
			'priority' => 1000
		)
	);
	
	/**
	 * Navigation item hover background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[nav_item_hover_image]', array(
			'default' => $defaults['nav_item_hover_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_backgrounds-nav-item-hover-image', 
			array(
				'section'    => 'generate_backgrounds_navigation',
				'settings'   => 'generate_background_settings[nav_item_hover_image]',
				'priority' => 1150,
				'label' => __( 'Navigation Item Hover','backgrounds' ),
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[nav_item_hover_repeat]',
		array(
			'default' => $defaults['nav_item_hover_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[nav_item_hover_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_navigation',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[nav_item_hover_repeat]',
			'priority' => 1200
		)
	);
	
	/**
	 * Navigation item current background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[nav_item_current_image]', array(
			'default' => $defaults['nav_item_current_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_backgrounds-nav-item-current-image', 
			array(
				'section'    => 'generate_backgrounds_navigation',
				'settings'   => 'generate_background_settings[nav_item_current_image]',
				'priority' => 1350,
				'label' => __( 'Navigation Item Current','backgrounds' ),
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[nav_item_current_repeat]',
		array(
			'default' => $defaults['nav_item_current_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[nav_item_current_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_navigation',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[nav_item_current_repeat]',
			'priority' => 1400
		)
	);
	
	$wp_customize->add_section(
		'generate_backgrounds_subnavigation',
		array(
			'title' => __( 'Primary Sub-Navigation','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 20,
			'panel' => 'generate_backgrounds_panel'
		)
	);
	
	/**
	 * Sub-Navigation item background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[sub_nav_item_image]', array(
			'default' => $defaults['sub_nav_item_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[sub_nav_item_image]', 
			array(
				'section'    => 'generate_backgrounds_subnavigation',
				'settings'   => 'generate_background_settings[sub_nav_item_image]',
				'priority' => 1700,
				'label' => __( 'Sub-Navigation Item','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[sub_nav_item_repeat]',
		array(
			'default' => $defaults['sub_nav_item_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[sub_nav_item_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_subnavigation',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[sub_nav_item_repeat]',
			'priority' => 1800
		)
	);
	
	/**
	 * Sub-Navigation item hover background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[sub_nav_item_hover_image]', array(
			'default' => $defaults['sub_nav_item_hover_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[sub_nav_item_hover_image]', 
			array(
				'section'    => 'generate_backgrounds_subnavigation',
				'settings'   => 'generate_background_settings[sub_nav_item_hover_image]',
				'priority' => 2000,
				'label' => __( 'Sub-Navigation Item Hover','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[sub_nav_item_hover_repeat]',
		array(
			'default' => $defaults['sub_nav_item_hover_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[sub_nav_item_hover_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_subnavigation',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[sub_nav_item_hover_repeat]',
			'priority' => 2100
		)
	);
	
	/**
	 * Sub-Navigation item current background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[sub_nav_item_current_image]', array(
			'default' => $defaults['sub_nav_item_current_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[sub_nav_item_current_image]', 
			array(
				'section'    => 'generate_backgrounds_subnavigation',
				'settings'   => 'generate_background_settings[sub_nav_item_current_image]',
				'priority' => 2300,
				'label' => __( 'Sub-Navigation Item Current','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[sub_nav_item_current_repeat]',
		array(
			'default' => $defaults['sub_nav_item_current_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[sub_nav_item_current_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_subnavigation',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[sub_nav_item_current_repeat]',
			'priority' => 2400
		)
	);
	
	$wp_customize->add_section(
		'generate_backgrounds_content',
		array(
			'title' => __( 'Content','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 25,
			'panel' => 'generate_backgrounds_panel'
		)
	);
	
	/**
	 * Content background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[content_image]', array(
			'default' => $defaults['content_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[content_image]', 
			array(
				'section'    => 'generate_backgrounds_content',
				'settings'   => 'generate_background_settings[content_image]',
				'priority' => 2700,
				'label' => __( 'Content','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[content_repeat]',
		array(
			'default' => $defaults['content_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[content_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_content',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[content_repeat]',
			'priority' => 2800
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[content_size]',
		array(
			'default' => $defaults['content_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[content_size]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_content',
			'choices' => array(
				'' => __( 'Size (Auto)','backgrounds' ),
				'100% auto' => __( '100% Width','backgrounds' ),
				'cover' => __( 'Cover','backgrounds' ),
				'contain' => __( 'Contain','backgrounds' )
			),
			'settings' => 'generate_background_settings[content_size]',
			'priority' => 2900
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[content_attachment]',
		array(
			'default' => $defaults['content_attachment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[content_attachment]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_content',
			'choices' => array(
				'' => __( 'Attachment','backgrounds' ),
				'fixed' => __( 'Fixed','backgrounds' ),
				'local' => __( 'Local','backgrounds' ),
				'inherit' => __( 'Inherit','backgrounds' )
			),
			'settings' => 'generate_background_settings[content_attachment]',
			'priority' => 3000
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[content_position]', array(
			'default' => $defaults['content_position'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_html'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Backgrounds_Customize_Control( 
			$wp_customize, 
			'generate_backgrounds-content-position', 
			array(
				'section'    => 'generate_backgrounds_content',
				'settings'   => 'generate_background_settings[content_position]',
				'priority' => 3100,
				'label' => 'left top, x% y%, xpos ypos (px)',
				'placeholder' => __('Position','backgrounds')
			)
		)
	);
	
	$wp_customize->add_section(
		'generate_backgrounds_sidebars',
		array(
			'title' => __( 'Sidebar','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 25,
			'panel' => 'generate_backgrounds_panel'
		)
	);
	
	/**
	 * Sidebar widget background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[sidebar_widget_image]', array(
			'default' => $defaults['sidebar_widget_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[sidebar_widget_image]', 
			array(
				'section'    => 'generate_backgrounds_sidebars',
				'settings'   => 'generate_background_settings[sidebar_widget_image]',
				'priority' => 3400,
				'label' => __( 'Sidebar Widgets','backgrounds' ),
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[sidebar_widget_repeat]',
		array(
			'default' => $defaults['sidebar_widget_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[sidebar_widget_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_sidebars',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[sidebar_widget_repeat]',
			'priority' => 3500
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[sidebar_widget_size]',
		array(
			'default' => $defaults['sidebar_widget_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[sidebar_widget_size]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_sidebars',
			'choices' => array(
				'' => __( 'Size (Auto)','backgrounds' ),
				'100% auto' => __( '100% Width','backgrounds' ),
				'cover' => __( 'Cover','backgrounds' ),
				'contain' => __( 'Contain','backgrounds' )
			),
			'settings' => 'generate_background_settings[sidebar_widget_size]',
			'priority' => 3600
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[sidebar_widget_attachment]',
		array(
			'default' => $defaults['sidebar_widget_attachment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[sidebar_widget_attachment]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_sidebars',
			'choices' => array(
				'' => __( 'Attachment','backgrounds' ),
				'fixed' => __( 'Fixed','backgrounds' ),
				'local' => __( 'Local','backgrounds' ),
				'inherit' => __( 'Inherit','backgrounds' )
			),
			'settings' => 'generate_background_settings[sidebar_widget_attachment]',
			'priority' => 3700
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[sidebar_widget_position]', array(
			'default' => $defaults['sidebar_widget_position'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_html'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Backgrounds_Customize_Control( 
			$wp_customize, 
			'generate_background_settings[sidebar_widget_position]', 
			array(
				'section'    => 'generate_backgrounds_sidebars',
				'settings'   => 'generate_background_settings[sidebar_widget_position]',
				'priority' => 3800,
				'label' => 'left top, x% y%, xpos ypos (px)',
				'placeholder' => __('Position','backgrounds')
			)
		)
	);
	
	$wp_customize->add_section(
		'generate_backgrounds_footer',
		array(
			'title' => __( 'Footer','backgrounds' ),
			'capability' => 'edit_theme_options',
			'priority' => 30,
			'panel' => 'generate_backgrounds_panel'
		)
	);
	
	/**
	 * Footer widget background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[footer_widget_image]', array(
			'default' => $defaults['footer_widget_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_background_settings[footer_widget_image]', 
			array(
				'section'    => 'generate_backgrounds_footer',
				'settings'   => 'generate_background_settings[footer_widget_image]',
				'priority' => 4100,
				'label' => __( 'Footer Widget Area','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_widget_repeat]',
		array(
			'default' => $defaults['footer_widget_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[footer_widget_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_footer',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[footer_widget_repeat]',
			'priority' => 4200
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_widget_size]',
		array(
			'default' => $defaults['footer_widget_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[footer_widget_size]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_footer',
			'choices' => array(
				'' => __( 'Size (Auto)','backgrounds' ),
				'100% auto' => __( '100% Width','backgrounds' ),
				'cover' => __( 'Cover','backgrounds' ),
				'contain' => __( 'Contain','backgrounds' )
			),
			'settings' => 'generate_background_settings[footer_widget_size]',
			'priority' => 4300
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_widget_attachment]',
		array(
			'default' => $defaults['footer_widget_attachment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[footer_widget_attachment]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_footer',
			'choices' => array(
				'' => __( 'Attachment','backgrounds' ),
				'fixed' => __( 'Fixed','backgrounds' ),
				'local' => __( 'Local','backgrounds' ),
				'inherit' => __( 'Inherit','backgrounds' )
			),
			'settings' => 'generate_background_settings[footer_widget_attachment]',
			'priority' => 4400
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_widget_position]', array(
			'default' => $defaults['footer_widget_position'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_html'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Backgrounds_Customize_Control( 
			$wp_customize, 
			'generate_background_settings[footer_widget_position]', 
			array(
				'section'    => 'generate_backgrounds_footer',
				'settings'   => 'generate_background_settings[footer_widget_position]',
				'priority' => 4500,
				'label' => 'left top, x% y%, xpos ypos (px)',
				'placeholder' => __('Position','backgrounds')
			)
		)
	);
	
	/**
	 * Footer background
	 */
	$wp_customize->add_setting(
		'generate_background_settings[footer_image]', array(
			'default' => $defaults['footer_image'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'generate_backgrounds-footer-image', 
			array(
				'section'    => 'generate_backgrounds_footer',
				'settings'   => 'generate_background_settings[footer_image]',
				'priority' => 4800,
				'label' => __( 'Footer Area','backgrounds' ), 
			)
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_repeat]',
		array(
			'default' => $defaults['footer_repeat'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[footer_repeat]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_footer',
			'choices' => array(
				'' => __( 'Repeat','backgrounds' ),
				'repeat-x' => __( 'Repeat x','backgrounds' ),
				'repeat-y' => __( 'Repeat y','backgrounds' ),
				'no-repeat' => __( 'No Repeat','backgrounds' )
			),
			'settings' => 'generate_background_settings[footer_repeat]',
			'priority' => 4900
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_size]',
		array(
			'default' => $defaults['footer_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[footer_size]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_footer',
			'choices' => array(
				'' => __( 'Size (Auto)','backgrounds' ),
				'100% auto' => __( '100% Width','backgrounds' ),
				'cover' => __( 'Cover','backgrounds' ),
				'contain' => __( 'Contain','backgrounds' )
			),
			'settings' => 'generate_background_settings[footer_size]',
			'priority' => 5000
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_attachment]',
		array(
			'default' => $defaults['footer_attachment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_backgrounds_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_background_settings[footer_attachment]',
		array(
			'type' => 'select',
			'section' => 'generate_backgrounds_footer',
			'choices' => array(
				'' => __( 'Attachment','backgrounds' ),
				'fixed' => __( 'Fixed','backgrounds' ),
				'local' => __( 'Local','backgrounds' ),
				'inherit' => __( 'Inherit','backgrounds' )
			),
			'settings' => 'generate_background_settings[footer_attachment]',
			'priority' => 5100
		)
	);
	
	$wp_customize->add_setting(
		'generate_background_settings[footer_position]', array(
			'default' => $defaults['footer_position'],
			'type' => 'option', 
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_html'
		)
	);
	
	$wp_customize->add_control( 
		new Generate_Backgrounds_Customize_Control( 
			$wp_customize, 
			'generate_background_settings[footer_position]', 
			array(
				'section'    => 'generate_backgrounds_footer',
				'settings'   => 'generate_background_settings[footer_position]',
				'priority' => 5200,
				'label' => 'left top, x% y%, xpos ypos (px)',
				'placeholder' => __('Position','backgrounds')
			)
		)
	);
}
endif;

if ( ! function_exists( 'generate_backgrounds_customize_preview_css' ) ) :
/**
 * Add our CSS for the Customizer options
 * @since 0.1
 */
add_action('customize_controls_print_styles', 'generate_backgrounds_customize_preview_css');
function generate_backgrounds_customize_preview_css() {

	?>
	<style>
		#accordion-section-backgrounds_section li {float:left;width:45%;clear:none;}
		#accordion-section-backgrounds_section li.customize-control-backgrounds-heading,
		#accordion-section-backgrounds_section li.customize-control-position,
		#accordion-section-backgrounds_section li.customize-control-line		{display:block;width:100%;clear:both;text-align:center;}
		#accordion-section-backgrounds_section .generate-upload .remove {font-size:10px;display: inline;}
		#accordion-section-backgrounds_section li.customize-control-position .small-customize-label {display:block;text-align:center;}
		
		#accordion-section-backgrounds_section .customize-section-description-container {
			width: 100%;
			float: none;
		}
		
		#customize-control-generate_backgrounds-header,
		#customize-control-generate_backgrounds-header-heading,
		#customize-control-generate_backgrounds-nav-heading,
		#customize-control-generate_backgrounds-sub-nav-item-heading,
		#customize-control-generate_backgrounds-content-heading,
		#customize-control-generate_backgrounds-sidebar-widget-heading,
		#customize-control-generate_backgrounds-footer-widget-heading {
			border: 0;
			padding: 0;
			margin-top: 0;
		}
		
		#accordion-section-generate_backgrounds_navigation .customize-control-select:not(#customize-control-generate_background_settings-nav_item_current_repeat),
		#accordion-section-generate_backgrounds_subnavigation .customize-control-select:not(#customize-control-generate_background_settings-sub_nav_item_current_repeat),
		#accordion-section-secondary_bg_images_section .customize-control-select:not(#customize-control-generate_secondary_nav_settings-nav_item_current_repeat),
		#accordion-section-secondary_subnav_bg_images_section .customize-control-select:not(#customize-control-generate_secondary_nav_settings-sub_nav_item_current_repeat),
		#customize-control-generate_background_settings-footer_widget_position {
			border-bottom: 1px solid #ccc;
			padding-bottom: 20px;
		}
	</style>
	<?php
}
endif;

/**
 * Include our CSS class
 */
require plugin_dir_path( __FILE__ ) . 'css.php';

if ( !function_exists( 'generate_backgrounds_css' ) ) :
/**
 * Generate the CSS in the <head> section using the Theme Customizer
 * @since 0.1
 */
function generate_backgrounds_css()
{
	
	$generate_settings = wp_parse_args( 
		get_option( 'generate_background_settings', array() ), 
		generate_get_background_defaults() 
	);
	
	// Initiate our CSS class
	$css = new GeneratePress_Backgrounds_CSS;
	
	// Body
	$css->set_selector( 'body' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'body_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'body_repeat' ] ) );
	$css->add_property( 'background-size', esc_attr( $generate_settings[ 'body_size' ] ) );
	$css->add_property( 'background-attachment', esc_attr( $generate_settings[ 'body_attachment' ] ) );
	$css->add_property( 'background-position', esc_attr( $generate_settings[ 'body_position' ] ) );
	
	// Top bar
	if ( is_active_sidebar( 'top-bar' ) ) {
		$css->set_selector( '.top-bar' );
		$css->add_property( 'background-image', esc_url( $generate_settings[ 'top_bar_image' ] ), 'url' );
		$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'top_bar_repeat' ] ) );
		$css->add_property( 'background-size', esc_attr( $generate_settings[ 'top_bar_size' ] ) );
		$css->add_property( 'background-attachment', esc_attr( $generate_settings[ 'top_bar_attachment' ] ) );
		$css->add_property( 'background-position', esc_attr( $generate_settings[ 'top_bar_position' ] ) );
	}
	
	// Header
	$css->set_selector( '.site-header' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'header_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'header_repeat' ] ) );
	$css->add_property( 'background-size', esc_attr( $generate_settings[ 'header_size' ] ) );
	$css->add_property( 'background-attachment', esc_attr( $generate_settings[ 'header_attachment' ] ) );
	$css->add_property( 'background-position', esc_attr( $generate_settings[ 'header_position' ] ) );
	
	// Navigation background
	$css->set_selector( '.main-navigation,.menu-toggle' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'nav_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'nav_repeat' ] ) );
	
	// Navigation item background
	$css->set_selector( '.main-navigation .main-nav > ul > li > a' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'nav_item_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'nav_item_repeat' ] ) );
	
	// Navigation background/text on hover
	$css->set_selector( '.main-navigation .main-nav > ul > li > a:hover,.main-navigation .main-nav > ul > li.sfHover > a' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'nav_item_hover_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'nav_item_hover_repeat' ] ) );
	
	// Navigation background/text current
	$css->set_selector( '.main-navigation .main-nav > ul > li[class*="current-menu-"] > a,.main-navigation .main-nav > ul > li[class*="current-menu-"] > a:hover,.main-navigation .main-nav > ul > li[class*="current-menu-"].sfHover > a' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'nav_item_current_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'nav_item_current_repeat' ] ) );
	
	// Sub-Navigation text
	$css->set_selector( '.main-navigation ul ul li a' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'sub_nav_item_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'sub_nav_item_repeat' ] ) );
	
	// Sub-Navigation background/text on hover
	$css->set_selector( '.main-navigation ul ul li > a:hover,.main-navigation ul ul li.sfHover > a' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'sub_nav_item_hover_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'sub_nav_item_hover_repeat' ] ) );
	
	// Sub-Navigation background / text current
	$css->set_selector( '.main-navigation ul ul li[class*="current-menu-"] > a,.main-navigation ul ul li[class*="current-menu-"] > a:hover,.main-navigation ul ul li[class*="current-menu-"].sfHover > a' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'sub_nav_item_current_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'sub_nav_item_current_repeat' ] ) );
	
	// Content
	$css->set_selector( '.separate-containers .inside-article,.separate-containers .comments-area,.separate-containers .page-header,.one-container .container,.separate-containers .paging-navigation,.separate-containers .inside-page-header' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'content_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'content_repeat' ] ) );
	$css->add_property( 'background-size', esc_attr( $generate_settings[ 'content_size' ] ) );
	$css->add_property( 'background-attachment', esc_attr( $generate_settings[ 'content_attachment' ] ) );
	$css->add_property( 'background-position', esc_attr( $generate_settings[ 'content_position' ] ) );
	
	// Sidebar widget
	$css->set_selector( '.sidebar .widget' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'sidebar_widget_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'sidebar_widget_repeat' ] ) );
	$css->add_property( 'background-size', esc_attr( $generate_settings[ 'sidebar_widget_size' ] ) );
	$css->add_property( 'background-attachment', esc_attr( $generate_settings[ 'sidebar_widget_attachment' ] ) );
	$css->add_property( 'background-position', esc_attr( $generate_settings[ 'sidebar_widget_position' ] ) );
	
	// Footer widget
	$css->set_selector( '.footer-widgets' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'footer_widget_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'footer_widget_repeat' ] ) );
	$css->add_property( 'background-size', esc_attr( $generate_settings[ 'footer_widget_size' ] ) );
	$css->add_property( 'background-attachment', esc_attr( $generate_settings[ 'footer_widget_attachment' ] ) );
	$css->add_property( 'background-position', esc_attr( $generate_settings[ 'footer_widget_position' ] ) );
	
	// Footer
	$css->set_selector( '.site-info' );
	$css->add_property( 'background-image', esc_url( $generate_settings[ 'footer_image' ] ), 'url' );
	$css->add_property( 'background-repeat', esc_attr( $generate_settings[ 'footer_repeat' ] ) );
	$css->add_property( 'background-size', esc_attr( $generate_settings[ 'footer_size' ] ) );
	$css->add_property( 'background-attachment', esc_attr( $generate_settings[ 'footer_attachment' ] ) );
	$css->add_property( 'background-position', esc_attr( $generate_settings[ 'footer_position' ] ) );
	
	// Return our dynamic CSS
	return apply_filters( 'generate_backgrounds_css_output', $css->css_output() );
}
endif;

if ( ! function_exists( 'generate_background_scripts' ) ) :
/**
 * Enqueue scripts and styles
 * @since 0.1
 */
add_action( 'wp_enqueue_scripts', 'generate_background_scripts', 70 );
function generate_background_scripts() {

	wp_add_inline_style( 'generate-style', generate_backgrounds_css() );

}
endif;

if ( ! function_exists( 'generate_backgrounds_sanitize_choices' ) ) :
/**
 * Sanitize choices
 */
function generate_backgrounds_sanitize_choices( $input, $setting ) {
	
	// Ensure input is a slug
	$input = sanitize_text_field( $input );
	
	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
endif;

if ( ! function_exists( 'generate_backgrounds_is_top_bar_active' ) ) :
/**
 * Check to see if the top bar is active
 *
 * @since 1.3.45
 */
function generate_backgrounds_is_top_bar_active()
{
	$top_bar = is_active_sidebar( 'top-bar' ) ? true : false;
	return apply_filters( 'generate_is_top_bar_active', $top_bar );
}
endif;