<?php
/*
 * Template Name: Full Page
 * Description: A Page Template with full width.
 */
?>

<?php get_header(); ?>
	
<div id="main-content" class="row fix">
    <div class="wrapper">
        <div id="content-full">
            <div class="meta-nav fix">
                <span><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Home', 'alpona'); ?></a></span> &#187; <span> <?php the_title(); ?> </span>
            </div> <!-- End navigation top -->
            <?php while(have_posts()): the_post(); ?>
            <?php get_template_part('content', get_post_format()); ?>
            <!-- End main content if have any -->
            <?php endwhile; ?> <!-- End query -->
            
            <div class="single-meta fix">
            <span class="alignleft">
            <?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'alpona' ) . ' %title' ); ?>
            </span>
            <span class="alignright">
            <?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'alpona' ) . '' ); ?>
            </span>
            </div> <!-- Navigation -->
            
            
                <?php comments_template( '', true ); ?>
            
            <!-- End comment box -->
        </div> <!-- End content -->
    </div> <!-- End wrapper -->
</div> <!-- End Main content -->
       
<?php get_footer(); ?>