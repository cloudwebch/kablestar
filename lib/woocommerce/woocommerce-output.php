<?php
/**
 * KabelStar.
 *
 * This file adds the WooCommerce styles and the Customizer additions for WooCommerce to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_filter( 'woocommerce_enqueue_styles', __NAMESPACE__ . '\woocommerce_styles' );
/**
 * Enqueue the theme's custom WooCommerce styles to the WooCommerce plugin.
 *
 * @since 2.3.0
 *
 * @param  array $enqueue_styles Styles array.
 *
 * @return array Required values for the Digital Creative Genesis Theme's WooCommerce stylesheet.
 */
function woocommerce_styles( $enqueue_styles ) {

	$enqueue_styles[CHILD_TEXT_DOMAIN . '-woocommerce-styles'] = array(
		'src'     => CHILD_DIRECTORY . '/lib/woocommerce/genesis-woocommerce.css',
		'deps'    => '',
		'version' => CHILD_THEME_VERSION,
		'media'   => 'screen',
	);

	return $enqueue_styles;

}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\woocommerce_css' );
/**
 * Add the themes's custom CSS to the WooCommerce stylesheet.
 *
 * @since 2.3.0
 *
 * @return string CSS to be outputted after the theme's custom WooCommerce stylesheet.
 */
function woocommerce_css() {

	// If WooCommerce isn't active, exit early.
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$color_link   = get_theme_mod( 'link_color', customizer_get_default_link_color() );
	$color_accent = get_theme_mod( 'accent_color', customizer_get_default_accent_color() );

	$woo_css = '';

	$woo_css .= ( customizer_get_default_link_color() !== $color_link ) ? sprintf(
		'.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
		.woocommerce ul.products li.product h3:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce .woocommerce-breadcrumb a:focus,
		.woocommerce .widget_layered_nav ul li.chosen a::before,
		.woocommerce .widget_layered_nav_filters ul li a::before,
		.woocommerce .widget_rating_filter ul li.chosen a::before {
			color: %s;
		}',
		$color_link
	) : '';

	$woo_css .= ( customizer_get_default_accent_color() !== $color_accent ) ? sprintf(
		'.woocommerce a.button:hover,
		.woocommerce a.button:focus,
		.woocommerce a.button.alt:hover,
		.woocommerce a.button.alt:focus,
		.woocommerce button.button:hover,
		.woocommerce button.button:focus,
		.woocommerce button.button.alt:hover,
		.woocommerce button.button.alt:focus,
		.woocommerce input.button:hover,
		.woocommerce input.button:focus,
		.woocommerce input.button.alt:hover,
		.woocommerce input.button.alt:focus,
		.woocommerce input[type="submit"]:hover,
		.woocommerce input[type="submit"]:focus,
		.woocommerce span.onsale,
		.woocommerce #respond input#submit:hover,
		.woocommerce #respond input#submit:focus,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce #respond input#submit.alt:focus,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-range {
			background-color: %1$s;
			color: %2$s;
		}

		.woocommerce-error,
		.woocommerce-info,
		.woocommerce-message {
			border-top-color: %1$s;
		}

		.woocommerce-error::before,
		.woocommerce-info::before,
		.woocommerce-message::before {
			color: %1$s;
		}',
		$color_accent,
		color_contrast( $color_accent )
	) : '';

	if ( $woo_css ) {
		wp_add_inline_style( CHILD_TEXT_DOMAIN  . '-woocommerce-styles', $woo_css );
	}

}
