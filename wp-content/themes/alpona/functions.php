<?php
/**
 * Theme Functions.php
 *
 * All functions of alpona Theme.
*/

/**
 * ---------------------------------------------------
 * Step 1.0 - Setting Up Theme's Default content width
 * ---------------------------------------------------
*/
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * ------------------------------------------
 * Step 2.0 - Enqueue Stylesheet & Javascript
 * ------------------------------------------
*/
function alpona_basic_all() {
	// Load our main stylesheet.
	wp_enqueue_style( 'main_css', get_stylesheet_uri() );
    
    // Add required stylesheet
    wp_enqueue_style( 'less_css', get_template_directory_uri() . '/css/less.css', array(), '1.0' );
    wp_enqueue_style( 'fonts_css', get_template_directory_uri() . '/css/fontello.css', array(), '1.0' );

	/* Load basic Bootstrap javascript */
	wp_enqueue_script( 'res_nav_js', get_template_directory_uri() . '/js/res-nav.js', array('jquery'), '1.0', true );

	// Load Comment reply on single post
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'alpona_basic_all' );

/**
 * ---------------------------------
 * Step 3.0 - Installing Theme Setup
 * ---------------------------------
*/

function alpona_setup_theme() {
	/*
	 * Makes alpona available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on alpona, use a find and replace
	 * to change 'alpona' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'alpona', get_template_directory() . '/languages' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'top-menu', __( 'Top Menu', 'alpona' ) );

	// Add theme support for title tag
	add_theme_support( 'title-tag' );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => '#e6e6e6',
		'header-text'			=> true,
		'default-text-color'		=> '444',
	) );
	
	/* Add theme support for custom-header */
	$args = array(
		'width'         => 1200,
		'height'        => 250,
		'uploads'       => true,
		'default-text-color'		=> '444444',
	);
	add_theme_support( 'custom-header', $args );

	// Adding post thumbnail
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'alpona_setup_theme' );

/**
 * ----------------------
 * Step 4.0 - Filter Menu
 * ----------------------
 *
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() to fallback - wp_page_menu() - show a home link.
 *
 * @since alpona 1.0
 */
function alpona_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'alpona_page_menu_args' );

/**
 * --------------------------
 * Step 5.0 - Filter WP title
 * --------------------------
 *
 * Register sidebars.
 *
 * Registers our widgets area.
 *
 * @since alpona 1.0
 */
function alpona_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar right', 'alpona' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on first sidebar on right where widgets are shown.', 'alpona' ),
		'before_widget' => '<aside id="%1$s" class="sidebar widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'alpona_widgets_init' );

/**
 * --------------------------------
 * Step 6.0 - Custom comment form
 * --------------------------------
 */
if ( ! function_exists( 'alpona_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own alpona_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since alpona 1.0
 */
function alpona_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'alpona' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'alpona' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'alpona' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'alpona' ), get_comment_date(), get_comment_time() )
					);
				?>
			</div><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'alpona' ); ?></p>
			<?php endif; ?>

			<div class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'alpona' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'alpona' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**
 * ------------------------------
 * Step 7.0 - Custom Pagination
 * ------------------------------
 */
function alpona_pagenavi( $p = 2 ) { // pages will be show before and after current page
  if ( is_singular() ) return; // don't show in single page
  global $wp_query, $paged;
  $max_page = $wp_query->max_num_pages;
  if ( $max_page == 1 ) return; // don't show when only one page
  if ( empty( $paged ) ) $paged = 1;
  // echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; // pages
  if ( $paged > $p + 1 ) p_link( 1, 'First' );

  if ( $paged > $p + 2 ) echo '... ';
  for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // Middle pages
    if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li><span class='page-numbers current'>{$i}</span></li> " : p_link( $i );
  }
  if ( $paged < $max_page - $p - 1 ) echo '... ';
  if ( $paged < $max_page - $p ) p_link( $max_page, 'Last' );

}
function p_link( $i, $title = '' ) {
  if ( $title == '' ) $title = "Page {$i}";
  echo "<li><a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a></li>";
}


/**
 * -------------------------
 * Step 8.0 - Add read more
 * -------------------------
 */
function arb_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Continue Reading', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'arb_excerpt_more' );

/**
 * -----------------------------------
 * Step 9.0 - Customizer live preview
 * -----------------------------------
 * Used by hook: 'customize_preview_init'
 * 
 * @see add_action('customize_preview_init',$func)
 */
function arbblogging_customizer_live_preview()
{
	wp_enqueue_script( 
		  'arb-themecustomizer',			//Give the script an ID
		  get_template_directory_uri().'/js/theme-customizer.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  '4.1',						//Define a version (optional) 
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'arbblogging_customizer_live_preview' );

/**
 * --------------------------
 * Step 10.0 - Required files
 * --------------------------
 */
require get_template_directory() . '/inc/customizer.php';
?>