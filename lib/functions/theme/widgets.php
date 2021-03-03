<?php
/**
 * KableStar
 *
 * This file adds widgets to the KableStar Theme.
 *
 * @package KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

// Register top widget.
genesis_register_sidebar(
	array(
		'id'          => 'top-widget',
		'name'        => __( 'Top Widget', 'genesis' ),
		'description' => __( 'Widgets in this widget area will display above the header.', 'kablestar' ),
	)
);

// Banner widget area.
genesis_register_sidebar(
	array(
		'id'           => 'banner-widget',
		'name'         => __( 'Banner Widget', 'kablestar' ),
		'description'  => __( 'Widgets in this widget area will display in the banner on the homepage.', 'kablestar' ),
		'before_title' => '<h1 class="widget-title">',
		'after_title'  => '</h1>',
	)
);

// Register above footer widget.
genesis_register_sidebar(
	array(
		'id'           => 'above-footer-widget',
		'name'         => __( 'Above Footer Widget', 'kablestar' ),
		'description'  => __( 'Widgets in this widget area will display above the footer.', 'kablestar' ),
		'before_title' => '<h2 class="widget-title">',
		'after_title'  => '</h2>',
	)
);

add_action( 'genesis_before_header', __NAMESPACE__ . '\top_widget' );
/**
 * Add top widget.
 */
function top_widget() {
	genesis_widget_area(
		'top-widget',
		array(
			'before' => '<div class="top-widget widget-area">',
			'after'  => '</div>',
		)
	);
}

add_action( 'genesis_before_footer', __NAMESPACE__ . '\above_footer_widget', 5 );
/**
 * Add above footer widget.
 */
function above_footer_widget() {
	genesis_widget_area(
		'above-footer-widget',
		array(
			'before' => '<div class="above-footer-widget widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		)
	);
}

/**
 * Function to output widget counts.
 *
 * @since 1.0.0
 *
 * @param  string $id The widget area id.
 * @return int        Number of active widgets in the widget area.
 */
function count_widgets( $id ) {

	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

/**
 * Function to get the flexible widget area class.
 *
 * @since 1.0.0
 *
 * @param  string $id    The widget area id.
 * @return string $class The appropriate class for the amount of widgets.
 */
function widget_area_class( $id ) {

	$count = count_widgets( $id );

	$class = '';

	if ( 1 === $count ) {
		$class .= ' widget-full';
	} elseif ( 1 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 1 === $count % 4 ) {
		$class .= ' widget-fourths';
	} elseif ( 0 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves even';
	}

	/*
	Uncomment if you don't want a full-width widget for the first widget
	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count == 2 ) {
		$class .= ' widget-halves';
	} elseif( $count == 3 ) {
		$class .= ' widget-thirds';
	} elseif( $count == 4 ) {
		$class .= ' widget-fourths';
	} else {
		$class .= ' widget-halves even';
	}
	*/

	return $class;

}
