<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Alpona
 * @since Alpona 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <!-- Start Main Wrapper Here -->
	<header id="main-header" class="row fix">
        <div class="wrapper">
            <div class="sitename">
                <h1><a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <p class="site-desc"><?php bloginfo('description'); ?></p>
            </div>
        </div> <!-- End wrapper -->
    </header> <!-- Header -->
	<?php if (get_header_image() != '') { ?>
	<div class="banner-img">
	<img class="img-responsive wrapper" src="<?php header_image(); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="<?php _e('banner', 'alpona'); ?>" />
	</div> <!-- Banner End -->
	<?php } ?>
	<div class="wrapper">
		<nav class="top-menu">
			<?php
				if(has_nav_menu('top-menu')){
					wp_nav_menu( array(
						'theme_location' => 'top-menu',
						'menu_class' => 'menu-top'
					) );
				}
			?>
		</nav>
	</div>