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
//	d(is_user_logged_in());
	if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();
		$user_name = get_user_meta( $user_id, 'first_name', 'single' );
		$avatar = get_avatar($user_id, 30, '', $user_name);
//		d($user_name);
//		d($avatar);
		$html .= sprintf('<li class="user-info"><a href="%s" title="My Account"><span>%s</span> %s</a></li>',
			esc_url( \wc_get_page_permalink( 'myaccount' ) ),
			$user_name,
			$avatar
		);
		$html .= sprintf( '<li><a class="button button-login" href="%1$s" title="%2$s">%2$s</a></li>',
			wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ),
		__('Abmelden', 'kablestart'));
	} else {
		$html .= sprintf( '<li><a class="button button-login" href="%1$s" title="%2$s">%2$s</a></li>',
			get_permalink( wc_get_page_id( 'myaccount' )),
			__('Anmelden', 'kablestart')
		);
	}

	$html .= '</ul></div>';
	echo $html;
}
