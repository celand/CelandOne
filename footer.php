<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage CelandOne
 * @since CelandOne 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info" style="display: none;">
			<?php
				/**
				 * Fires before the CelandOne footer text for footer customization.
				 *
				 * @since CelandOne 1.0
				 */
				do_action( 'celandone_credits' );
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'celandone' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'celandone' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
