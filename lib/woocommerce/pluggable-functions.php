<?php
/**
 * KabelStar
 *
 * Rewrite pluggable woocommerce functions
 * woocommerce/includes/wc-template-functions.php
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

//namespace CloudWeb\KabelStar;

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function woocommerce_template_loop_product_title() {
		printf('<h3 class="%s">%s</h3>',
			esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ),
			CloudWeb\KabelStar\get_first_word( get_the_title() )
		);
	}
}

//if ( ! function_exists( 'woocommerce_template_single_excerpt' ) ) {
//	function woocommerce_template_single_excerpt() {
//		return false;
//	}
//}
