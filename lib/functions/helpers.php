<?php
/**
 * KabelStar
 *
 * This file adds the required helper functions used in the KabelStar Theme.
 *
 * @package Genesis Webpack Replace
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_site_posts( $post_type, $args = array() ) {
//	global $wp_query;
	$defaults = array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'posts_per_page'   => 500,
		'no_found_rows'    => true,
		'suppress_filters' => false,
	);

	$args = wp_parse_args( $args, $defaults );

	return new \WP_Query( $args );
}

function get_the_featured_image( $post_id, $size = 'full' ) {
	$post_image = get_the_post_thumbnail_url( $post_id, $size );
	$thumb_id   = get_post_thumbnail_id( $post_id );
	$alt        = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
	$post_image_attributes = wp_get_attachment_image_src( $thumb_id, $size );

	return sprintf( '<img src="%s" alt="%s" width="%s" height="%s" />',
		esc_url( $post_image ),
		\esc_attr( $alt ),
		(int) $post_image_attributes[1],
		(int) $post_image_attributes[2]
	);
}

function get_highlighted_product($type){
	$args = array(
		'stock'      => 1,
		'showposts'  => 1,
		'orderby'    => 'date',
		'order'      => 'DESC',
		'meta_query' => array(
			array(
				'key'   => 'featured_' . $type,
				'value' => 'yes',
			)
		)
	);

	$featured_day_product = get_site_posts( 'product', $args );
	if ( ! $featured_day_product->have_posts() ) {
		echo sprintf( '%s', __( 'We do not have any highlighted product for ' . $type ) );

		return false;
	}


	while ( $featured_day_product->have_posts() ) {
		$featured_day_product->the_post();
		$product_id       = get_the_ID();
		$product_image    = get_the_featured_image( $product_id, 'side-featured-product' );
		$product          = new \WC_Product( $product_id );
		$product_price    = $product->get_price();
		$product_name     = $product->get_name();
		$product_url      = get_permalink( $product_id );
		return sprintf( '<div class="featured-product featured-product-%s">
<a href="%s" title="%s">
<div class="featured-product-visual">
%s
</div>
<div class="featured-product-title">
<h3>%s</h3>
</div>
<div class="featured-product-stock">
<span>%s</span>
</div>
</a>
</div>',
			$type,
			\esc_url( $product_url ),
			esc_attr( $product_name ),
			$product_image,
			$product_name,
			(int) $product->get_stock_quantity()
		);
	}
	\wp_reset_query();


}
