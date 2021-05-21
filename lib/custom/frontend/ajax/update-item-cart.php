<?php

/**
 * Update item on cart when the quantity changes
 *
 * @package KabelStar
 * @snippet AJAX Event Featured Day Handler
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */


namespace CloudWeb\KabelStar;

add_action( 'wp_ajax_update_item_from_cart', __NAMESPACE__ . '\update_item_from_cart' );
add_action( 'wp_ajax_nopriv_update_item_from_cart', __NAMESPACE__ . '\update_item_from_cart' );

function update_item_from_cart() {
	$cart_item_key = $_POST['cart_item_key'];

	if ( ! isset( \WC()->cart->get_cart()[ $cart_item_key ] ) ) {
		\wp_die();
	}

	$values = \WC()->cart->get_cart()[ $cart_item_key ];

	$_product = $values['data'];

	// Sanitize
	$quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var( $_POST['qty'], FILTER_SANITIZE_NUMBER_INT ) ) ), $cart_item_key );

	if ( '' === $quantity || $quantity == $values['quantity'] ) {
		\wp_die();
	}

	// Update cart validation
	$passed_validation = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $values, $quantity );

	// is_sold_individually
	if ( $_product->is_sold_individually() && $quantity > 1 ) {
		\wc_add_notice( sprintf( __( 'You can only have 1 %s in your cart.', 'kablestar' ), $_product->get_title() ), 'error' );
		$passed_validation = false;
	}

	if ( $passed_validation ) {
		\WC()->cart->set_quantity( $cart_item_key, $quantity, false );
	}

	WC()->cart->calculate_totals();
	WC()->cart->maybe_set_cart_cookies();
//	echo 'Something';
	\wp_die();
}
