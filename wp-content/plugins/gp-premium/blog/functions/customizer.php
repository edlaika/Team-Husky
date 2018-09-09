<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_blog_customize_register' ) ) :
add_action( 'customize_register', 'generate_blog_customize_register', 99 );
function generate_blog_customize_register( $wp_customize ) 
{
	// Get our defaults
	$defaults = generate_blog_get_defaults();
	
	// Get our controls
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'controls.php';
	
	// Add our blog panel
	if ( class_exists( 'WP_Customize_Panel' ) ) {
		$wp_customize->add_panel( 'generate_blog_panel', array(
			'priority'       => 35,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Blog','generate-blog' ),
			'description'    => ''
		) );
		
		// Move our single blog section (free theme) into our new panel
		if ( $wp_customize->get_control( 'blog_content_control' ) ) {
			$wp_customize->get_control( 'blog_content_control'  )->section   = 'blog_content_section';
			$wp_customize->get_control( 'blog_content_control'  )->priority   = 1;
		}
	}
	
	// Register our custom controls
	if ( method_exists( $wp_customize,'register_control_type' ) ) {
		$wp_customize->register_control_type( 'Generate_Blog_Customize_Control' );
		$wp_customize->register_control_type( 'Generate_Blog_Number_Customize_Control' );
		$wp_customize->register_control_type( 'Generate_Post_Image_Save' );
		$wp_customize->register_control_type( 'Generate_Blog_Text_Control' );
	}
	
	// Blog content section
	$wp_customize->add_section(
		'blog_content_section',
		array(
			'title' => __( 'Blog Content', 'generate-blog' ),
			'capability' => 'edit_theme_options',
			'priority' => 10,
			'panel' => 'generate_blog_panel'
		)
	);
	
	// Excerpt length
	$wp_customize->add_setting(
		'generate_blog_settings[excerpt_length]', array(
			'default' => $defaults['excerpt_length'],
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'sanitize_callback' => 'absint'
		)
	);
	
	$wp_customize->add_control(
		new Generate_Blog_Number_Customize_Control(
			$wp_customize,
			'blog_excerpt_length_control', array(
				'label' => __('Excerpt Length', 'generate-blog'),
				'section' => 'blog_content_section',
				'settings' => 'generate_blog_settings[excerpt_length]',
				'priority' => 10,
				'active_callback' => 'generate_blog_is_excerpt',
				'type' => 'gp-blog-number'
			)
		)
	);
	
	// Read more text
	$wp_customize->add_setting(
		'generate_blog_settings[read_more]', array(
			'default' => $defaults['read_more'],
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'sanitize_callback' => 'wp_kses_post'
		)
	);
		 
	$wp_customize->add_control(
		'blog_excerpt_more_control', array(
			'label' => __('Read more label', 'generate-blog'),
			'section' => 'blog_content_section',
			'settings' => 'generate_blog_settings[read_more]',
			'priority' => 20
		)
	);
	
	// Masonry section
	$wp_customize->add_section(
		'blog_masonry_section',
		array(
			'title' => __( 'Masonry', 'generate-blog' ),
			'capability' => 'edit_theme_options',
			'priority' => 20,
			'panel' => 'generate_blog_panel'
		)
	);
	
	// Enable masonry
	$wp_customize->add_setting(
		'generate_blog_settings[masonry]',
		array(
			'default' => $defaults['masonry'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[masonry]',
		array(
			'type' => 'select',
			'label' => __( 'Masonry', 'generate-blog' ),
			'section' => 'blog_masonry_section',
			'choices' => array(
				'true' => __( 'Enable', 'generate-blog' ),
				'false' => __( 'Disable', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[masonry]',
			'priority' => 30
		)
	);
	
	// Masonry width
	$wp_customize->add_setting(
		'generate_blog_settings[masonry_width]',
		array(
			'default' => $defaults['masonry_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[masonry_width]',
		array(
			'type' => 'select',
			'label' => __( 'Masonry Block Width', 'generate-blog' ),
			'section' => 'blog_masonry_section',
			'choices' => array(
				'width2' => __( 'Small', 'generate-blog' ),
				'width4' => __( 'Medium', 'generate-blog' ),
				'width6' => __( 'Large', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[masonry_width]',
			'priority' => 35
		)
	);
	
	// Most recent post width
	$wp_customize->add_setting(
		'generate_blog_settings[masonry_most_recent_width]',
		array(
			'default' => $defaults['masonry_most_recent_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);

	$wp_customize->add_control(
		'generate_blog_settings[masonry_most_recent_width]',
		array(
			'type' => 'select',
			'label' => __( 'Masonry Most Recent Width', 'generate-blog' ),
			'section' => 'blog_masonry_section',
			'choices' => array(
				'width2' => __( 'Small', 'generate-blog' ),
				'width4' => __( 'Medium', 'generate-blog' ),
				'width6' => __( 'Large', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[masonry_most_recent_width]',
			'priority' => 36
		)
	);
	
	// Load more text
	$wp_customize->add_setting(
		'generate_blog_settings[masonry_load_more]', array(
			'default' => $defaults['masonry_load_more'],
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'sanitize_callback' => 'wp_kses_post'
		)
	);
		 
	$wp_customize->add_control(
		'blog_masonry_load_more_control', array(
			'label' => __('Masonry Load More Text', 'generate-blog'),
			'section' => 'blog_masonry_section',
			'settings' => 'generate_blog_settings[masonry_load_more]',
			'priority' => 40
		)
	);
	
	// Loading text
	$wp_customize->add_setting(
		'generate_blog_settings[masonry_loading]', array(
			'default' => $defaults['masonry_loading'],
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'sanitize_callback' => 'wp_kses_post'
		)
	);
		 
	$wp_customize->add_control(
		'blog_masonry_loading_control', array(
			'label' => __('Masonry Loading Text', 'generate-blog'),
			'section' => 'blog_masonry_section',
			'settings' => 'generate_blog_settings[masonry_loading]',
			'priority' => 50
		)
	);
	
	// Featured image section
	$wp_customize->add_section(
		'blog_post_image_section',
		array(
			'title' => __( 'Featured Images', 'generate-blog' ),
			'capability' => 'edit_theme_options',
			'priority' => 30,
			'panel' => 'generate_blog_panel'
		)
	);
	
	// Show featured images
	$wp_customize->add_setting(
		'generate_blog_settings[post_image]',
		array(
			'default' => $defaults['post_image'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[post_image]',
		array(
			'type' => 'select',
			'label' => __( 'Featured Image', 'generate-blog' ),
			'section' => 'blog_post_image_section',
			'choices' => array(
				'true' => __( 'Show', 'generate-blog' ),
				'false' => __( 'Hide', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[post_image]',
			'priority' => 60
		)
	);
	
	// Location
	$wp_customize->add_setting(
		'generate_blog_settings[post_image_position]',
		array(
			'default' => $defaults['post_image_position'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[post_image_position]',
		array(
			'type' => 'select',
			'label' => __( 'Location', 'generate-blog' ),
			'section' => 'blog_post_image_section',
			'choices' => array(
				'' => __( 'Below Title', 'generate-blog' ),
				'post-image-above-header' => __( 'Above Title', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[post_image_position]',
			'priority' => 65
		)
	);
	
	// Alignment
	$wp_customize->add_setting(
		'generate_blog_settings[post_image_alignment]',
		array(
			'default' => $defaults['post_image_alignment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[post_image_alignment]',
		array(
			'type' => 'select',
			'label' => __( 'Alignment', 'generate-blog' ),
			'section' => 'blog_post_image_section',
			'choices' => array(
				'post-image-aligned-center' => __( 'Center', 'generate-blog' ),
				'post-image-aligned-left' => __( 'Left', 'generate-blog' ),
				'post-image-aligned-right' => __( 'Right', 'generate-blog' ),
			),
			'settings' => 'generate_blog_settings[post_image_alignment]',
			'priority' => 66
		)
	);
	
	// Width
	$wp_customize->add_setting(
		'generate_blog_settings[post_image_width]', array(
			'default' => $defaults['post_image_width'],
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
		 
	$wp_customize->add_control(
		new Generate_Blog_Customize_Control(
			$wp_customize,
			'post_image_width_control', array(
				'label' => __('Width', 'generate-blog'),
				'section' => 'blog_post_image_section',
				'settings' => 'generate_blog_settings[post_image_width]',
				'priority' => 67,
				'placeholder' => __('Auto','generate-blog'),
				'type' => 'gp-post-image-size'
			)
		)
	);
	
	// Height
	$wp_customize->add_setting(
		'generate_blog_settings[post_image_height]', array(
			'default' => $defaults['post_image_height'],
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
		 
	$wp_customize->add_control(
		new Generate_Blog_Customize_Control(
			$wp_customize,
			'post_image_height_control', array(
				'label' => __('Height', 'generate-blog'),
				'section' => 'blog_post_image_section',
				'settings' => 'generate_blog_settings[post_image_height]',
				'priority' => 68,
				'placeholder' => __('Auto','generate-blog'),
				'type' => 'gp-post-image-size'
			)
		)
	);
	
	// Save dimensions
	$wp_customize->add_control(
		new Generate_Post_Image_Save(
			$wp_customize,
			'post_image_apply_sizes',
			array(
				'section'     => 'blog_post_image_section',
				'label'			=> false,
				'priority'    => 69,
				'type' => 'post_image_save',
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
			)
		)
	);
	
	// Post date
	$wp_customize->add_setting(
		'generate_blog_settings[date]',
		array(
			'default' => $defaults['date'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[date]',
		array(
			'type' => 'select',
			'label' => __( 'Date', 'generate-blog' ),
			'section' => 'blog_content_section',
			'choices' => array(
				'true' => __( 'Show', 'generate-blog' ),
				'false' => __( 'Hide', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[date]',
			'priority' => 70
		)
	);
	
	// Post author
	$wp_customize->add_setting(
		'generate_blog_settings[author]',
		array(
			'default' => $defaults['author'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[author]',
		array(
			'type' => 'select',
			'label' => __( 'Author', 'generate-blog' ),
			'section' => 'blog_content_section',
			'choices' => array(
				'true' => __( 'Show', 'generate-blog' ),
				'false' => __( 'Hide', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[author]',
			'priority' => 80
		)
	);
	
	// Category links
	$wp_customize->add_setting(
		'generate_blog_settings[categories]',
		array(
			'default' => $defaults['categories'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[categories]',
		array(
			'type' => 'select',
			'label' => __( 'Categories', 'generate-blog' ),
			'section' => 'blog_content_section',
			'choices' => array(
				'true' => __( 'Show', 'generate-blog' ),
				'false' => __( 'Hide', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[categories]',
			'priority' => 90
		)
	);
	
	// Tag links
	$wp_customize->add_setting(
		'generate_blog_settings[tags]',
		array(
			'default' => $defaults['tags'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[tags]',
		array(
			'type' => 'select',
			'label' => __( 'Tags', 'generate-blog' ),
			'section' => 'blog_content_section',
			'choices' => array(
				'true' => __( 'Show', 'generate-blog' ),
				'false' => __( 'Hide', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[tags]',
			'priority' => 95
		)
	);
	
	// Comment link
	$wp_customize->add_setting(
		'generate_blog_settings[comments]',
		array(
			'default' => $defaults['comments'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[comments]',
		array(
			'type' => 'select',
			'label' => __( 'Comment Link', 'generate-blog' ),
			'section' => 'blog_content_section',
			'choices' => array(
				'true' => __( 'Show', 'generate-blog' ),
				'false' => __( 'Hide', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[comments]',
			'priority' => 100
		)
	);
	
	// Columns section
	$wp_customize->add_section(
		'blog_columns_section',
		array(
			'title' => __( 'Columns', 'generate-blog' ),
			'capability' => 'edit_theme_options',
			'priority' => 10,
			'panel' => 'generate_blog_panel'
		)
	);
	
	// If masonry is enabled, tell them these options won't work
	if ( class_exists( 'Generate_Blog_Text_Control' ) ) {
		$wp_customize->add_control(
			new Generate_Blog_Text_Control(
				$wp_customize,
				'columns_masonry_note',
				array(
					'section'     => 'blog_columns_section',
					'type'        => 'blog_text',
					'description' => __( 'Masonry is enabled. These settings will be ignored.','generate-blog' ),
					'priority'    => 0,
					'active_callback' => 'generate_masonry_callback',
					'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
				)
			)
		);
	}
	
	// Enable columns
	$wp_customize->add_setting(
		'generate_blog_settings[column_layout]',
		array(
			'default' => $defaults['column_layout'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[column_layout]',
		array(
			'type' => 'select',
			'label' => __( 'Column Layout', 'generate-blog' ),
			'section' => 'blog_columns_section',
			'choices' => array(
				1 => __( 'Enable', 'generate-blog' ),
				0 => __( 'Disable', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[column_layout]',
			'priority' => 20
		)
	);
	
	// Column count class
	$wp_customize->add_setting(
		'generate_blog_settings[columns]',
		array(
			'default' => $defaults['columns'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[columns]',
		array(
			'type' => 'select',
			'label' => __( 'Columns', 'generate-blog' ),
			'section' => 'blog_columns_section',
			'choices' => array(
				'50' => '2',
				'33' => '3',
				'25' => '4',
				'20' => '5'
			),
			'settings' => 'generate_blog_settings[columns]',
			'priority' => 25
		)
	);
	
	// Featured column
	$wp_customize->add_setting(
		'generate_blog_settings[featured_column]',
		array(
			'default' => $defaults['featured_column'],
			'type' => 'option',
			'sanitize_callback' => 'generate_blog_sanitize_choices'
		)
	);
	
	$wp_customize->add_control(
		'generate_blog_settings[featured_column]',
		array(
			'type' => 'select',
			'label' => __( 'First Post Full Width', 'generate-blog' ),
			'section' => 'blog_columns_section',
			'choices' => array(
				1 => __( 'Enable', 'generate-blog' ),
				0 => __( 'Disable', 'generate-blog' )
			),
			'settings' => 'generate_blog_settings[featured_column]',
			'priority' => 30
		)
	);
}
endif;

if ( ! function_exists( 'generate_masonry_callback' ) ) :
/**
 * Check to see if masonry is activated
 */
function generate_masonry_callback()
{
	$generate_blog_settings = wp_parse_args( 
		get_option( 'generate_blog_settings', array() ), 
		generate_blog_get_defaults() 
	);
	
	// If masonry is enabled, set to true
	return ( 'true' == $generate_blog_settings['masonry'] ) ? true : false;

}
endif;

if ( ! function_exists( 'generate_blog_sanitize_choices' ) ) :
/**
 * Sanitize choices
 */
function generate_blog_sanitize_choices( $input, $setting ) {
	
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

if ( ! function_exists( 'generate_blog_is_posts_page' ) ) :
/**
 * Check to see if we're on a posts page
 */
function generate_blog_is_posts_page()
{
	$blog = ( is_home() || is_archive() || is_attachment() || is_tax() ) ? true : false;
	
	return $blog;
}
endif;

if ( ! function_exists( 'generate_blog_is_posts_page_single' ) ) :
/**
 * Check to see if we're on a posts page or a single post
 */
function generate_blog_is_posts_page_single()
{
	$blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;
	
	return $blog;
}
endif;

if ( ! function_exists( 'generate_blog_is_excerpt' ) ) :
/**
 * Check to see if we're displaying excerpts
 */
function generate_blog_is_excerpt()
{
	if ( ! function_exists( 'generate_get_defaults' ) )
		return;
	
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	return ( 'excerpt' == $generate_settings['post_content'] ) ? true : false;
}
endif;

if ( ! function_exists( 'generate_blog_customizer_live_preview' ) ) :
/**
 * Add our live preview javascript
 */
add_action( 'customize_preview_init', 'generate_blog_customizer_live_preview' );
function generate_blog_customizer_live_preview()
{
	wp_enqueue_script( 
		  'generate-blog-themecustomizer',
		  plugin_dir_url( __FILE__ ) . '/js/customizer.js',
		  array( 'jquery','customize-preview' ),
		  GENERATE_BLOG_VERSION,
		  true
	);
}
endif;