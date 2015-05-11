<?php

/*==================================== THEME SETUP ====================================*/

// Load default style.css and Javascripts
add_action('wp_enqueue_scripts', 'glades_enqueue_scripts');

if ( ! function_exists( 'glades_enqueue_scripts' ) ):
function glades_enqueue_scripts() {

	// Register and Enqueue Stylesheet
	wp_enqueue_style('glades-stylesheet', get_stylesheet_uri());
	
	// Register Genericons
	wp_enqueue_style('glades-genericons', get_template_directory_uri() . '/css/genericons/genericons.css');

	// Register and enqueue navigation.js
	wp_enqueue_script('glades-jquery-navigation', get_template_directory_uri() .'/js/navigation.js', array('jquery'));

	// Register and Enqueue Fonts
	wp_enqueue_style('glades-default-fonts', glades_google_fonts_url(), array(), null );

}
endif;

// Load comment-reply.js if comment form is loaded and threaded comments activated
add_action( 'comment_form_before', 'glades_enqueue_comment_reply' );

function glades_enqueue_comment_reply() {
	if( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

// Retrieve Font URL to register default Google Fonts
function glades_google_fonts_url() {
    
	$font_families = array('PT Sans:700,400', 'Contrail One');

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return apply_filters( 'glades_google_fonts_url', $fonts_url );
}


// Setup Function: Registers support for various WordPress features
add_action( 'after_setup_theme', 'glades_setup' );

if ( ! function_exists( 'glades_setup' ) ):
function glades_setup() {

	// Set Content Width
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 860;
	
	// init Localization
	load_theme_textdomain('glades', get_template_directory() . '/languages' );

	// Add Theme Support
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_editor_style();
	
	// Add Post Thumbnails
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 900, 280, true );
	
	// Add Custom Background
	add_theme_support('custom-background', array('default-color' => 'e5e5e5'));

	// Add Custom Header
	add_theme_support('custom-header', array(
		'header-text' => false,
		'width'	=> 2500,
		'height' => 200,
		'flex-height' => true));
		
	// Add theme support for Jetpack Featured Content
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'glades_get_featured_content',
		'max_posts'  => 3
		)
	);
	
	// Add Theme Support for Glades Pro Plugin
	add_theme_support( 'glades-pro' );

	// Register Navigation Menus
	register_nav_menu( 'primary', __('Main Navigation', 'glades') );
	register_nav_menu( 'secondary', __('Top Navigation', 'glades') );
	register_nav_menu( 'footer', __('Footer Navigation', 'glades') );
	
	// Register Social Icons Menu
	register_nav_menu( 'social', __('Social Icons', 'glades') );

}
endif;


// Add custom Image Sizes
add_action( 'after_setup_theme', 'glades_add_image_sizes' );

if ( ! function_exists( 'glades_add_image_sizes' ) ):
function glades_add_image_sizes() {
	
	// Add Custom Header Image Size
	add_image_size( 'glades-header-image', 2500, 200, true);
	
	// Add Featured Content Image Sizes
	add_image_size( 'glades-featured-content-left', 820, 370, true);
	add_image_size( 'glades-featured-content-right', 425, 175, true);
	
	// Add Category Post Widget image sizes
	add_image_size( 'glades-category-posts-widget-small', 140, 90, true);
	add_image_size( 'glades-category-posts-widget-medium', 300, 175, true);
	add_image_size( 'glades-category-posts-widget-large', 600, 280, true);
	add_image_size( 'glades-category-posts-widget-extra-large', 600, 350, true);
	
}
endif;


// Register Sidebars
add_action( 'widgets_init', 'glades_register_sidebars' );

if ( ! function_exists( 'glades_register_sidebars' ) ):
function glades_register_sidebars() {

	// Register Sidebars
	register_sidebar( array(
		'name' => __( 'Sidebar', 'glades' ),
		'id' => 'sidebar',
		'description' => __( 'Appears on posts and pages except front page and fullwidth template.', 'glades' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar( array(
		'name' => __( 'Magazine Homepage', 'glades' ),
		'id' => 'magazine-homepage',
		'description' => __( 'Appears on Magazine Homepage template only. You can use the Category Posts widgets here.', 'glades' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));

}
endif;


// Add title tag for older WordPress versions
if ( ! function_exists( '_wp_render_title_tag' ) ) :

	add_action( 'wp_head', 'glades_wp_title' );
	function glades_wp_title() { ?>
		
		<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php
    }
    
endif;


// Add Default Menu Fallback Function
function glades_default_menu() {
	echo '<ul id="mainnav-menu" class="menu">'. wp_list_pages('title_li=&echo=0') .'</ul>';
}


// Get Featured Posts
function glades_get_featured_content() {
	return apply_filters( 'glades_get_featured_content', false );
}


// Check if featured posts exists
function glades_has_featured_content() {
	return ! is_paged() && (bool) glades_get_featured_content();
}


// Change Excerpt Length
add_filter('excerpt_length', 'glades_excerpt_length');
function glades_excerpt_length($length) {
    return 60;
}

// Category Posts Large Excerpt Length
function glades_category_posts_large_excerpt($length) {
    return 32;
}

// Category Posts Medium Excerpt Length
function glades_category_posts_medium_excerpt($length) {
    return 20;
}

// Category Posts Small Excerpt Length
function glades_category_posts_small_excerpt($length) {
    return 8;
}


// Custom Template for comments and pingbacks.
if ( ! function_exists( 'glades_list_comments' ) ):
function glades_list_comments($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;

	if( $comment->comment_type == 'pingback' or $comment->comment_type == 'trackback' ) : ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'glades' ); ?> <?php comment_author_link(); ?>
			<?php edit_comment_link( __( '(Edit)', 'glades' ), '<span class="edit-link">', '</span>' ); ?>
			</p>

	<?php else : ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">

				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 56 ); ?>
					<?php printf(__('<span class="fn">%s</span>', 'glades'), get_comment_author_link()) ?>
				</div>

		<?php if ($comment->comment_approved == '0') : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'glades' ); ?></p>
		<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(__('%1$s at %2$s', 'glades'), get_comment_date(),  get_comment_time()) ?></a>
					<?php edit_comment_link(__('(Edit)', 'glades'),'  ','') ?>
				</div>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>

			</div>
<?php
	endif;

}
endif;


/*==================================== INCLUDE FILES ====================================*/

// include Theme Info page
require( get_template_directory() . '/inc/theme-info.php' );

// include Theme Customizer Options
require( get_template_directory() . '/inc/customizer/customizer.php' );
require( get_template_directory() . '/inc/customizer/default-options.php' );

// include Customization Files
require( get_template_directory() . '/inc/customizer/frontend/custom-layout.php' );
require( get_template_directory() . '/inc/customizer/frontend/custom-slider.php' );

// include Template Functions
require( get_template_directory() . '/inc/template-tags.php' );

// include Widget Files
require( get_template_directory() . '/inc/widgets/widget-category-posts-boxed.php' );
require( get_template_directory() . '/inc/widgets/widget-category-posts-columns.php' );
require( get_template_directory() . '/inc/widgets/widget-category-posts-grid.php' );

// Include Featured Content class in case it does not exist yet (e.g. user has not Jetpack installed)
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require( get_template_directory() . '/inc/featured-content.php' );
}

?>