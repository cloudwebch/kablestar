<?php
/**
 * Theme Filters
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

include_once __DIR__ . '/filters/index.php';

add_filter( 'body_class', __NAMESPACE__ . '\body_class' );
function body_class( $classes ) {

//	if ( is_page_template( 'template-location.php' ) ) {
//		$classes[]  = 'company-locations';
//	}

	if(get_theme_mod( 'navigation_fixed' )){
		$classes[]  = 'fixed-header';
	}

	return $classes;
}

add_filter( 'theme_page_templates', __NAMESPACE__ . '\remove_genesis_page_templates' );
function remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );

	return $page_templates;
}


add_filter( 'login_errors', __NAMESPACE__ .'\login_errors' );
/**
 * Generic login error message
 */
function login_errors() {
	return __('Oops! Something is wrong!', 'kabelstar');
}


add_filter( 'genesis_author_box_gravatar_size', __NAMESPACE__ .'\author_box_gravatar' );
/**
 * Modify size of the Gravatar in the author box.
 *
 * @param int $size Gravatar image size.
 */
function author_box_gravatar( $size ) {
	return 90;
}

add_filter( 'genesis_comment_list_args', __NAMESPACE__ .'\comments_gravatar' );
/**
 * Modify size of the Gravatar in the entry comments.
 *
 * @param array $args Arguments for comments Gravatar size.
 */
function comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}
//Remove edit link from page
add_filter( 'edit_post_link', '__return_false' );

//\add_filter('manage_product_posts_custom_column', function($columns){
//	d($columns);
//});
