<?php
/**
 * KabelStar
 *
 * This file adds front page structure files - side products - highlight day
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_side_product_of_the_day() {

	return get_highlighted_product( 'day' );


}
