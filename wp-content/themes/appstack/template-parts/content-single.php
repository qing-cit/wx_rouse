<?php
/**
 * Template part for displaying single posts.
 *
 * @package AppStack
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="stack-content">
	<header class="entry-header">
		<?php if ( has_post_thumbnail()) { ?><div class="stack-space"></div><?php } else {
		the_title( '<h2 class="entry-title">', '</h2>' );
		} ?>

		<p class="byline date">
			<?php appstack_posted_on(); ?>
		</p><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<p class="text">
		
		<?php the_content(); ?>
	</div>
				
			    <footer class="entry-footer">
					<?php appstack_entry_footer(); ?>
					<div class="stack-social">
													<nav class="stack-social-menu">
													
  <a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="stack-social-menu-item"> <i class="fa fa-twitter"></i> </a>
													  <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="stack-social-menu-item"> <i class="fa fa-facebook"></i> </a>
													  <a href="#" target="_blank" class="stack-social-menu-item"> <i class="fa fa-pinterest"></i> </a>
													  <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="stack-social-menu-item"> <i class="fa fa-google-plus"></i> </a>

													</nav>

												</div>
				</footer><!-- .entry-footer -->
				
				<?php
				global $user_ID;
				 if(get_the_author_meta('description')) { ?>
				<div class="stack-content author-bio">
					<div class="avatar-holder">
							<?php echo get_avatar( get_the_author_meta('email'), '60' ); ?>
						</div>
						<div class="commentlist-holder">
							<span class="name"><?php the_author_link(); ?></span>
							<ul class="bio-icons">
								<?php 
									$rss_url = get_the_author_meta( 'rss_url' );
									if ( $rss_url && $rss_url != '' ) {
										echo '<li class="rss"><a href="' . esc_url($rss_url) . '"><i class="fa fa-rss"></i></a></li>';
									}
					
									$google_profile = get_the_author_meta( 'google_profile' );
									if ( $google_profile && $google_profile != '' ) {
										echo '<li class="google"><a href="' . esc_url($google_profile) . '" rel="author"><i class="fa fa-google"></i></a></li>';
									}
					
									$twitter_profile = get_the_author_meta( 'twitter_profile' );
									if ( $twitter_profile && $twitter_profile != '' ) {
										echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '"><i class="fa fa-twitter"></i></a></li>';
									}
					
									$facebook_profile = get_the_author_meta( 'facebook_profile' );
									if ( $facebook_profile && $facebook_profile != '' ) {
										echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '"><i class="fa fa-facebook"></i></a></li>';
									}
					
									$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
									if ( $linkedin_profile && $linkedin_profile != '' ) {
										echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '"><i class="fa fa-linkedin"></i></a></li>';
									}
								?>
							</ul>
							<p><?php the_author_meta('description'); ?></p>
						
								<p><a href="<?php the_author_meta('user_url');?>"><?php the_author_meta('user_url');?></a></p>
								
							</div>
						</div>
				<!--END .author-bio-->
				<?php } ?>
				
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'appstack' ),
				'after'  => '</div>',
			) );
		?>
	</p><!-- .entry-content -->

	
</article><!-- #post-## -->

