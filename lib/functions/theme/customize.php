<?php
/**
 * KabelStar
 *
 * This file adds the Customizer additions to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_action( 'customize_register', __NAMESPACE__ . '\customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @param \WP_Customize_Manager $wp_customize Customizer object.
 *
 * @since 2.2.3
 *
 */
function customizer_register( $wp_customize ) {


	$wp_customize->add_panel(
		'kabelstar_theme_options',
		array(
			'title'       => __( 'KabelStar Theme Options', 'kabelstar' ),
			'description' => __( 'KabelStar Theme Options', 'kabelstar' ),
			'priority'    => 100,
		) );


//	$wp_customize->add_setting(
//		'link_color',
//		array(
//			'default'           => customizer_get_default_link_color(),
//			'sanitize_callback' => __NAMESPACE__ . '\sanitize_hex_color',
//		)
//	);

//	$wp_customize->add_control(
//		new \WP_Customize_Color_Control(
//			$wp_customize,
//			'link_color',
//			array(
//				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'KabelStar' ),
//				'label'       => __( 'Link Color', 'KabelStar' ),
//				'section'     => 'colors',
//				'settings'    => 'link_color',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		'accent_color',
//		array(
//			'default'           => customizer_get_default_accent_color(),
//			'sanitize_callback' => __NAMESPACE__ . '\sanitize_hex_color',
//		)
//	);

//	$wp_customize->add_control(
//		new \WP_Customize_Color_Control(
//			$wp_customize,
//			'accent_color',
//			array(
//				'description' => __( 'Change the default hovers color for button.', 'KabelStar' ),
//				'label'       => __( 'Accent Color', 'KabelStar' ),
//				'section'     => 'colors',
//				'settings'    => 'accent_color',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		'logo_width',
//		array(
//			'default'           => 350,
//			'sanitize_callback' => 'absint',
//		)
//	);

	// Add a control for the logo size.
//	$wp_customize->add_control(
//		'logo_width',
//		array(
//			'label'       => __( 'Logo Width', 'KabelStar' ),
//			'description' => __( 'The maximum width of the logo in pixels.', 'KabelStar' ),
//			'priority'    => 9,
//			'section'     => 'title_tagline',
//			'settings'    => 'logo_width',
//			'type'        => 'number',
//			'input_attrs' => array(
//				'min' => 100,
//			),
//
//		)
//	);

	// HEADER ORIENTATION START.
//	$wp_customize->add_setting(
//		'header_parallax',
//		array(
//			'default'           => 'true',
//			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
//			'transport'         => 'refresh',
//		)
//	);
//	$wp_customize->add_control(
//		'header_parallax',
//		array(
//			'section' => 'header_image',
//			'label'   => __('Parallax header?', 'KabelStar'),
//			'type'    => 'checkbox',
//		)
//	);

	// DISPLAY OPTIONS SECTION START.
	$wp_customize->add_section(
		'header_options',
		array(
			'title'    => __( 'Header Options', 'KabelStar' ),
			'panel'    => 'kabelstar_theme_options',
			'priority' => 100,
		)
	);

	// NAVIGATION LAYOUT START.
//	$wp_customize->add_setting(
//		'navigation_transparency',
//		array(
//			'default'           => 'true',
//			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
//			'transport'         => 'refresh',
//		)
//	);
//	$wp_customize->add_control(
//		'navigation_transparency',
//		array(
//			'section' => 'display_options',
//			'label'   => __('Transparent Navigation?', 'KabelStar'),
//			'type'    => 'checkbox',
//		)
//	);

	$wp_customize->add_setting(
		'navigation_fixed',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 'false',
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'navigation_fixed',
		array(
			'section' => 'header_options',
			'label'   => __( 'Fixed Navigation?', 'kabelstar' ),
			'type'    => 'checkbox',
		)
	);

//	$wp_customize->add_setting(
//		'navigation_layout_select',
//		array(
//			'default'           => 'below',
//			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
//			'transport'         => 'refresh',
//		)
//	);
//	$wp_customize->add_control(
//		'navigation_layout_select',
//		array(
//			'section' => 'display_options',
//			'label'   => __('Navigation Location', 'KabelStar'),
//			'type'    => 'select',
//			'choices' => array(
//				'right'    => __('Right of the logo', 'KabelStar'),
//				'below'    => __('Below the header', 'KabelStar'),
//				'centered' => __('Centered logo in nav', 'KabelStar'),
//			),
//		)
//	);

//	// STANDARD HEADER IMAGE START.
//	$wp_customize->add_setting(
//		'header_image',
//		array(
//			'default'           => '',
//			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
//			'transport'         => 'refresh',
//		)
//	);
//	$wp_customize->add_control(
//		new \WP_Customize_Image_Control(
//			$wp_customize,
//			'header_image',
//			array(
//				'label'    => __('Standard Header Image', 'KabelStar'),
//				'settings' => 'header_image',
//				'section'  => 'display_options',
//			)
//		)
//	);

	// COPYRIGHT MESSAGE START.
//	$wp_customize->add_setting(
//		'footer_copyright_text',
//		array(
//			'default'           => __('All Rights Reserved', 'KabelStar'),
//			'sanitize_callback' => __NAMESPACE__ . '\sanitize_input',
//			'transport'         => 'refresh',
//		)
//	);
//	$wp_customize->add_control(
//		'footer_copyright_text',
//		array(
//			'section' => 'display_options',
//			'label'   => __('Copyright Message', 'KabelStar'),
//			'type'    => 'text',
//		)
//	);

}

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param string $input The string to sanitize.
 *
 * @return  string The sanitized string
 * @since   1.0.0
 * @version 1.0.0
 */
//function sanitize_input( $input ) {
//	return wp_strip_all_tags( stripslashes( $input ) );
//}

function sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


