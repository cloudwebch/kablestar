<?php
/**
 * Setup the templates
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

function site_page_layout() {
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
//	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content_sidebar' );
//	add_filter( 'genesis_breadcrumb_args', __NAMESPACE__ . '\breadcrumb_args' );
	add_filter( 'wpseo_breadcrumb_output', __NAMESPACE__ . '\wpseo_breadcrumb_output' );
	add_action( 'genesis_before_header', 'genesis_do_subnav' );
	add_action( 'genesis_header', __NAMESPACE__ . '\get_product_search_box', 12 );
	add_action( 'genesis_header', __NAMESPACE__ . '\add_loginout_buttons', 13 );

	if ( is_front_page() && ! is_home() ) {
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
		remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );
		\add_action( 'genesis_entry_content', __NAMESPACE__ . '\get_front_page_entry_content' );
		\add_action( 'genesis_entry_content', __NAMESPACE__ . '\get_latest_products' );
		add_action( 'genesis_sidebar_alt', __NAMESPACE__ . '\get_aside_section' );
	}
	if ( is_product() ) {

		add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
		add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );
		add_filter( 'woocommerce_format_sale_price', __NAMESPACE__ . '\format_sale_price', 10, 3 );

		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

		add_action( 'wc_price', __NAMESPACE__ . '\wc_price', 10, 4 ); //filters/woo/wc-price.php
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title' );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating' );
		add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
		add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 11 );
	}

	if ( is_singular( 'post' ) ) {
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

		add_action( 'genesis_entry_header', __NAMESPACE__ . '\singular_post_featured_image', 6 );
		add_action( 'genesis_entry_header', __NAMESPACE__ . '\above_header_section', 7 );
//		add_action( 'genesis_entry_header', __NAMESPACE__ . '\get_the_post_categories', 7 );
	}

	if( is_shop() || is_product_category() ){
		remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
		remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
		add_filter( 'woocommerce_format_sale_price', __NAMESPACE__ . '\format_sale_price', 10, 3 );
		add_action( 'wc_price', __NAMESPACE__ . '\wc_price', 10, 4 ); //filters/woo/wc-price.php
		add_action('woocommerce_before_shop_loop_item', __NAMESPACE__ . '\above_product', 9);
//		add_action('woocommerce_before_shop_loop_item', function(){
//			echo 'Stock';
//		}, 9);

		add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
		add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
		remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
		remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');

		add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price');
		add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
		add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating');
	}
}
