<?php
/**
 * KabelStar
 *
 * This file adds theme support functions to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function adds_theme_supports() {

	$config = array(
		'html5'                           => array(
			'navigation-widgets',
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
			'style',
        	'script',
        	'custom-line-height',
        	'custom-units' => array('rem')
		),
		'genesis-accessibility'           => array(
			'404-page',
			'drop-down-menu',
			'headings',
			'rems',
			'search-form',
			'skip-links'
		),

		'custom-logo'                     => array(
			'width'       => 600,
			'height'      => 160,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		),
		'post-formats' => array( 'aside', 'gallery', 'link', 'video' ),
		'genesis-menus'                   => array(
			'primary'        => __( 'Primary Menu', 'kabelstar' ),
			'secondary'      => __( 'Top Menu', 'kabelstar' ),
		),
		'genesis-structural-wraps'        => array(
			'header',
		),
		'editor-font-sizes' =>	array(
			array(
				'name'      => __( 'small', 'kabelstar' ),
				'shortName' => __( 'S', 'kabelstar' ),
				'size'      => 12,
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'regular', 'kabelstar' ),
				'shortName' => __( 'M', 'kabelstar' ),
				'size'      => 16,
				'slug'      => 'regular',
			),
			array(
				'name'      => __( 'large', 'kabelstar' ),
				'shortName' => __( 'L', 'kabelstar' ),
				'size'      => 20,
				'slug'      => 'large',
			),
			array(
				'name'      => __( 'larger', 'kabelstar' ),
				'shortName' => __( 'XL', 'kabelstar' ),
				'size'      => 24,
				'slug'      => 'larger',
			),
		),

		'genesis-responsive-viewport'     => true,
		'custom-header'                   => false,
		'align-wide'					  => true,
		'genesis-custom-header'           => null,
		'custom-background'               => true,
		'genesis-after-entry-widget-area' => true,
		'genesis-footer-widgets'          => 6,
		'disable-custom-colors' => true,
		'editor-color-palette' =>	array(
			array(
				'name'  => __( 'Blue', 'kabelstar' ),
				'slug'  => 'blue',
				'color' => '#0071bc',
			),
			array(
				'name'  => __( 'Red', 'kabelstar' ),
				'slug'  => 'red',
				'color' => '#e31c3d',
			),
			array(
				'name'  => __( 'Yellow', 'kabelstar' ),
				'slug'  => 'yellow',
				'color' => '#fdb81e',
			),
			array(
				'name'  => __( 'Gray', 'kabelstar' ),
				'slug'  => 'gray',
				'color' => '#323a45',
			),
		)
	);

	foreach ( $config as $feature => $args ) {
		add_theme_support( $feature, $args );
	}
}
