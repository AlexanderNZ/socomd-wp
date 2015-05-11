<footer id="footer" class="row fix">
    <div class="wrapper">
        <p class="alignleft">&copy; <?php bloginfo('name'); ?> <?php echo esc_attr(date('Y')); ?></p>
        <p class="alignright">
            <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'alpona' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'alpona' ), 'WordPress' ); ?></a>
				<span class="sep"> &#124; </span>
				<a href="<?php echo esc_url( __( 'http://anisbd.com/', 'alpona' ) ); ?>"><?php printf( __( 'Theme: %s', 'alpona' ), 'Alpona' ); ?></a>
        </p>
    </div> <!-- End Main Wrapper Here -->
</footer> <!-- End footer -->
<?php wp_footer();?>
</body>
</html>