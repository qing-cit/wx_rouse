<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package AppStack
 */

get_header(); 
$posts_page_id = get_option( 'page_for_posts');
$posts_page = get_page( $posts_page_id); 
?>
  <div class="banner">
	<?php if ( has_post_thumbnail()) {
		
		
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_option( 'page_for_posts')), 'stack-header' );
		$url = $thumb['0'];
	
	?>
	
    <div class="banner-image" style="background-image:url(<?php echo esc_url($url);?>);"></div>
	<?php } else { ?>
		<div class="banner-image" style="background-image:url(<?php echo esc_attr(get_header_image());?>);"></div>
		<?php }?>
    <div class="stack-header-overlay"></div>
    <div class="primary-wrapper">
	

		<?php if ( is_home() && ! is_front_page() ) { ?>
			
				<h1 class="entry-title"><?php single_post_title(); ?></h1>
			
		<?php } else { ?>
			
			<h1 class="entry-title"><?php _e('Latest Posts','appstack'); ?></h1>
			
			<?php } ?>
	  <?php if ( function_exists( 'get_field' ) ) : ?>
      <div class="entry-tagline"><?php echo esc_attr( get_field('page_subtitle', $posts_page )); ?></div>
        <?php endif; ?>
    </div>
    
  </div>
</header>
<?php if(function_exists( 'get_field' ) && get_field( 'select_sidebar', $posts_page_id ) == "fullwidth") {
	
} else { ?>
	<div class="stack-holder">
<?php }?>
 
  <div class="content">
    



	<div id="primary" class="content-area">
		<main id="main" class="site-main">
<div class="blog-grid row">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

 
				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>
            </div>
            <div class="stack-content">
			<?php appstack_paging_nav(); ?>
            </div>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if(function_exists( 'get_field' ) && get_field( 'select_sidebar', $posts_page_id ) == "fullwidth") { ?>

	<?php } else { 
	get_sidebar();
	?>
</div>	
	
	

<?php }?>
</div>
<?php get_footer(); ?>
