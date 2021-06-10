<?php
/**
 * KabelStar
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_product_archive_description(){
	$term = get_queried_object();
	$intro_text = get_term_meta( $term->term_id, 'intro_text', true );
	$intro_text = apply_filters( 'genesis_term_intro_text_output', $intro_text ? $intro_text : '' );
	$search= sprintf('<h1>%s</h1>', $term->name);
	$intro_text = str_replace ($search, '', $intro_text);
//	d($term);
//	d($intro_text);
	include_once __DIR__ . '/views/NOTINUSE-archive-description.php';
}
