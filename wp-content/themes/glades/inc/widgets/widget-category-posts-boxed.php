<?php

// Add Category Posts Boxed Widget
class Glades_Category_Posts_Boxed_Widget extends WP_Widget {

	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'glades_category_posts_boxed', 
			'description' => __('Display latest posts from category in boxed layout. Please use this widget ONLY on Frontpage Magazine widget area.', 'glades')
		);
		$this->WP_Widget('glades_category_posts_boxed', __('Category Posts Boxed (Glades)', 'glades'), $widget_ops);
		
		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}

	public function delete_widget_cache() {
		
		wp_cache_delete('widget_glades_category_posts_boxed', 'widget');
		
	}
	
	private function default_settings() {
	
		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'layout'			=> 'horizontal'
		);
		
		return $defaults;
		
	}
	
	// Display Widget
	function widget($args, $instance) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_glades_category_posts_boxed', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		// Display Widget from Cache if exists
		if ( isset( $cache[ $this->id ] ) ) {
			echo $cache[ $this->id ];
			return;
		}
		
		// Start Output Buffering
		ob_start();
			
		// Extract Sidebar Arguments
		extract($args);
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Output
		echo $before_widget;
	?>
		<div id="widget-category-posts-boxed" class="widget-category-posts clearfix">

			<?php // Display Title
			$this->display_widget_title($args, $instance); ?>
			
			<div class="widget-category-posts-content">
			
				<?php $this->render($instance); ?>
				
			</div>
			
		</div>
	<?php
		echo $after_widget;
		
		// Set Cache
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_glades_category_posts_boxed', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	
	}
	
	// Render Widget Content
	function render($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) ); 
		
		if( $layout == 'horizontal' ) : ?>
		
			<div class="category-posts-boxed-horizontal clearfix">
			
				<?php $this->display_category_posts_horizontal($instance); ?>

			</div>
		
		<?php else: ?>
			
			<div class="category-posts-boxed-vertical clearfix">
			
				<?php $this->display_category_posts_vertical($instance); ?>

			</div>
		
		<?php 
		endif;

	}
	
	// Display Category Posts in Horizontal Layout
	function display_category_posts_horizontal($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => 4,
			'ignore_sticky_posts' => true,
			'cat' => (int)$category
		);
		$posts_query = new WP_Query($query_arguments);
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if(isset($i) and $i == 0) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-extra-large'); ?></a>
						
						<div class="post-content">

							<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

							<div class="postmeta"><?php $this->display_postmeta($instance); ?></div>

							<div class="entry">
								<?php the_excerpt(); ?>
								<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php _e('Continue reading &raquo;', 'glades'); ?></a>
							</div>
							
						</div>

					</article>

				<div class="medium-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('medium-post clearfix'); ?>>

						<div class="medium-post-image">

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-medium'); ?></a>
							
						</div>

						<div class="medium-post-content">
							
							<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<div class="postmeta"><?php $this->display_postmeta($instance); ?></div>
						
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
			
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	}
	
	// Display Category Posts in Vertical Layout
	function display_category_posts_vertical($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => 5,
			'ignore_sticky_posts' => true,
			'cat' => (int)$category
		);
		$posts_query = new WP_Query($query_arguments);
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if(isset($i) and $i == 0) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-large'); ?></a>
						
						<div class="post-content">

							<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

							<div class="postmeta"><?php $this->display_postmeta($instance); ?></div>

							<div class="entry">
								<?php the_excerpt(); ?>
								<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php _e('Continue reading &raquo;', 'glades'); ?></a>
							</div>
							
						</div>

					</article>

				<div class="small-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('small-post clearfix'); ?>>

						<div class="small-post-image">

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-small'); ?></a>
					
						</div>

						<div class="small-post-content">
							
							<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<div class="postmeta"><?php $this->display_postmeta($instance); ?></div>
						
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
			
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	}
	
	// Display Postmeta
	function display_postmeta($instance) { ?>

		<span class="meta-date">
		<?php printf('<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		?>
		</span>

	<?php if ( comments_open() ) : ?>
		<span class="meta-comments sep">
			<?php comments_popup_link( __('Leave a comment', 'glades'),__('One comment','glades'),__('% comments','glades') ); ?>
		</span>
	<?php endif;

	}
	
	// Display Widget Title
	function display_widget_title($args, $instance) {
		
		// Get Sidebar Arguments
		extract($args);
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Add Widget Title Filter
		$widget_title = apply_filters('widget_title', $title, $instance, $this->id_base);
		
		if( !empty( $widget_title ) ) :
		
			echo $before_title;
					
			// Check if "All Categories" is selected
			if( $category == 0 ) :
			
				echo $widget_title;

			else:
			
				$link_title = sprintf( __('View all posts from category %s', 'glades'), get_cat_name( $category ) );
				$link_url = esc_url( get_category_link( $category ) );
				
				echo '<a href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a>';
			
			endif;
			
			echo $after_title; 
			
		endif;

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['category'] = (int)$new_instance['category'];
		$instance['layout'] = esc_attr($new_instance['layout']);
		
		$this->delete_widget_cache();
		
		return $instance;
	}

	function form( $instance ) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );

?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'glades'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'glades'); ?></label><br/>
			<?php // Display Category Select
				$args = array(
					'show_option_all'    => __('All Categories', 'glades'),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $category,
					'name'               => $this->get_field_name('category'),
					'id'                 => $this->get_field_id('category')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Post Layout:', 'glades'); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $layout, 'horizontal' ); ?> value="horizontal" ><?php _e('Horizontal Arrangement', 'glades'); ?></option>
				<option <?php selected( $layout, 'vertical' ); ?> value="vertical" ><?php _e('Vertical Arrangement', 'glades'); ?></option>
			</select>
		</p>
		
<?php
	}
}
register_widget('Glades_Category_Posts_Boxed_Widget');
?>