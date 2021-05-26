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

function add_shipping_time(){
	global $product;
	$shipping_time = $product->get_attribute( 'shipping-time' );

	printf('<div class="shipping-time"><p><span class="dashicons dashicons-smiley"></span> %s <span>%s %s</span></p></div>',
__('Lieferzeit ca.', 'kabelstar'),
		$shipping_time,
		__('Tage', 'kabelstar'),);
}
