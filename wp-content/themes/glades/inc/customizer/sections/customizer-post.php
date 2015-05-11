<?php
/**
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'glades_customize_register_post_settings' );

function glades_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'glades_section_post', array(
        'title'    => __( 'Post Settings', 'glades' ),
        'priority' => 30,
		'panel' => 'glades_options_panel' 
		)
	);

	// Add Settings and Controls for Posts
	$wp_customize->add_setting( 'glades_theme_options[posts_length]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_post_length'
		)
	);
    $wp_customize->add_control( 'glades_control_posts_length', array(
        'label'    => __( 'Post Length on archives', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[posts_length]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'index' => __( 'Show full posts', 'glades' ),
            'excerpt' => __( 'Show post summaries (excerpt)', 'glades' )
			)
		)
	);
	
	// Add Post Images Headline
	$wp_customize->add_setting( 'glades_theme_options[post_images]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Header_Control(
        $wp_customize, 'glades_control_post_images', array(
            'label' => __( 'Post Images', 'glades' ),
            'section' => 'glades_section_post',
            'settings' => 'glades_theme_options[post_images]',
            'priority' => 	2
            )
        )
    );
	$wp_customize->add_setting( 'glades_theme_options[post_thumbnails_index]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_posts_thumbnails_index', array(
        'label'    => __( 'Display featured images on archive pages', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[post_thumbnails_index]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);

	$wp_customize->add_setting( 'glades_theme_options[post_thumbnails_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_posts_thumbnails_single', array(
        'label'    => __( 'Display featured images on single posts', 'glades' ),
        'section'  => 'glades_section_post',
        'settings' => 'glades_theme_options[post_thumbnails_single]',
        'type'     => 'checkbox',
		'priority' => 4
		)
	);

}

?>