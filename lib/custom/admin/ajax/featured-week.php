<?php

/**
 * KabelStar
 *
 * @package KabelStar
 * @snippet AJAX Event Featured Day Handler
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */


namespace CloudWeb\KabelStar;

add_action('wp_ajax_handle_featured_week', __NAMESPACE__ . '\handle_featured_week');
function handle_featured_week() {
	if ( current_user_can( 'edit_products' ) &&
	     check_admin_referer( 'handle-featured-week' ) && isset( $_GET['product_id'] ) ) {
		$product = new \WC_Product( absint( $_GET['product_id'] ) );
		$product_id = $product->get_id();

		if ( $product ) {
			$featured = get_post_meta( $product_id, 'featured_week', true );
			if ( $featured === 'yes' ) {
				update_post_meta( $product_id, 'featured_week', 'no' );
			} else {
				update_post_meta( $product_id, 'featured_week', 'yes' );
			}
			$product->save();
		}
	}

	wp_safe_redirect( wp_get_referer() ? remove_query_arg( array(
		'trashed',
		'untrashed',
		'deleted',
		'ids'
	), wp_get_referer() ) : admin_url( 'edit.php?post_type=product' ) );
	exit;
}
