<?php
/**
 * KableStar
 *
 * This file adds functions to the KableStar Theme.
 *
 * @package KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

include_once( 'lib/init.php' );

include_once( 'lib/functions/autoload.php' );

// Start the engine.
require_once get_template_directory() . '/lib/init.php';


// Sets the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 702; // Pixels.
}
