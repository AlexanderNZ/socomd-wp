<?php
/**
 * -----------------------------------
 * Customization - Theme Customization
 * -----------------------------------
 */
add_action( 'customize_register' , 'alpona_theme_options' );

function alpona_theme_options( $wp_customize ) {
/* Default values */
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

/**
 * --------------------------
 * Customization - Main color
 * --------------------------
 */
	$wp_customize->add_section( 'colors', array(
		'title'          => __( 'Colors', 'alpona' ),
		'priority'       => 40,

	) );
	
	/* Header Background */
	$wp_customize->add_setting( 'header_color',
		array(
			'default' 			=> '#FAFAFA',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'headercolor',
		array(
			'label'    => __( 'Header background', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'header_color',
			'priority' => 10,
		) 
	));
	
	/* Top Navbar link hover background */
	$wp_customize->add_setting( 'topnavbghover_color',
		array(
			'default' 			=> '#EDEDED',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'topnavbghovercolor',
		array(
			'label'    => __( 'Top menu Hover background', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'topnavbghover_color',
			'priority' => 10,
		) 
	));
	
	/* Top Navbar text hover background */
	$wp_customize->add_setting( 'topnavtxthover_color',
		array(
			'default' 			=> '#444444',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'topnavtxthovercolor',
		array(
			'label'    => __( 'Top menu Hover Text color', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'topnavtxthover_color',
			'priority' => 10,
		) 
	));
	
	/* Top Navbar link color */
	$wp_customize->add_setting( 'topnavcol_color',
		array(
			'default' 			=> '#444444',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'topnavcolcolor',
		array(
			'label'    => __( 'Top menu Link color', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'topnavcol_color',
			'priority' => 10,
		) 
	));
	
	/* Sticky Background */
	$wp_customize->add_setting( 'sticky_color',
		array(
			'default' 			=> '#FAFAFA',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'stickycolor',
		array(
			'label'    => __( 'Sticky Background', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'sticky_color',
			'priority' => 10,
		) 
	));
	
	/* Main post color */
	$wp_customize->add_setting( 'main_post',
		array(
			'default' 			=> '#FAFAFA',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'mainpost',
		array(
			'label'    => __( 'Post Area Background', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'main_post',
			'priority' => 10,
		) 
	));
	
	/* Sidebar Background */
	$wp_customize->add_setting( 'sidebar_color',
		array(
			'default' 			=> '#FAFAFA',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'sidebarcolor',
		array(
			'label'    => __( 'Sidebar background', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'sidebar_color',
			'priority' => 10,
		) 
	));
	
	/* Text color */
	$wp_customize->add_setting( 'post_txt_color',
		array(
			'default' 			=> '#444444',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'posttxtcolor',
		array(
			'label'    => __( 'Text color', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'post_txt_color',
			'priority' => 10,
		) 
	));
	
	/* Link color */
	$wp_customize->add_setting( 'post_lnk_color',
		array(
			'default' 			=> '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'postlnkcolor',
		array(
			'label'    => __( 'Link color', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'post_lnk_color',
			'priority' => 10,
		) 
	));
	
	/* Footer Background */
	$wp_customize->add_setting( 'footer_color',
		array(
			'default' 			=> '#EDEDED',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'footercolor',
		array(
			'label'    => __( 'Footer background', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'footer_color',
			'priority' => 10,
		) 
	));
	
	/* Footer Text color */
	$wp_customize->add_setting( 'foot_txt_color',
		array(
			'default' 			=> '#444444',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'foottxtcolor',
		array(
			'label'    => __( 'Footer Text color', 'alpona' ), 
			'section'  => 'colors',
			'settings' => 'foot_txt_color',
			'priority' => 10,
		) 
	));

/**
 * ----------------------------
 * Customization - Header Image
 * ----------------------------
 */
	$wp_customize->add_section( 'header_image', array(
		 'title'          => __( 'Header Image', 'alpona' ),
		 'theme_supports' => 'custom-header',
		 'priority'       => 60,
	));

	/* Header image */
	$wp_customize->add_setting( 'head_image',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);
}

/* Change the value */
add_action( 'wp_head' , 'alpona_dynamic_css' );

function alpona_dynamic_css() {
	?>
	<style type='text/css'>
	.main-bg {
		background-color: <?php echo esc_attr(get_theme_mod('main_post')); ?> ;
	}
	.widget {
		background-color: <?php echo esc_attr(get_theme_mod('sidebar_color')); ?> ;
	}
	#main-header {
		background-color: <?php echo esc_attr(get_theme_mod('header_color')); ?> ;
	}
	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('footer_color')); ?> ;
	}
	.top-menu li a {
		color: <?php echo esc_attr(get_theme_mod('topnavcol_color')); ?> ;
	}
	.top-menu {
		background-color: <?php echo esc_attr(get_theme_mod('header_color')); ?> ;
	}
	.menu-top li a:hover {
		background-color: <?php echo esc_attr(get_theme_mod('topnavbghover_color')); ?> ;
		color: <?php echo esc_attr(get_theme_mod('topnavtxthover_color')); ?> ;
		transition: background-color 0.5s ease 0s;
	}
	.menu-top li:hover {
		background-color: <?php echo esc_attr(get_theme_mod('topnavbghover_color')); ?> ;
	}
	.menu-top li ul {
		background-color: <?php echo esc_attr(get_theme_mod('topnavbghover_color')); ?> ;
	}
	.menu-top li ul li a:hover {
		background-color: <?php echo esc_attr(get_theme_mod('header_color')); ?> ;
	}
	.menu-top ul li a:hover {
		background-color: <?php echo esc_attr(get_theme_mod('topnavbghover_color')); ?> ;
		color: <?php echo esc_attr(get_theme_mod('topnavtxthover_color')); ?> ;
		transition: background-color 0.5s ease 0s;
	}
	p {
		color: <?php echo esc_attr(get_theme_mod('post_txt_color')); ?> ;
	}
	a {
		color: <?php echo esc_attr(get_theme_mod('post_lnk_color')); ?> ;
	}
	#footer p, #footer a {
		color: <?php echo esc_attr(get_theme_mod('foot_txt_color')); ?> ;
	}
	.sticky, .featured {
		background-color: <?php echo esc_attr(get_theme_mod('sticky_color')); ?> ;
	}
	.site-title, .site-desc{
		color: #<?php echo esc_attr(get_header_textcolor()); ?>;
	}
	</style>
	<?php
}
?>