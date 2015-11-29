<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage CelandOne
 * @since CelandOne 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div id="object" class="expandOpen">
	<?php
		// Post thumbnail.
		celandone_post_thumbnail();
	?>
</div>
	<header class="entry-header">
	<div id="object" class="hatch">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</div>	
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'celandone' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'celandone' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'celandone' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php celandone_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'celandone' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	
	<script>
	$('#object').click(function() {
		$(this).addClass("expandOpen");
	});
	</script>

	<script>
	$(window).scroll(function() {
		$('#object').each(function(){
		var imagePos = $(this).offset().top;

		var topOfWindow = $(window).scrollTop();
			if (imagePos < topOfWindow+300) {
				$(this).addClass("hatch");
			}
		});
	});
</script>



</article><!-- #post-## -->