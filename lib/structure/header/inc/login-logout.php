<?php
/**
 * KabelStar
 *
 * Header structure files - login/logout block
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;


function add_loginout_buttons() {
	$html = '<div class="user-menu"><ul>';
	if ( is_user_logged_in() ) {
		$html .= sprintf( '<li><a href="%1$s" title="%2$s">%2$s</a></li>',
			wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ),
		__('Log Out', 'kablestart'));
	} elseif ( ! is_user_logged_in() ) {
		$html .= sprintf( '<li><a href="%1$s" title="%2$s">%2$s</a></li>',
			get_permalink( wc_get_page_id( 'myaccount' ),
			__('Log In', 'kablestart'))
		);
	}

	$html .= '</ul></div>';
	echo $html;
}
