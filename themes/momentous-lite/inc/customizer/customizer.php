<?php
/**
 * Implement Theme Customizer
 *
 */

// Load Customizer Helper Functions
require( get_template_directory() . '/inc/customizer/functions/custom-controls.php' );
require( get_template_directory() . '/inc/customizer/functions/sanitize-functions.php' );

// Load Customizer Sections
require( get_template_directory() . '/inc/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-header.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-upgrade.php' );

// Add Theme Options section to Customizer
add_action( 'customize_register', 'momentous_customize_register_options' );

function momentous_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel
	$wp_customize->add_panel( 'momentous_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'momentous-lite' ),
		'description'    => '',
	) );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	// Change default background section
	$wp_customize->get_control( 'background_color'  )->section   = 'background_image';
	$wp_customize->get_section( 'background_image'  )->title     = esc_html__( 'Background', 'momentous-lite' );
	
	// Add Display Site Title Setting
	$wp_customize->add_setting( 'momentous_theme_options[site_title]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'momentous_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'momentous_theme_options[site_title]', array(
        'label'    => esc_html__( 'Display Site Title', 'momentous-lite' ),
        'section'  => 'title_tagline',
        'settings' => 'momentous_theme_options[site_title]',
        'type'     => 'checkbox',
		'priority' => 10
		)
	);
	
	// Add Header Tagline option
	$wp_customize->add_setting( 'momentous_theme_options[header_tagline]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'momentous_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'momentous_control_header_tagline', array(
        'label'    => esc_html__( 'Display Tagline below site title.', 'momentous-lite' ),
        'section'  => 'title_tagline',
        'settings' => 'momentous_theme_options[header_tagline]',
        'type'     => 'checkbox',
		'priority' => 11
		)
	);
	
	// Add Header Image Link
	$wp_customize->add_setting( 'momentous_theme_options[custom_header_link]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_url'
		)
	);
    $wp_customize->add_control( 'momentous_control_custom_header_link', array(
        'label'    => esc_html__( 'Header Image Link', 'momentous-lite' ),
        'section'  => 'header_image',
        'settings' => 'momentous_theme_options[custom_header_link]',
        'type'     => 'url',
		'priority' => 10
		)
	);
	
	// Add Custom Header Hide Checkbox
	$wp_customize->add_setting( 'momentous_theme_options[custom_header_hide]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'momentous_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'momentous_control_custom_header_hide', array(
        'label'    => esc_html__( 'Hide header image on front page', 'momentous-lite' ),
        'section'  => 'header_image',
        'settings' => 'momentous_theme_options[custom_header_hide]',
        'type'     => 'checkbox',
		'priority' => 15
		)
	);
	
}


// Embed JS file to make Theme Customizer preview reload changes asynchronously.
add_action( 'customize_preview_init', 'momentous_customize_preview_js' );

function momentous_customize_preview_js() {
	wp_enqueue_script( 'momentous-lite-customizer-preview', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151202', true );
}


// Embed JS file for Customizer Controls
add_action( 'customize_controls_enqueue_scripts', 'momentous_customize_controls_js' );

function momentous_customize_controls_js() {
	
	wp_enqueue_script( 'momentous-lite-customizer-controls', get_template_directory_uri() . '/js/customizer-controls.js', array(), '20151202', true );
	
	// Localize the script
	wp_localize_script( 'momentous-lite-customizer-controls', 'momentous_theme_links', array(
		'title'	=> esc_html__( 'Theme Links', 'momentous-lite' ),
		'themeURL'	=> esc_url( __( 'https://themezee.com/themes/momentous/', 'momentous-lite' ) . '?utm_source=customizer&utm_medium=textlink&utm_campaign=momentous&utm_content=theme-page' ),
		'themeLabel'	=> esc_html__( 'Theme Page', 'momentous-lite' ),
		'docuURL'	=> esc_url( __( 'https://themezee.com/docs/momentous-documentation/', 'momentous-lite' ) . '?utm_source=customizer&utm_medium=textlink&utm_campaign=momentous&utm_content=documentation' ),
		'docuLabel'	=>  esc_html__( 'Theme Documentation', 'momentous-lite' ),
		'rateURL'	=> esc_url( 'http://wordpress.org/support/view/theme-reviews/momentous-lite?filter=5' ),
		'rateLabel'	=> esc_html__( 'Rate this theme', 'momentous-lite' ),
		)
	);

}


// Embed CSS styles for Theme Customizer
add_action( 'customize_controls_print_styles', 'momentous_customize_preview_css' );

function momentous_customize_preview_css() {
	wp_enqueue_style( 'momentous-lite-customizer-css', get_template_directory_uri() . '/css/customizer.css', array(), '20151202' );

}