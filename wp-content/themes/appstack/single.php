<?php
/**
 * The template for displaying all single posts.
 *
 * @package AppStack
 */

get_header(); ?>
  <div class="banner">
	<?php if ( has_post_format( 'gallery' ) ) {
		if (get_field('post_gallery')): ?>
			<div class="slide">
				
			<ul>
						<?php $images = get_field('post_gallery'); ?>
					
										<?php
										foreach ($images as $image):
											?>
										<li style="background-image:url(<?php echo esc_url($image['url']);?>);">
										
										</li>
											<?php
										endforeach; ?>
									</ul>
	                                 </div>
		
				
		<?php endif;
			}
elseif ( has_post_thumbnail()) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'stack-header' );
		$url = $thumb['0'];
	
	?>
	
    <div class="banner-image" style="background-image:url(<?php echo esc_url($url);?>);"></div>
	<?php } ?>
    <div class="stack-header-overlay"></div>
    <div class="primary-wrapper">
      
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	  <?php if ( function_exists( 'get_field' ) ) : ?>
      <div class="entry-tagline"><?php echo esc_attr(get_field('page_subtitle')); ?></div>
        <?php endif; ?>
    </div>
    
  </div>
</header>
<?php if(function_exists( 'get_field' ) && get_field('select_sidebar') == "fullwidth") {
	
} else { ?>
	<div class="stack-holder">
<?php }?>
 
  <div class="content">
	  
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>
            <div class="stack-content">
			<?php appstack_post_nav(); ?>
            </div>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php if(function_exists( 'get_field' ) && get_field('select_sidebar') == "fullwidth") { ?>

	<?php } else { 
	get_sidebar();
	?>
</div>	
	
	

<?php }?>
</div>
<?php get_footer(); ?>
