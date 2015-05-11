		
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<h2 class="post-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<div class="postmeta"><?php glades_display_postmeta(); ?></div>
		
		<?php glades_display_thumbnail_index(); ?>
		
		<div class="entry clearfix">
			<?php the_content(__('Continue reading &raquo;', 'glades')); ?>
			<div class="page-links"><?php wp_link_pages(); ?></div>
		</div>

	</article>