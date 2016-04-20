<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package merchant
 */
?>
<?php // if ( !function_exists( 'get_field' ) ) : ?>

<?php // endif; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( function_exists( 'get_field' ) ) :
			get_template_part( 'template-parts/content', 'pb' );
		endif;?>

	
</article><!-- #post-## -->
