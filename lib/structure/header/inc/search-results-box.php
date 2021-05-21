<?php
/**
 * KabelStar
 *
 * Header structure files - login/logout block
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_search_box_results(){
	printf('<div class="latest-seen-products"><div class="latest-seen-products-wrap"><h4>%s</h4><ul rel="last-seen-products"></ul></div></div>', __('Zuleyzt besuchte Produkte', 'kablestar'));
}


