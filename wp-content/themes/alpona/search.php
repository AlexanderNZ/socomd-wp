<?php get_header(); ?>
	
<div id="main-content" class="row fix">
    <div class="wrapper">
        <div id="content" class="floatleft">
            <div class="meta-nav fix">
                <span><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Home', 'alpona'); ?></a></span> &#187;
                <span><?php printf( __( 'Search Results for: %s', 'alpona' ), '<span>' . get_search_query() . '</span>' ); ?></span>
            </div> <!-- End navigation top -->
            
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <?php get_template_part('content', get_post_format()); ?>
            <!-- End main content if have any -->
            <?php endwhile; ?>
            
            <?php
				// Previous/next page navigation.
				the_posts_pagination( array(
					'mid_size' => 3,
					'prev_text' => __( 'Previous posts', 'alpona' ),
					'next_text' => __( 'Next post', 'alpona' ),
				) );
			?>
            <!-- End pagination -->
            
            <?php else: ?>
            <?php get_template_part('content', 'none'); ?>
            <!-- End Blank content if not have any post -->
            
            <?php endif; ?>
        </div> <!-- End content -->
        <?php get_sidebar(); ?>
    </div> <!-- End wrapper -->
</div> <!-- End Main content -->
       
<?php get_footer(); ?>