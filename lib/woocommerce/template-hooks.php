<?php
/**
 * KabelStar
 *
 * This file adds and remove woocommerce hooks.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

include_once __DIR__ . '/hooks/index.php';


\add_filter('woocommerce_short_description', '__return_false');
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//add_action('woocommerce_after_add_to_cart_form', __NAMESPACE__ . '\add_shipping_time');
add_action('after_stock_string', __NAMESPACE__ . '\add_shipping_time');
