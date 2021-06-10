<?php
/**
 * KabelStar
 *
 * Breadcrumb filter.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function wpseo_breadcrumb_output( $output ) {

	if ( ! is_product() ) {
		return $output;
	}
	global $product;
	$terms          = get_the_terms( $product->ID, 'product_cat' );
	$cat_breadcrumb = '';
//	d( $terms );
	foreach ( $terms as $term ) {
//		$product_cat = $term->name;
		$cat_breadcrumb = sprintf( '<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a class="breadcrumb-link" href="%1$s" itemprop="item" title="%2$s"><span class="breadcrumb-link-text-wrap" itemprop="name">%2$s</span></a></span>',
			esc_url( $term_link = get_term_link( $term ) ),
			$term->name
		);
		break;
	}
//	d($product_cat);
//	d( $output );

	$from = sprintf( '<a href="%s/shop/">Shop</a> ', site_url() );

	$to = sprintf( '<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
<a class="breadcrumb-link" href="%s/shop/" itemprop="item" title="Shop"><span class="breadcrumb-link-text-wrap" itemprop="name">Shop</span></a></span>
<span aria-label="breadcrumb separator"><svg width="14" height="14" viewBox="0 0 14 14"><path d="M5.518 2.849l5.657 5.657-.707.707L4.81 3.556z"></path><path d="M4.812 13.445l5.657-5.657.707.707-5.657 5.657z"></path></svg></span>%s', site_url(), $cat_breadcrumb );

	$output = str_replace( $from, $to, $output );

	return $output;
}

function filter_wpseo_breadcrumb_separator( $this_options_breadcrumbs_sep ) {
	return '<span class="breadcrumb-separator" aria-label="breadcrumb separator"><svg width="14" height="14" viewBox="0 0 14 14"><path d="M5.518 2.849l5.657 5.657-.707.707L4.81 3.556z"></path><path d="M4.812 13.445l5.657-5.657.707.707-5.657 5.657z"></path></svg></span>';
}

// add the filter
add_filter( 'wpseo_breadcrumb_separator', __NAMESPACE__ . '\filter_wpseo_breadcrumb_separator', 10, 1 );

function breadcrumb_args( $args ) {
//	$args['home'] = 'Homee';
	$args['labels']['prefix'] = '';
//	d($args);
	$args['sep'] = '<span aria-label="breadcrumb separator"><svg width="14" height="14" viewBox="0 0 14 14"><path d="M5.518 2.849l5.657 5.657-.707.707L4.81 3.556z"></path><path d="M4.812 13.445l5.657-5.657.707.707-5.657 5.657z"></path></svg></span>';

	return $args;
}
