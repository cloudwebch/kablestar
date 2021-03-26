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

namespace CloudWeb\KabelStar;


///**
// * Show the product title in the product loop. By default this is an H2.
// * line 1151
// */
//if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
//	function woocommerce_template_loop_product_title() {
//		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_first_word( get_the_title() ) . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
//	}
//}
