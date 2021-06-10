<?php
/**
 *
 * @package     CloudWeb\KabelStar
 * @since       1.0.0
 * @author      @valentin cloudweb team
 * @link        https://www.cloudweb.ch
 * @license     GNU General Public License 2.0+
 */

namespace CloudWeb\KabelStar;

add_action( 'woocommerce_before_cart', __NAMESPACE__ .'\add_notice_free_shipping' );
add_action( 'woocommerce_before_checkout_form', __NAMESPACE__ .'\add_notice_free_shipping' );
add_filter( 'woocommerce_package_rates', __NAMESPACE__ .'\hide_shipping_when_free_is_available' );

function add_notice_free_shipping() {
	$chosen_methods = \WC()->session->get( 'chosen_shipping_methods' );

	$free_shipping_settings = get_option('woocommerce_free_shipping_2_settings');
	$amount_for_free_shipping = $free_shipping_settings['min_amount'];

//var_dump($amount_for_free_shipping);

	$cart = WC()->cart->subtotal;
	$remaining = $amount_for_free_shipping - $cart;

	if( $amount_for_free_shipping > $cart ){
		$notice = sprintf( "Fügen Sie %s Ihrem Warenkorb hinzu für eine gratis Lieferung.", wc_price($remaining));
		wc_print_notice( $notice , 'notice' );
	}

}


function hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach( $rates as $rate_id => $rate ) {
		if( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}

	return ! empty( $free ) ? $free : $rates;
}
