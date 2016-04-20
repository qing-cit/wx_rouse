<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package AppStack
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function appstack_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'appstack_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function appstack_jetpack_setup
add_action( 'after_setup_theme', 'appstack_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function appstack_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function appstack_infinite_scroll_render
