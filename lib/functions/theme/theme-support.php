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
			'primary'        => __( 'Primary Menu', 'KabelStar' ),
			'secondary'      => __( 'Footer Menu', 'KabelStar' ),
			'sidebar-footer' => __( 'Sidebar Footer Navigation Menu', 'KabelStar' ),

		),
		'genesis-structural-wraps'        => array(
			'header',
			'sidebar-footer'
		),
		'editor-font-sizes' =>	array(
			array(
				'name'      => __( 'small', 'KabelStar' ),
				'shortName' => __( 'S', 'KabelStar' ),
				'size'      => 12,
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'regular', 'KabelStar' ),
				'shortName' => __( 'M', 'KabelStar' ),
				'size'      => 16,
				'slug'      => 'regular',
			),
			array(
				'name'      => __( 'large', 'KabelStar' ),
				'shortName' => __( 'L', 'KabelStar' ),
				'size'      => 20,
				'slug'      => 'large',
			),
			array(
				'name'      => __( 'larger', 'KabelStar' ),
				'shortName' => __( 'XL', 'KabelStar' ),
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
		'genesis-footer-widgets'          => 3,
		'disable-custom-colors' => true,
		'editor-color-palette' =>	array(
			array(
				'name'  => __( 'Blue', 'KabelStar' ),
				'slug'  => 'blue',
				'color' => '#0071bc',
			),
			array(
				'name'  => __( 'Red', 'KabelStar' ),
				'slug'  => 'red',
				'color' => '#e31c3d',
			),
			array(
				'name'  => __( 'Yellow', 'KabelStar' ),
				'slug'  => 'yellow',
				'color' => '#fdb81e',
			),
			array(
				'name'  => __( 'Gray', 'KabelStar' ),
				'slug'  => 'gray',
				'color' => '#323a45',
			),
		)
	);

	foreach ( $config as $feature => $args ) {
		add_theme_support( $feature, $args );
	}
}
