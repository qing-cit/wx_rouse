<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>


<div class="shopleftsidebar shopsingleleftsidebar">
	<div class="content reverse">
		<ul class="single-btn">
			<li class="all"><a href="/products"><?php esc_attr_e('Projects', 'converio');?></a></li>
			<?php if(get_next_post_link('%link')) { ?><li class="previous"><?php next_post_link('%link'); ?></li><?php } ?>
			<?php if(get_previous_post_link('%link')) { ?><li class="next"><?php previous_post_link('%link'); ?></li><?php } ?>
		</ul>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */

		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		//do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>
	</div>
</div>
<?php get_footer( 'shop' ); ?>