<?php

/**
 * KabelStar
 *
 * This file adds add new admin functionalities
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/**
 * Loads admin files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_custom_admin_files() {
	$filenames = array(
		'custom/admin/product-custom-columns/index.php',
		'custom/admin/ajax/index.php',
	);
	load_specified_files( $filenames );
}

load_custom_admin_files();

//add_action( 'rest_api_init', __NAMESPACE__ .'\update_api_products_meta_field' );
//
//function update_api_products_meta_field() {
//
//	// register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
//	register_rest_field( 'product', 'categories',
//		array(
//			'get_callback'    => function ( $object ) {
//
//				$terms = get_the_terms ( $object['id'], 'product_cat' );
//
//				$cotegories = [];
//				foreach ( $terms as $term ) {
//					$cotegories[] = [
//						'id'        => $term->term_id,
//						'name'      => $term->name,
//						'slug'      => $term->slug,
//						'permalink' => get_term_link( $terms[0]->term_id, 'product_cat' )
//					];
//				}
//
//				return $cotegories;
//
//                },
//			'update_callback' => null,
//			'schema'          => null,
//		)
//	);
//}
