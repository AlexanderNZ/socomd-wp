<?php get_header(); ?>
	
<div id="main-content" class="row fix">
    <div class="wrapper">
        <div id="content" class="floatleft">
            <?php get_template_part('content', 'none'); ?>
        </div> <!-- End content -->
        <?php get_sidebar(); ?>
    </div> <!-- End wrapper -->
</div> <!-- End Main content -->
       
<?php get_footer(); ?>