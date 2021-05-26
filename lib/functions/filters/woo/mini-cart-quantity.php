<?php
/**
 * KabelStar
 *
 * woocommerce_single_product_carousel_options Callback.
 *
 * Change single product gallery slider
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;



// define the woocommerce_widget_cart_item_quantity callback
add_filter( 'woocommerce_widget_cart_item_quantity', __NAMESPACE__ . '\filter_woocommerce_widget_cart_item_quantity', 10, 3 );
function filter_woocommerce_widget_cart_item_quantity( $return, $cart_item, $cart_item_key ) {
	// make filter magic happen here...
//	d($cart_item['quantity']);
//	d($cart_item_key);
//	return $return . ' Test';
//	$totals = WC()->cart->get_totals();
//	echo '<pre>';
////	d(WC()->cart);
//	d($totals['cart_contents_total']);
//	echo '</pre>';
//	$product_price = apply_filters( 'woocommerce_cart_item_price',
//		WC()->cart->get_product_price( $cart_item['data'] ),
//		$cart_item,
//		$cart_item_key
//	);

//	$cart_item_data = \WC()->cart->get_product_price( $cart_item['data'] );
	$cart_item_price = \WC()->cart->get_product_price( $cart_item['data'] );

//	$item_price      = (int) $cart_item['quantity'] * $cart_item['data']->get_price();
	$button_disabled = (int) $cart_item['quantity'] === 1 ? 'disabled=disabled' : '';
	$output          = sprintf( '<div class="mini-cart-item-detail-quantity" data-cart_item_key="%s">', $cart_item_key );
	$output          .= sprintf( '<button type="button" %s class="mini-cart-button mini-cart-button-minus" ><svg width="16" height="16" viewBox="0 0 16 16"><path d="M12 7v1H3V7z"></path></svg></button>', $button_disabled );
	$output          .= \woocommerce_quantity_input(
		array(
			'input_value' => $cart_item['quantity'],
			'min_value'   => '1',
		),
		$cart_item['data'], false );
	$output          .= '<button type="button" class="mini-cart-button mini-cart-button-plus" ><svg width="16" height="16" viewBox="0 0 16 16"><path d="M7.02 2.98h1v9h-1z"></path><path d="M12.02 6.98v1h-9v-1z"></path></svg></button>';
	$output          .= '</div>';
//	$output          .= sprintf( '<div class="mini-cart-product-totals"><span>%s</span></div>', is_decimalis_decimal( $item_price ) ? \wc_price( $item_price ) : sprintf( '%s.–', $item_price ) );
	$output          .= sprintf( '<div class="mini-cart-product-totals"><span>%s</span></div>', $cart_item_price );

	return $output;
}

//add_filter( 'woocommerce_add_to_cart_fragments', __NAMESPACE__ . '\cart_count_fragment' );
//function cart_count_fragment( $fragments ) {
//	global $woocommerce;
////	$class = $woocommerce->cart->cart_contents_count === 0 ? ' cart-info-hidden' : '';
//	$totals_raw = WC()->cart->get_totals();
//	$totals = is_decimal($totals_raw['cart_contents_total'] ) ? \wc_price( $totals_raw['cart_contents_total'] ) : sprintf('%s.–', $totals_raw['cart_contents_total']);
//	//$totals['cart_contents_total']
//
//	$fragments['span.woocommerce-Price-amount'] = '<span class="woocommerce-Price-amount amount"><bdi>'.$totals.'</bdi></span>';
//
//	return $fragments;
//}
