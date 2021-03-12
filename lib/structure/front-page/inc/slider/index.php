<?php
/**
 * KabelStar
 *
 * This file adds front page structure files - the slider section.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_the_slider() {
	$slides = get_field( 'slide' );
	$html   = '<div class="front-slider" rel="slider">';
	foreach ( $slides as $slide ) {
		$slide_group  = $slide['content'];
		$image        = $slide_group['image'];
		$image_url    = $image['sizes']['front-slide'];
		$image_alt    = $image['alt'] ? $image['alt'] : $image['title'];
		$image_width  = $image['sizes']['front-slide-width'];
		$image_height = $image['sizes']['front-slide-height'];
		$text_group   = $slide_group['text_group'];
		$small_text   = $text_group['small_text'];
		$big_text     = $text_group['big_text'];
//		d($image);
//		d( $slide );
		$html .= sprintf( '<div class="front-slide">
<div class="front-slide-visual">
<img src="%s" alt="%s" width="%s" height="%s">
</div>
<div class="front-slide-excerpt">
<span>%s</span>
<p>%s</p>
</div>
</div>',
			esc_url( $image_url ),
			esc_attr( $image_alt ),
			(int) $image_width,
			(int) $image_height,
			esc_html( $small_text ),
			esc_html( $big_text )
		);
	}

	$html .= '</div>';

	return $html;
}
