<?php
/**
 *
 * @package     CloudWeb\KabelStar
 * @since       1.0.0
 * @author      @valentin cloudweb team
 * @link        https://www.cloudweb.ch
 * @license     GNU General Public License 2.0+
 */

namespace CloudWeb\KabelStar;


function add_load_more_button() {
	echo '<button class="load-more" rel="load-more">Load More</button>';
}

add_action( 'wp_ajax_infinite_scroll', __NAMESPACE__ . '\infinite_scroll' );
add_action( 'wp_ajax_nopriv_infinite_scroll', __NAMESPACE__ . '\infinite_scroll' );

function infinite_scroll() {
	if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'infinite_scroll' ) ) {
		echo json_encode( 'No naughty business please' );
		wp_die();
	}

	$args = array(
		'posts_per_page' => 20,
	);

	$args['cat']         = absint( $_GET['category_id'] );
	$args['paged']       = absint( $_GET['page'] );
	$args['post_status'] = 'publish';

	$output = '';


	$products = get_site_posts( 'product', $args );
//	d( $products );
	if ( ! $products->have_posts() ) {
		return false;
	}
	ob_start();
	while ( $products->have_posts() ) {
		$products->the_post();
		$product_id    = \get_the_ID();
		$classes       = get_post_class( '', $product_id );
		$product_image = get_the_featured_image( $product_id, 'full', true );
		$product       = new \WC_Product( $product_id );
//		$product_price = is_decimal( $product->get_price() ) ? $product->get_price() : sprintf( '%s.–', $product->get_price() );
		$product_sku = $product->get_sku();
		$product_price_raw = $product->get_price();
		$product_price  = $product->get_price_html();
		$product_name   = $product->get_name();
		$product_name_bold = get_first_word( $product_name );
		$product_url    = get_permalink( $product->get_id() );
		$terms          = get_the_terms( $product_id, 'product_cat' );
		$term_permalink = get_term_link( $terms[0]->term_id, 'product_cat' );
		$term_name      = $terms[0]->name;
		$stock_class    = get_stock_icon_class( $product );


		$output .= sprintf( '<li class="%1$s">
	<div class="above-product-info">
		<div class="above-product-category">
			<a href="%2$s" title="%3$s" rel="tag">%4$s</a>
		</div>
		<div class="above-product-stock">
			<span class="stock-icon %5$s"><i></i></span>
		</div>
	</div>
	<a href="%6$s" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
		<span class="gtm4wp_productdata" style="display:none; visibility:hidden;" data-gtm4wp_product_id="%7$s" data-gtm4wp_product_name="%8$s" data-gtm4wp_product_price="%9$s" data-gtm4wp_product_cat="%3$s" data-gtm4wp_product_url="%6$s" data-gtm4wp_product_listposition="" data-gtm4wp_productlist_name="General Product List" data-gtm4wp_product_stocklevel="200" data-gtm4wp_product_brand=""></span>
		%10$s
	</a>
	<div class="details-wrapper">
	    <div class="details-wrapper-details">
			<p class="price">%11$s</p>
			<h2 class="woocommerce-loop-product__title">%12$s</h2>
		</div>
		<div class="details-wrapper-cart">
			<a href="?add-to-cart=%7$s" 
				data-quantity="1" 
				class="button product_type_simple add_to_cart_button ajax_add_to_cart" 
				data-product_id="%7$s" 
				data-product_sku="%13$s" 
				aria-label="%s" rel="nofollow">
				<i class="fal fa-cart-plus"></i>
			</a>
		</div>
	</div>
</li>',
			esc_attr( implode( ' ', $classes ) ),
			\esc_url( $term_permalink ), //2
			esc_attr( $term_name ), //3
			esc_html( $term_name ), //4
			esc_attr( $stock_class ), //5
			esc_url( $product_url ), //6
			$product_id, //7
			esc_attr($product_name), //8
			$product_price_raw, //9
			$product_image, //10
			$product_price, //11
			$product_name_bold, //12
			$product_sku, //13
		);

	}
	if ( $_GET['page'] < $products->max_num_pages ) {
		$output .= '<button class="load-more" rel="load-more">Load More</button>';
	}
	\wp_reset_query();

	$output .= \ob_get_clean();

	\wp_send_json_success( $output );

	wp_die();
}
