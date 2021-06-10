<?php
/**
 * This is some madness from genesis || yoast
 * @package     CloudWeb\KabelStar
 * @since       1.0.0
 * @author      @valentin cloudweb team
 * @link        https://www.cloudweb.ch
 * @license     GNU General Public License 2.0+
 */

namespace CloudWeb\KabelStar;

add_action('get_header', __NAMESPACE__ . '\genesis_breadcrumbs_over_yoast_breadcrumbs');

function genesis_breadcrumbs_over_yoast_breadcrumbs() {

	$wpseo_crumbs = get_option( 'wpseo_internallinks' );

	if ( function_exists( 'yoast_breadcrumb' ) && $wpseo_crumbs[ 'breadcrumbs-enable' ] !== true ) {
		// When Yoast SEO is activated, Genesis crumbs disappear
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Replace default genesis breadcrumbs with modified breadcrumbs to remove Yoast breadcrumbs
		// Replace genesis_before_loop with another hook if you want to move breadcrumb locations
		add_action( 'genesis_before_loop', __NAMESPACE__ . '\do_breadcrumbs' );
	}

}

function do_breadcrumbs() {

	if (
		( ( 'posts' === get_option( 'show_on_front' ) && is_home() ) && ! genesis_get_option( 'breadcrumb_home' ) ) ||
		( ( 'page' === get_option( 'show_on_front' ) && is_front_page() ) && ! genesis_get_option( 'breadcrumb_front_page' ) ) ||
		( ( 'page' === get_option( 'show_on_front' ) && is_home() ) && ! genesis_get_option( 'breadcrumb_posts_page' ) ) ||
		( is_single() && ! genesis_get_option( 'breadcrumb_single' ) ) ||
		( is_page() && ! genesis_get_option( 'breadcrumb_page' ) ) ||
		( ( is_archive() || is_search() ) && ! genesis_get_option( 'breadcrumb_archive' ) ) ||
		( is_404() && ! genesis_get_option( 'breadcrumb_404' ) ) ||
		( is_attachment() && ! genesis_get_option( 'breadcrumb_attachment' ) )
	)
		return;

	if ( function_exists( 'bcn_display' ) ) {
		echo '<div class="breadcrumb" itemprop="breadcrumb">';
		bcn_display();
		echo '</div>';
	}
	/*
	* Remove Yoast function if Yoast function is not enabled
	* See abte_genesis_breadcrumbs_over_yoast_breadcrumbs() function above
	*

	*/
	elseif ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
	}

	elseif ( function_exists( 'breadcrumbs' ) ) {
		breadcrumbs();
	}
	elseif ( function_exists( 'crumbs' ) ) {
		crumbs();
	}
	else {
		genesis_breadcrumb();
	}

}
