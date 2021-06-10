<?php
/**
 * KabelStar
 *
 * Add author gravatar image to post info meta
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_filter( 'wp_lazy_loading_enabled', '__return_false' );

add_filter( 'genesis_post_info', __NAMESPACE__ . '\post_info_filter' );
function post_info_filter( $post_info ) {

	// get author details
	$entry_author = get_avatar( get_the_author_meta( 'email' ), 64 );
	$author_link  = get_author_posts_url( get_the_author_meta( 'ID' ) );

	// build updated post_info
	$post_info = sprintf( '<span class="author-avatar"><a href="%s">%s</a></span>', $author_link, $entry_author );
	$post_info .= '[post_author_posts_link] [post_date]';

	return $post_info;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', __NAMESPACE__ . '\author_box_gravatar_size' );
function author_box_gravatar_size( $size ) {
	return 120;
}

add_filter( 'genesis_author_box_title', __NAMESPACE__ . '\author_box_title', 10, 3 );

function author_box_title( $title, $context, $user_id ) {
//	d($context);
	$author_url = get_author_posts_url( $user_id );

	return sprintf( '<a href="%1$s" title="%3$s">%2$s</a>',
		esc_url( $author_url ),
		str_replace( 'About ', '', $title ),
		esc_html( ucwords( get_the_author_meta( 'display_name', $user_id ) ) )
	);
}

add_filter( 'genesis_author_box', __NAMESPACE__ . '\author_box', 10, 7 );
function author_box( $output, $context, $pattern, $gravatar, $title, $description, $user_id ) {
	$output = str_replace( '<img', '<div class="author-box-image"><img', $output );
	$output = str_replace( '/>', '/></div>', $output );
	$output = str_replace( '<h4 class="author-box-title">', '<div class="author-box-details"><h4 class="author-box-title">', $output );
	$output = str_replace( '</div></section>', '</div></div></section>', $output );

	return $output;
}
