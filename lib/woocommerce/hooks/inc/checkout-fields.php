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

add_filter( 'woocommerce_default_address_fields' , __NAMESPACE__ . '\rename_address_placeholders_checkout', 9999 );

function rename_address_placeholders_checkout( $address_fields ) {
//	d($address_fields);
	//$address_fields['address_1']['label'] = 'Straße';
	$address_fields['address_1']['placeholder'] = '';
	//$address_fields['address_1']['class'] = ['form-row-first', 'form-row-three-thirds', 'form-row'];
	$address_fields['postcode']['class'] = ['form-row-first', 'form-row-one-third', 'form-row', 'address-field'];
	$address_fields['city']['class'] = ['form-row-last', 'form-row-three-thirds', 'form-row', 'address-field'];

	return $address_fields;
}

add_filter('woocommerce_billing_fields',__NAMESPACE__ . '\custom_billing_fields');
function custom_billing_fields( $fields = array() ) {

	unset($fields['billing_address_2']);
	unset($fields['billing_state']);

	return $fields;
}

add_filter( 'woocommerce_checkout_fields' , __NAMESPACE__ . '\add_field_and_reorder_fields' );
function add_field_and_reorder_fields( $fields ) {

	unset($fields['billing']['billing_address_2']);
	unset($fields['shipping']['shipping_address_2']);
	unset($fields['shipping']['shipping_state']);

	// Add New Fields

	// $fields['billing']['billing_houseno'] = array(
	// 	'label'     => 'Hausnummer',
	// 	'placeholder'   => '',
	// 	'priority' => 51,
	// 	'required'  => true,
	// 	'clear'     => true,
	// 	'class'     => array('form-row-last', 'form-row-one-third', 'form-row'),
	// );
	//
	// $fields['shipping']['shipping_houseno'] = array(
	// 	'label'     => 'Hausnummer',
	// 	'placeholder'   => '',
	// 	'priority' => 51,
	// 	'required'  => true,
	// 	'clear'     => true,
	// 	'class'     => array('form-row-last', 'form-row-one-third', 'form-row'),
	// );

	return $fields;
}


//add_filter( 'woocommerce_order_formatted_billing_address' , __NAMESPACE__ . '\default_billing_address_fields', 10, 2 );

function default_billing_address_fields( $fields, $order ) {
	$fields['billing_houseno'] = get_post_meta( $order->get_id(), '_billing_houseno', true );
	return $fields;
}

// ------------------------------------
// Add Shipping House # to Address Fields

//add_filter( 'woocommerce_order_formatted_shipping_address' , __NAMESPACE__ . '\default_shipping_address_fields', 10, 2 );

function default_shipping_address_fields( $fields, $order ) {
	$fields['shipping_houseno'] = get_post_meta( $order->get_id(), '_shipping_houseno', true );
	return $fields;
}


//add_filter( 'woocommerce_formatted_address_replacements', __NAMESPACE__ . '\add_new_replacement_fields',10,2 );

function add_new_replacement_fields( $replacements, $address ) {
	$replacements['{billing_houseno}'] = isset($address['billing_houseno']) ? $address['billing_houseno'] : '';
	$replacements['{shipping_houseno}'] = isset($address['shipping_houseno']) ? $address['shipping_houseno'] : '';
	return $replacements;
}

// ------------------------------------
// Show Shipping & Billing House # for different countries

//add_filter( 'woocommerce_localisation_address_formats', __NAMESPACE__ . '\add_ch_address_formats' );

function add_ch_address_formats( $formats ) {

//	d($formats);
	$formats['CH'] = "{company}\n{name}\n{address_1} {billing_houseno}{shipping_houseno}\n{postcode} {city}\n{country}";
//	d($formats);
	return $formats;
}
