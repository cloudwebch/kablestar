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

use MailPoet\Subscription as mpSub;

function add_newsletter_endpoint() {
	add_rewrite_endpoint( 'newsletter-tab', EP_ROOT | EP_PAGES );
}

add_action( 'init', __NAMESPACE__ .'\add_newsletter_endpoint' );

// ------------------
// 2. Add new query var

function newsletter_tab_query_vars( $vars ) {
	$vars[] = 'newsletter-tab';
	return $vars;
}

add_filter( 'woocommerce_get_query_vars', __NAMESPACE__ . '\newsletter_tab_query_vars', 0 );

// ------------------
// 3. Insert the new endpoint into the My Account menu

function add_newsletter_tab_link_my_account( $items ) {
	$items['newsletter-tab'] = 'Newsletter';
	return $items;
}

add_filter( 'woocommerce_account_menu_items', __NAMESPACE__ . '\add_newsletter_tab_link_my_account' );

// ------------------
// 4. Add content to the new tab

function newsletter_tab_content() {
	echo '<h3>Premium WooCommerce Support</h3><p>Welcome to the WooCommerce support area. As a premium customer, you can submit a ticket should you have any WooCommerce issues with your website, snippets or customization. <i>Please contact your theme/plugin developer for theme/plugin-related support.</i></p>';

		//$mp_pages = new mpSub\Pages(NewSubscriberNotificationMailer,null,null,null,null,null,null,null,null,null,null);
	//var_dump($mp_pages);

	//echo do_shortcode( '[mailpoet_page]' );
//	$mp_page = new \WP_Query( array(
//		'p' => 7107,
//		'post_type' => 'mailpoet_page'
//	) );
//	while( $mp_page->have_posts() ) {
//		$mp_page->the_post();
//		\the_content();
//	}
//	\wp_reset_query();
	//echo do_shortcode( $mp_page->post_content );
}

add_action( 'woocommerce_account_newsletter-tab_endpoint', __NAMESPACE__ . '\newsletter_tab_content', 99 );
