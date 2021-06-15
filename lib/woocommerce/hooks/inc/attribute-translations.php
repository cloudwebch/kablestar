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

function custom_attribute_label( $label, $name, $product ) {
//	$array = array('pa_t-1','pa_taille-2','pa_taille-3','pa_t-4','pa_taille-5','pa_taille-v6','pa_taille-v7','pa_taille-v8','pa_taille-p9','pa_taille-d10');
//	$taxonomy = 'pa_'.$name;

	switch($label){
		case 'Brand':
			$label = 'Marke';
			break;
		case 'Color':
			$label = 'Farbe';
			break;
		case 'Gender':
			$label = 'Geeignet für';
			break;
		case 'Shipping time':
			$label = 'Dauer Versand (Tage)';
			break;
		case 'Number of packages':
			$label = 'Anzahl Paket(e)';
			break;
	}
//	d($label);
//	d($name);
	return $label;
}
