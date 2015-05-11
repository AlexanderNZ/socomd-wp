<?php
/**
 * Register General section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'glades_customize_register_general_settings' );

function glades_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'glades_section_general', array(
        'title'    => __( 'General Settings', 'glades' ),
        'priority' => 10,
		'panel' => 'glades_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'glades_theme_options[layout]', array(
        'default'           => 'wide',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_layout'
		)
	);
    $wp_customize->add_control( 'glades_control_layout', array(
        'label'    => __( 'Site Layout', 'glades' ),
        'section'  => 'glades_section_general',
        'settings' => 'glades_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'wide' => __( 'Wide Layout (default)', 'glades' ),
			'boxed' => __( 'Boxed Layout', 'glades' )
			)
		)
	);
	
	// Add Settings and Controls for Sidebar
	$wp_customize->add_setting( 'glades_theme_options[sidebar]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_sidebar'
		)
	);
    $wp_customize->add_control( 'glades_control_sidebar', array(
        'label'    => __( 'Sidebar', 'glades' ),
        'section'  => 'glades_section_general',
        'settings' => 'glades_theme_options[sidebar]',
        'type'     => 'radio',
		'priority' => 2,
        'choices'  => array(
            'left-sidebar' => __( 'Left Sidebar', 'glades' ),
            'right-sidebar' => __( 'Right Sidebar', 'glades')
			)
		)
	);
	
	// Add Footer Settings
	$wp_customize->add_setting( 'glades_theme_options[footer_text]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_footer_text'
		)
	);
    $wp_customize->add_control( 'glades_control_footer_text', array(
        'label'    => __( 'Footer Text', 'glades' ),
        'section'  => 'glades_section_general',
        'settings' => 'glades_theme_options[footer_text]',
        'type'     => 'textarea',
		'priority' => 3
		)
	);
	
}

?>