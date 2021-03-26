<?php
/**
 * KabelStar
 *
 * Breadcrumb filter.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_filter( 'wp_nav_menu_items', __NAMESPACE__ . '\primary_menu_extras', 10, 2 );
/**
 * Filter menu items, appending either a search form or today's date.
 *
 * @param string $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */
function primary_menu_extras( $menu, $args ) {
	if ( ! is_product_category() ) {
		return $menu;
	}
//	d(is_product_category());
	if ( 'Side Menu' !== $args->menu->name  ) {
		return $menu;
	}
	$shop_page_id    = woocommerce_get_page_id( 'shop' );
	$shop_page_url   = get_permalink( $shop_page_id );
	$shop_page_title = \get_the_title( $shop_page_id );
	$back_menu_item  = sprintf( '<li class="menu-item menu-item-back"><a href="%s" title="%s">%s</a></li>',
		esc_url( $shop_page_url ),
		esc_attr( $shop_page_title ),
	\__('Zum Hauptmenu', 'kabelstar')
	);

	return sprintf( '%s%s', $back_menu_item, $menu );

}
