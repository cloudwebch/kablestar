<?php
/**
 * KabelStar
 *
 * This file adds widgets to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

// Register above footer widget.
\genesis_register_sidebar(
	array(
		'id'           => 'above-footer-widget',
		'name'         => __( 'Above Footer Widget', 'KabelStar' ),
		'description'  => __( 'Widgets in this widget area will display above the footer.', 'kabelstar' ),
		'before_title' => '<h2 class="widget-title">',
		'after_title'  => '</h2>',
	)
);


/**
 * Add above footer widget.
 */
function above_footer_widget() {

	$columns = flexible_widget_area_class( 'above-footer-widget' );

	\genesis_widget_area(
		'above-footer-widget',
		array(
			'before' => sprintf('<div class="above-footer-widget widget-area %s"><div class="wrap">', $columns),
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

function flexible_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

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

function flexible_widget_area_class( $id ) {

	$count = flexible_count_widgets( $id );

	$class = '';

	switch ($count){
		case ( 1 === $count ) :
			$class .= 'widget-full';
			break;
		case ( 0 === $count % 4 ):
			$class .= 'widget-fourths';
			break;
		case ( 0 === $count % 6 ):
			$class .= 'widget-sixts';
			break;
		case ( 1 === $count % 2 ):
			$class .= 'widget-halves uneven';
			break;
		case ( 0 === $count % 3 ):
			$class .= 'widget-thirds';
			break;
		default:
			$class .= 'widget-halves';
			break;
	}

	return $class;

}
