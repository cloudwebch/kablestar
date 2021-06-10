<?php
/**
 * KabelStar
 *
 * This file adds the dist (styles and scripts) to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;


add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_enqueue_scripts_styles' );

/**
 * Enqueue Scripts and Styles in the backend
 */
function admin_enqueue_scripts_styles() {
	$current_screen = get_current_screen();

	if ( $current_screen->id !== 'edit-product' && $current_screen->post_type !== 'product' ) {
		return false;
	}
	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-custom-style', CHILD_CSS . "/admin.css" );
}


add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_scripts_styles' );
/**
 * Enqueue Scripts and Styles.
 */
function enqueue_scripts_styles() {
	global $wp_scripts;
	//Register Scripts

	wp_register_script( 'fancybox', CHILD_JS . '/vendors/fancybox/jquery.fancybox.min.js', array( 'jquery' ), null, true );
	wp_register_script( CHILD_TEXT_DOMAIN . '-archive-product', CHILD_JS . '/build/archive-product.bundle.js', array( 'jquery' ), null, true );
	wp_register_script( CHILD_TEXT_DOMAIN . '-single-product', CHILD_JS . '/build/singular-product.bundle.js', array(
		'jquery',
		'fancybox'
	), null, true );
	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-cart-widget', CHILD_JS . '/build/cart-widget.bundle.js', array(
		'jquery',
		'wc-cart-fragments'
	), null, true );

	//Register Styles
	wp_register_style( 'fancybox', CHILD_JS . '/vendors/fancybox/jquery.fancybox.css' );
	// Load responsive menu and arguments.


	/**
	 *
	 * Load inline typekit, google fonts, custom web fonts fonts
	 *
	 */
	$inline_js_fonts = '
	 	WebFontConfig = {
	 	    google: { families: [ "Roboto:400,500,600,700:latin" ] }
	 	  };
	        (function() {
	            var wf = document.createElement("script");
	            wf.src = "https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
	            wf.type = "text/javascript";
	            wf.async = "true";
	            var s = document.getElementsByTagName("script")[0];
	            s.parentNode.insertBefore(wf, s);
	        })();';
	wp_add_inline_script( CHILD_TEXT_DOMAIN . '-js', $inline_js_fonts );



	/**
	 *
	 * Localize scripts
	 *
	 */

	// $output = array(
	// 	'l10n_new' => __('new', 'woodtec'),
	// 	'iconAssetsUrl' => esc_js(CHILD_URL . '/assets/images/'),
	// 	'ajaxUrl' => admin_url('admin-ajax.php'),

	// );
	// wp_localize_script( CHILD_TEXT_DOMAIN . '-js', 'l10n_js_vars', $output );


	/**
	 *
	 * Deregister superfish
	 *
	 */
	// wp_deregister_script( 'superfish' );
	// wp_deregister_script( 'superfish-args' );

	wp_enqueue_style( 'dashicons' ); //used for responsive menu icons in case the design not specify something else

	wp_enqueue_script( 'slick', CHILD_JS . '/vendors/slick.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-js', CHILD_JS . "/build/theme.bundle.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script( CHILD_TEXT_DOMAIN . '-js', 'l18n_js_theme', array(
			'nonce' =>  wp_create_nonce( 'last_seen_products' )
	) );
//	wp_add_inline_script( CHILD_TEXT_DOMAIN . '-js', '(function(document){
////	console.log("something")
//		document.querySelectorAll("*").forEach(el => {
//			if (el.offsetWidth > document.documentElement.offsetWidth) {
//				console.log("Found the worst element ever: ", el);
//			}
//		})
//	})(document)' );


//	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-responsive-menu', CHILD_JS . "/assets/scripts/build/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_localize_script(
		CHILD_TEXT_DOMAIN . '-js',
		'genesis_responsive_menu',
		standard_responsive_menu_settings()
	);

	if ( is_front_page() && ! \is_home() ) {
		wp_enqueue_script( 'slick' );
		wp_add_inline_script( 'slick','jQuery(document).ready(function($){
						
					var latestProducts = $("[rel=\'latest-products\']");
						
				    $("[rel=\'slider\']").slick();
				    
				    if(latestProducts.length){
					    latestProducts.slick({
					        slidesToShow: 4,
					        dots: true,
					        responsive: [
						    {
						      breakpoint: 1201,
						      settings: {
						        slidesToShow: 3
						      }
						    },
						    {
						      breakpoint: 767,
						      settings: {
						        slidesToShow: 2
						      }
						    },
						    {
						      breakpoint: 399,
						      settings: {
						        slidesToShow: 1
						      }
						    }
						  ]
					        
					    });
				    }
				     
				  });' );
	}

	if ( is_product() ) {
		$product = wc_get_product( get_queried_object_id() );


		if ( $product->get_sale_price() ) {
			$price = '<del>' . ( is_decimal( $product->get_regular_price() ) ? \wc_price( $product->get_regular_price() ) : sprintf( '%s.–', $product->get_regular_price() ) ) . '</del> <ins>' . ( is_decimal( $product->get_sale_price() ) ? \wc_price( $product->get_sale_price() ) : sprintf( '%s.–', $product->get_sale_price() ) ) . '</ins>';
		} else {
			$price = $product->get_price();
		}
		$product_cats = get_product_categories( $product->get_id() );

//		d( $product_cats );

		$caption = sprintf( '<div class="fancybox-product-info"><div class="fancybox-product-price">%s</div><div class="fancybox-product-name"><span>%s</span></div><div class="fancybox-product-categories">%s</div></div>',
			$price,
			get_first_word( $product->get_name() ),
			$product_cats
		);

		$wp_scripts->registered['wc-single-product']->src = CHILD_DIRECTORY . '/lib/woocommerce/js/single-product.js';
		wp_enqueue_style( 'fancybox' );
		wp_enqueue_script( 'fancybox' );
		wp_enqueue_script( 'slick' );
		wp_enqueue_script( CHILD_TEXT_DOMAIN . '-single-product' );
		wp_localize_script( CHILD_TEXT_DOMAIN . '-single-product', 'l18n_js_single_product', array(
			'caption' => $caption,
//			'nonce' =>  wp_create_nonce( 'last_seen_products' )
		) );
		wp_add_inline_script( 'js-cookie', 'jQuery(document).ready(function(){
			if(! Cookies.get("bb_last_seen_products")){
				Cookies.set("bb_last_seen_products", JSON.stringify(["'.$product->get_id().'"]), { expires: 30 })
			} else {
				var lastValues = JSON.parse(Cookies.get("bb_last_seen_products"))
				if(lastValues.indexOf("'.get_the_ID().'") >= 0){
					return false;
				}
				lastValues.push("'.get_the_ID().'")
				Cookies.remove("bb_last_seen_products")
				Cookies.set("bb_last_seen_products", JSON.stringify(lastValues), { expires: 30 })
			}
		});' );


		///https://fancyapps.com/fancybox/3/docs/#options

//		wp_add_inline_script( "fancybox",
//			"jQuery(document).ready(function($){
//				   $('[data-fancybox=\"images\"]').fancybox({
//					   buttons: [
//						    'close'
//						  ],
//					   margin : [44,0,22,0],
//					   thumbs : {
//					     autoStart : true,
//					     axis      : 'x'
//					   }
//				   })
//				});" );


	}

	if ( is_shop() || is_product_category() ) {
//		d(get_queried_object());
		global $wp_query;
		wp_enqueue_script( CHILD_TEXT_DOMAIN . '-archive-product' );
		wp_localize_script( CHILD_TEXT_DOMAIN . '-archive-product', 'l18n_js_archive', array(
			'category_id' =>  get_queried_object_id(),
			'nonce' =>  wp_create_nonce( 'infinite_scroll' ),
			'max_pages' => $wp_query->max_num_pages,
		) );
	}

//	if( has_last_seen_products() ){
//		wp_enqueue_script( 'slick' );
//		wp_add_inline_script( 'slick',
//			'jQuery(document).ready(function($){
//
//				    $("[rel=\'last-seen-slider\']").slick({
//					        slidesToShow: 6,
//					        slidesToScroll: 1,
//					        infinite: false,
////					        dots: false,
//					        responsive: [
//							    {
//							      breakpoint: 1024,
//							      settings: {
//							        slidesToShow: 3
//							      }
//							    },
//							    {
//							      breakpoint: 400,
//							      settings: {
//							        slidesToShow: 1
//							      }
//							    }
//							  ]
//					    });
//
//				  });' );
//	}


}
