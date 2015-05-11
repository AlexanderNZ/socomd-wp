<article id="post-<?php the_ID(); ?>" <?php if(is_sticky()){ $featured = 'featured main-post'; } else { $featured = 'main-post main-bg'; } post_class($featured); ?>>
    <?php if(is_single() || is_page()){ ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php }else{ ?>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php } ?>
    <!-- End title here -->
    
    <?php
    if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-circle img-thumbnail' ) );
	}
    ?>
    <!-- End thumbnail here if have any -->
    
    <?php
    if(is_single() || is_page()) {
        the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'alpona' ) );
		/* posts pagination */
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'alpona' ), 'after' => '</div>' ) );
    } else { 
        the_excerpt();
    }
    ?>
    
    <!-- End article here -->
    <div class="post-meta">
        <p>
            <span>
				<i class="icon-user"></i>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php echo get_the_author(); ?>
				</a>
			</span>
			<span>
				<i class="icon-link"></i> <?php the_time( get_option( 'date_format' ) ); ?>
			</span>
            <span>
				<i class="icon-folder"></i> <?php the_category(','); ?>
			</span>
            <span>
			<?php if(has_tag()){ ?>
                <i class="icon-tags"></i> <?php the_tags(''); ?>
            <?php } ?>
			</span>
			<span>
				<i class="icon-comment"></i> <?php comments_popup_link('No comment', '1 comment', '% comment'); ?>
			</span>
        </p>
    </div> <!-- End post meta -->
</article> <!-- End article -->