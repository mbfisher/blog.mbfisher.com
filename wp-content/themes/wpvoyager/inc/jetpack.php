<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package WPVoyager
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function wpvoyager_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'wpvoyager_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function wpvoyager_jetpack_setup
add_action( 'after_setup_theme', 'wpvoyager_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function wpvoyager_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function wpvoyager_infinite_scroll_render
