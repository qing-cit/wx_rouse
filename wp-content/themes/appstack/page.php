<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package AppStack
 */

get_header(); ?>

<?php if ( function_exists( 'get_field' ) && get_field( 'hide_header' ) == 1 ) {} else { ?>
  <div class="banner">
	<?php if ( has_post_thumbnail()) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'stack-header' );
		$url = $thumb['0'];
	
	?>
	
    <div class="banner-image" style="background-image:url(<?php echo esc_url($url);?>);"></div>
	<?php } else {  ?>
	<div class="banner-image" style="background-image:url(<?php echo esc_url(get_header_image()); ?>);"></div>
		<?php } ?>
    <div class="stack-header-overlay"></div>
    <div class="primary-wrapper">
      
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	  <?php if ( function_exists( 'get_field' ) ) : ?>
      <div class="entry-tagline"><?php echo esc_attr(get_field('page_subtitle')); ?></div>
        <?php endif; ?>
    </div>
    
  </div>
  <?php } ?>
</header>
  
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
