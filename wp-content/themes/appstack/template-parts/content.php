<?php
/**
 * Template part for displaying posts.
 *
 * @package AppStack
 */

?>
   
  <div class="col">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php if ( has_post_thumbnail()) {
			?>
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<span class="stack-trim"><?php the_post_thumbnail('stack-grid'); ?></span>
		</a>
	
		<?php
		}
     ?>
	 </header><!-- .entry-header -->
	 <div class="blog-body">
	<div class="blog-txt">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<p class="date">
			<?php appstack_posted_on(); ?>
		</p><!-- .entry-meta -->
		<?php endif; ?>
	

	<div class="text">
		<?php
			/* translators: %s: Name of current post */
			the_excerpt( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'appstack' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'appstack' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</div>
	<footer class="entry-footer">
		<?php appstack_grid_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</div>
</article><!-- #post-## -->
</div>