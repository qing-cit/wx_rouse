<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package AppStack
 */

get_header(); ?>


  <div class="banner">
	
	<div class="banner-image" style="background-image:url(<?php echo esc_url(get_header_image()); ?>);"></div>
		
    <div class="stack-header-overlay"></div>
    <div class="primary-wrapper">
      

		<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'appstack' ); ?></h1>
	
    </div>
    
  </div>
</header>
 <div class="content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found stack-content">
				

				<div class="page-content">
					
                    <div class="stack-error"></div>
					<?php get_search_form(); ?>

					
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>
