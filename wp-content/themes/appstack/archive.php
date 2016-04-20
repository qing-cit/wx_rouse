<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package AppStack
 */

get_header(); ?>

  <div class="banner">
	
	<div class="banner-image" style="background-image:url(<?php echo esc_url(get_header_image()); ?>);"></div>
		
    <div class="stack-header-overlay"></div>
    <div class="primary-wrapper">
      
	<?php
		the_archive_title( '<h1 class="entry-title">', '</h1>' );
		the_archive_description( '<div class="entry-tagline">', '</div>' );
	?>
    </div>
    
  </div>
</header>

     <div class="stack-holder">
	  <div class="content">
	   <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
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

<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
