<?php
/**
 * KableStar
 *
 * This file adds the dist (styles and scripts) to the KableStar Theme.
 *
 * @package KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ .'\enqueue_scripts_styles' );
/**
 * Enqueue Scripts and Styles.
 */
function enqueue_scripts_styles() {

	// Load responsive menu and arguments.
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$development_type = wp_get_environment_type();


	/**
	*
	* Load inline typekit, google fonts, custom web fonts fonts
	*
	*/
	// $inline_js_fonts  = '
	// 	WebFontConfig = {
	// 	    typekit: {id: \'tvd7ktt\'}
	// 	  };
 //        (function() {
 //            var wf = document.createElement("script");
 //            wf.src = "https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
 //            wf.type = "text/javascript";
 //            wf.async = "true";
 //            var s = document.getElementsByTagName("script")[0];
 //            s.parentNode.insertBefore(wf, s);
 //        })();';
	// wp_add_inline_script( CHILD_TEXT_DOMAIN . '-js', $inline_js_fonts );

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

	wp_enqueue_style( 'dashicons' ); //used for responsive menu icons in case the desing not specify something else
//	wp_enqueue_style( CHILD_TEXT_DOMAIN .'-style', CHILD_CSS . "/assets/styles/build/style{$suffix}.css", array(), CHILD_THEME_VERSION );
//
//	if( $development_type === 'production'){
//		wp_enqueue_style( CHILD_TEXT_DOMAIN .'-style', CHILD_CSS . "/style{$suffix}.css", array(), CHILD_THEME_VERSION );
//	}

	wp_enqueue_script( CHILD_TEXT_DOMAIN .'-js', CHILD_JS . "/assets/scripts/build/theme.bundle.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
//	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-responsive-menu', CHILD_JS . "/assets/scripts/build/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	if ( get_theme_mod( 'navigation_layout_select' ) === 'centered' ) {
		wp_localize_script(
			CHILD_TEXT_DOMAIN . '-responsive-menu',
			'genesis_responsive_menu',
			centered_logo_responsive_menu_settings()
		);
	} else {
		wp_localize_script(
			CHILD_TEXT_DOMAIN . '-responsive-menu',
			'genesis_responsive_menu',
			standard_responsive_menu_settings()
		);
	}

}
