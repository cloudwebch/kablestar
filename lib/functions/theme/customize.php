<?php
/**
 * KableStar
 *
 * This file adds the Customizer additions to the KableStar Theme.
 *
 * @package KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

add_action( 'customize_register', __NAMESPACE__ . '\customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function customizer_register( $wp_customize ) {

	$wp_customize->add_setting(
		'link_color',
		array(
			'default'           => customizer_get_default_link_color(),
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'kablestar' ),
				'label'       => __( 'Link Color', 'kablestar' ),
				'section'     => 'colors',
				'settings'    => 'link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'accent_color',
		array(
			'default'           => customizer_get_default_accent_color(),
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'accent_color',
			array(
				'description' => __( 'Change the default hovers color for button.', 'kablestar' ),
				'label'       => __( 'Accent Color', 'kablestar' ),
				'section'     => 'colors',
				'settings'    => 'accent_color',
			)
		)
	);

	$wp_customize->add_setting(
		'logo_width',
		array(
			'default'           => 350,
			'sanitize_callback' => 'absint',
		)
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'logo_width',
		array(
			'label'       => __( 'Logo Width', 'kablestar' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'kablestar' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'logo_width',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 100,
			),

		)
	);

	// HEADER ORIENTATION START.
	$wp_customize->add_setting(
		'header_parallax',
		array(
			'default'           => 'true',
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'header_parallax',
		array(
			'section' => 'header_image',
			'label'   => __('Parallax header?', 'kablestar'),
			'type'    => 'checkbox',
		)
	);

	// DISPLAY OPTIONS SECTION START.
	$wp_customize->add_section(
		'display_options',
		array(
			'title'    => __('Display Options', 'kablestar'),
			'priority' => 100,
		)
	);

	// NAVIGATION LAYOUT START.
	$wp_customize->add_setting(
		'navigation_transparency',
		array(
			'default'           => 'true',
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'navigation_transparency',
		array(
			'section' => 'display_options',
			'label'   => __('Transparent Navigation?', 'kablestar'),
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'navigation_fixed',
		array(
			'default'           => 'false',
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'navigation_fixed',
		array(
			'section' => 'display_options',
			'label'   => __('Fixed Navigation?', 'kablestar'),
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'navigation_layout_select',
		array(
			'default'           => 'below',
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'navigation_layout_select',
		array(
			'section' => 'display_options',
			'label'   => __('Navigation Location', 'kablestar'),
			'type'    => 'select',
			'choices' => array(
				'right'    => __('Right of the logo', 'kablestar'),
				'below'    => __('Below the header', 'kablestar'),
				'centered' => __('Centered logo in nav', 'kablestar'),
			),
		)
	);

	// STANDARD HEADER IMAGE START.
	$wp_customize->add_setting(
		'header_image',
		array(
			'default'           => '',
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_image',
			array(
				'label'    => __('Standard Header Image', 'kablestar'),
				'settings' => 'header_image',
				'section'  => 'display_options',
			)
		)
	);

	// COPYRIGHT MESSAGE START.
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'           => __('All Rights Reserved', 'kablestar'),
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'section' => 'display_options',
			'label'   => __('Copyright Message', 'kablestar'),
			'type'    => 'text',
		)
	);

}

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param   string $input The string to sanitize.
 * @return  string The sanitized string
 * @package digital-creative-agency
 * @since   0.5.0
 * @version 1.0.2
 */
function sanitize_input( $input ) {
	return wp_strip_all_tags( stripslashes( $input ) );
}

/**
 * Writes styles out the `<head>` element of the page based on the configuration options
 * saved in the Theme Customizer.
 *
 * @since   0.2.0
 * @version 1.0.1
 */
function customizer_css() { ?>
	<style type="text/css">
		<?php if ( get_theme_mod( 'navigation_layout_select' ) === 'centered' ) { ?>
			.nav-primary {
				border-top: none;
				text-align: center;
			}
			.nav-header-left {
				float: left;
				text-align: center;
				width: 40%;
			}
			.nav-header-right {
				float: right;
				text-align: center;
				width: 40%;
			}
			.header-full-width .title-area {
				float: none;
				margin: 0 auto;
				text-align: center;
				width: 20%;
			}
			@media (max-width: 1023px) {
				.header-full-width .title-area {
					margin-top: 25px;
					max-width: 200px;
					width: 100%;
				}
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'navigation_layout_select' ) === 'right' ) { ?>
			.nav-primary {
				border-top: none;
				float: right;
				text-align: right;
				width: 75%;
			}
			.header-full-width .title-area {
				float: left;
				width: 25%;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'navigation_layout_select' ) === 'top' ) { ?>
			@media only screen and (min-width: 960px) {
				.site-header {
					position: relative;
				}
			}
			.header-image .title-area {
				max-width: 400px;
			}
			.header-image .site-title>a {
				display: block;
				float: none;
				min-height: 165px;
			}
			.nav-primary {
				border-top: none;
				text-align: center;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'navigation_layout_select' ) === 'below' ) { ?>
			@media only screen and (min-width: 960px) {
				.site-header {
					position: relative;
				}
			}
			.nav-primary {
				float: none;
				padding: 15px 30px;
			}
			.menu-toggle {
				float: none;
				margin: 10px auto;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'header_image' ) ) { ?>
			<?php if ( ! is_front_page() ) { ?>
				.site-header {
					background: url('<?php echo esc_html( get_theme_mod( 'header_image' ) ); ?>') no-repeat center;
					background-size: cover;
				}
				.site-header::after {
					background: rgba(255,255,255,0.6);
					content: '';
					display: block;
					height: 100%;
					left: 0;
					position: absolute;
					top: 0;
					width: 100%;
					z-index: 0;
				}
			<?php } ?>
		<?php } ?>
	</style>
	<?php
} // end customizer_css
add_action( 'wp_head', __NAMESPACE__ . '\customizer_css' );
