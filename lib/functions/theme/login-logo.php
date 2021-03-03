<?php
/**
 * KableStar
 *
 * This file change the login screen logo to the KableStar Theme.
 *
 * @package KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

add_filter( 'login_headerurl', __NAMESPACE__ . '\login_logo_url' );
/**
 * Login Logo URL
 */
function login_logo_url() {
    return home_url();
}

/**
 * Login logo
 */
function login_logo() {
    $custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

    ?>
    <style type="text/css">
    .login h1 a {
        background-image: url( <?php echo esc_html( $custom_logo[0] ); ?> );
        background-size: contain;
        background-repeat: no-repeat;
		background-position: center center;
        display: block;
        overflow: hidden;
        text-indent: -9999em;
        width: 312px;
        height: 100px;
    }
    </style>
    <?php
}
add_action( 'login_head', __NAMESPACE__ . '\login_logo' );
