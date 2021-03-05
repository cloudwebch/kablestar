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

	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );
	add_action( 'genesis_before_header', 'genesis_do_subnav' );
	if(is_front_page() && !is_home()){
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );
		\add_action('genesis_entry_content', __NAMESPACE__ . '\get_front_page_entry_content');
//		\add_action('genesis_entry_content', __NAMESPACE__ . '\get_featured_products');
//		\add_action('genesis_entry_content', __NAMESPACE__ . '\get_side_product_of_the_day');
//		\add_action('genesis_entry_content', __NAMESPACE__ . '\get_side_product_of_the_week');
	}
}
