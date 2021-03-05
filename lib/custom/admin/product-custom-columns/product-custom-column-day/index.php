<?php

/**
 * KabelStar
 *
 * @package KabelStar
 * @snippet New Product Table Column Highlight of the day @ WooCommerce Admin
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */


namespace CloudWeb\KabelStar;

add_filter( 'manage_edit-product_columns', __NAMESPACE__ . '\admin_products_featured_day_column', 9999 );

function admin_products_featured_day_column( $columns ){
	$featured_day = '<span class="wc-featured wc-thumbs-up parent-tips" data-tip="Featured Day">Featured Day</span>';
	return array_slice( $columns, 0, 8, true ) + array( 'featured_day' => $featured_day ) + array_slice( $columns, 8, count( $columns ) - 8, true );

}

add_action( 'manage_product_posts_custom_column',  __NAMESPACE__ . '\admin_products_featured_day_column_content', 10, 2 );

function admin_products_featured_day_column_content( $column, $product_id ){
	if ( $column === 'featured_day' ) {
		$featured_day = get_post_meta( $product_id, 'featured_day', true );

		$url = wp_nonce_url( admin_url( 'admin-ajax.php?action=handle_featured_day&product_id=' . $product_id ), 'handle-featured-day' );
		echo '<a href="' . esc_url( $url ) . '" aria-label="' . esc_attr__( 'Toggle featured day', 'kabelstar' ) . '">';
		if ( $featured_day === 'yes' ) {
			echo '<span class="wc-featured wc-thumbs-up tips" data-tip="' . esc_attr__( 'Yes', 'kabelstar' ) . '">' . esc_html__( 'Yes', 'kabelstar' ) . '</span>';
		} else {
			echo '<span class="wc-featured wc-thumbs-up not-thumbs-up tips" data-tip="' . esc_attr__( 'No', 'kabelstar' ) . '">' . esc_html__( 'No', 'kabelstar' ) . '</span>';
		}
		echo '</a>';
	}
}
