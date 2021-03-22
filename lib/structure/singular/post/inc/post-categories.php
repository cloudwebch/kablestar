<?php
/**
 * KabelStar
 *
 * Get the post categories.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_the_post_categories() {
	$post_categories = get_the_category();
	$parent_category = '';
	$child_cat       = '';
	foreach ( $post_categories as $post_category ) {
//		switch ($post_category->category_parent){
//			case 0:
//				$child_cat
//				break;
//			default:
//				break;
//		}
		if ( $post_category->category_parent === 0 ) {
			$parent_category .= sprintf( '<span rel="category tag">%s</span>', $post_category->cat_name );
		} else {
			$child_cat .= sprintf( '<a href="%s" rel="category tag" title="%s">%s</a>',
				get_category_link( $post_category->term_id ),
				esc_attr( $post_category->name ),
				esc_html( $post_category->name ) );
		}
	}

	return sprintf('<div class="entry-categories">%s %s</div>', $parent_category, $child_cat);

//	d( $post_categories );

}
