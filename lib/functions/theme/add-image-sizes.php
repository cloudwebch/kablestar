<?php
/**
 * KabelStar
 *
 * This file register custom image sizes to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/**
 * Adds new image sizes.
 *
 * @return void
 * @since 1.0.0
 *
 */
add_action( 'after_setup_theme', __NAMESPACE__ . '\adds_new_image_sizes' );
function adds_new_image_sizes() {
	$config = array(
		'front-slide' => array(
			'width'  => 764,
			'height' => 382,
			'crop'   => true,
		),
		'featured-product' => array(
			'width'  => 365,
			'height' => 185,
			'crop'   => true,
		),
		'side-featured-product' => array(
			'width'  => 268,
			'height' => 135,
			'crop'   => true,
		),
		'post' => array(
			'width'  => 828,
			'height' => 414,
			'crop'   => true,
		),


	);

	foreach ( $config as $name => $args ) {
		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;

		add_image_size( $name, $args['width'], $args['height'], $crop );
	}
}
