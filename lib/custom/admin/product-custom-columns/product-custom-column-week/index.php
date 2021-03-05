<?php

/**
 * KabelStar
 *
 * @package KabelStar
 * @snippet New Product Table Column Featured of the week @ WooCommerce Admin
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */


namespace CloudWeb\KabelStar;

add_filter( 'manage_edit-product_columns', __NAMESPACE__ . '\admin_products_featured_week_column', 9999 );
function admin_products_featured_week_column( $columns ){
	$featured_week = '<span class="wc-featured wc-privacy parent-tips" data-tip="Featured Week">Featured Week</span>';
	return array_slice( $columns, 0, 8, true ) + array( 'featured_week' => $featured_week ) + array_slice( $columns, 8, count( $columns ) - 8, true );

}

add_action( 'manage_product_posts_custom_column',  __NAMESPACE__ . '\admin_products_featured_week_column_content', 10, 2 );
function admin_products_featured_week_column_content( $column, $product_id ){
	if ( $column === 'featured_week' ) {
		$featured_week = get_post_meta( $product_id, 'featured_week', true );
//ddd($featured_week);
		$url = wp_nonce_url( admin_url( 'admin-ajax.php?action=handle_featured_week&product_id=' . $product_id ), 'handle-featured-week' );
		echo '<a href="' . esc_url( $url ) . '" aria-label="' . esc_attr__( 'Toggle featured week', 'kabelstar' ) . '">';
		if ( $featured_week === 'yes' ) {
			echo '<span class="wc-featured wc-privacy tips" data-tip="' . esc_attr__( 'Yes', 'kabelstar' ) . '">' . esc_html__( 'Yes', 'kabelstar' ) . '</span>';
		} else {
			echo '<span class="wc-featured wc-privacy not-privacy tips" data-tip="' . esc_attr__( 'No', 'kabelstar' ) . '">' . esc_html__( 'No', 'kabelstar' ) . '</span>';
		}
		echo '</a>';
	}
}
