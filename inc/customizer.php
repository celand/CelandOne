<?php
/**
 * CelandOne Customizer functionality
 *
 * @package WordPress
 * @subpackage CelandOne
 * @since CelandOne 1.0
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since CelandOne 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function celandone_customize_register( $wp_customize ) {
	$color_scheme = celandone_get_color_scheme();
	$tremula_type = celandone_get_tremula_scheme();

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'celandone_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'celandone' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => celandone_get_color_scheme_choices(),
		'priority' => 1,
	) );
	
	// Add Tremula type setting and control.
	$wp_customize->add_setting( 'tremula_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'celandone_sanitize_tremula_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'tremula_scheme', array(
		'label'    => __( 'Tremula Type', 'celandone' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => celandone_get_tremula_scheme_choices(),
		'priority' => 1,
	) );


	// Add Tremula thumb setting and control.
	$wp_customize->add_setting( 'tremula_thumb_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'celandone_sanitize_tremula_thumb_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'tremula_thumb_scheme', array(
		'label'    => __( 'Thumbnail Size', 'celandone' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => celandone_get_tremula_thumb_scheme_choices(),
		'priority' => 1,
	) );

// Add Tremula nthumb setting and control.
	$wp_customize->add_setting( 'tremula_nthumb_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'celandone_sanitize_tremula_nthumb_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'tremula_nthumb_scheme', array(
		'label'    => __( 'Thumbnail Number Lines', 'celandone' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => celandone_get_tremula_nthumb_scheme_choices(),
		'priority' => 1,
	) );


	// Add custom header and sidebar text color setting and control.
	$wp_customize->add_setting( 'sidebar_textcolor', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_textcolor', array(
		'label'       => __( 'Header and Sidebar Text Color', 'celandone' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'celandone' ),
		'section'     => 'colors',
	) ) );

	// Remove the core header textcolor control, as it shares the sidebar text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add custom header and sidebar background color setting and control.
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'       => __( 'Header and Sidebar Background Color', 'celandone' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'celandone' ),
		'section'     => 'colors',
	) ) );

	// Add an additional description to the header image section.
	$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header on small screens and the sidebar on wide screens.', 'celandone' );
}
add_action( 'customize_register', 'celandone_customize_register', 11 );

/**
 * Register Tremula types for CelandOne.
 *
 * Can be filtered with {@see 'celandone_tremula_schemes'}.
 *
 *
 * @since CelandOne 1.0
 *
 * @return array An associative array of color scheme options.
 */
function celandone_get_tremula_schemes() {
	return apply_filters( 'celandone_tremula_schemes', array(
		'default' => array(
			'label'  => __( 'xyPlain', 'celandone' ),
			'type'   => 'xyPlain',
		),
		'stream' => array(
			'label'  => __( 'StreamHorizontal', 'celandone' ),
			'type' => 'streamHorizontal',
		),
		'pinterest' => array(
			'label'  => __( 'Pinterest', 'celandone' ),
			'type' => 'pinterest',
		),
		'mountain' => array(
			'label'  => __( 'Mountain', 'celandone' ),
			'type' => 'mountain',
		),
		'turntable' => array(
			'label'  => __( 'Turntable', 'celandone' ),
			'type' => 'turntable',
		),
		'enterTheDragon' => array(
			'label'  => __( 'EnterTheDragon', 'celandone' ),
			'type' => 'enterTheDragon',
		),
		'bezierQuad' => array(
			'label'  => __( 'BezierQuad', 'celandone' ),
			'type' => 'bezierQuad',
		),
		'bezierShape' => array(
			'label'  => __( 'BezierShape', 'celandone' ),
			'type' => 'bezierShape',
		),
		'xyBumpTaper' => array(
			'label'  => __( 'xyBumpTaper', 'celandone' ),
			'type' => 'xyBumpTaper',
		),
		'sunrise' => array(
			'label'  => __( 'Sunrise', 'celandone' ),
			'type' => 'sunrise',
		),
		
	) );
}

if ( ! function_exists( 'celandone_get_tremula_scheme' ) ) :
/**
 * Get the current CelandOne tremula type.
 *
 * @since CelandOne 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function celandone_get_tremula_scheme() {
	$tremula_scheme_option = get_theme_mod( 'tremula_scheme', 'default' );
	$tremula_schemes       = celandone_get_tremula_schemes();

	if ( array_key_exists( $tremula_scheme_option, $tremula_schemes ) ) {
		return $tremula_schemes[ $tremula_scheme_option ]['type'];
	}

	return $tremula_schemes['default']['type'];
}
endif; // celandone_get_tremula_scheme

if ( ! function_exists( 'celandone_get_tremula_scheme_choices' ) ) :
/**
 * Returns an array of tremula type choices registered for CelandOne.
 *
 * @since CelandOne 1.0
 *
 * @return array Array of tremula types.
 */
function celandone_get_tremula_scheme_choices() {
	$tremula_schemes                = celandone_get_tremula_schemes();
	$tremula_scheme_control_options = array();

	foreach ( $tremula_schemes as $tremula_scheme => $value ) {
		$tremula_scheme_control_options[ $tremula_scheme ] = $value['label'];
	}

	return $tremula_scheme_control_options;
}
endif; // celandone_get_tremula_scheme_choices

if ( ! function_exists( 'celandone_sanitize_tremula_scheme' ) ) :
/**
 * Sanitization callback for tremula schemes.
 *
 * @since CelandOne 1.0
 *
 * @param string $value tremula scheme name value.
 * @return string tremula scheme name.
 */
function celandone_sanitize_tremula_scheme( $value ) {
	$tremula_schemes = celandone_get_tremula_scheme_choices();

	if ( ! array_key_exists( $value, $tremula_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // celandone_sanitize_tremula_scheme

/**
 * Register Thumb types for CelandOne.
 *
 * Can be filtered with {@see 'celandone_tremula_thumb_schemes'}.
 *
 *
 * @since CelandOne 1.0
 *
 * @return array An associative array of tremula thumb options.
 */
function celandone_get_tremula_thumb_schemes() {
	return apply_filters( 'celandone_tremula_thumb_schemes', array(
		'default' => array(
			'label'  => __( 'Small', 'celandone' ),
			'type'   => '100',
		),
		'medium' => array(
			'label'  => __( 'Medium', 'celandone' ),
			'type' => '150',
		),
		'large' => array(
			'label'  => __( 'Large', 'celandone' ),
			'type' => '200',
		),
	) );
}

if ( ! function_exists( 'celandone_get_tremula_thumb_scheme' ) ) :
 
function celandone_get_tremula_thumb_scheme() {
	$tremula_thumb_scheme_option = get_theme_mod( 'tremula_thumb_scheme', 'default' );
	$tremula_thumb_schemes       = celandone_get_tremula_thumb_schemes();
	if ( array_key_exists( $tremula_thumb_scheme_option, $tremula_thumb_schemes ) ) {
		return $tremula_thumb_schemes[ $tremula_thumb_scheme_option ]['type'];
	}
	return $tremula_thumb_schemes['default']['type'];
}
endif; // celandone_get_tremula_thumb_scheme

if ( ! function_exists( 'celandone_get_tremula_thumb_scheme_choices' ) ) :
/**
 * Returns an array of tremula thumb size choices registered for CelandOne.
 *
 * @since CelandOne 1.0
 *
 * @return array Array of tremula thumb sizes.
 */
function celandone_get_tremula_thumb_scheme_choices() {
	$tremula_thumb_schemes                = celandone_get_tremula_thumb_schemes();
	$tremula_thumb_scheme_control_options = array();
	foreach ( $tremula_thumb_schemes as $tremula_thumb_scheme => $value ) {
		$tremula_thumb_scheme_control_options[ $tremula_thumb_scheme ] = $value['label'];
	}
	return $tremula_thumb_scheme_control_options;
}
endif; // celandone_get_tremula_thumb_scheme_choices
if ( ! function_exists( 'celandone_sanitize_tremula_thumb_scheme' ) ) :
/**
 * Sanitization callback for tremula thumb schemes.
 *
 * @since CelandOne 1.0
 *
 * @param string $value tremula thumb schemes name value.
 * @return string tremula thumb scheme name.
 */
function celandone_sanitize_tremula_thumb_scheme( $value ) {
	$tremula_thumb_schemes = celandone_get_tremula_thumb_scheme_choices();
	if ( ! array_key_exists( $value, $tremula_thumb_schemes ) ) {
		$value = 'default';
	}
	return $value;
}
endif; // celandone_sanitize_tremula_thumb_scheme

/**
 * Register nthumb types for CelandOne.
 *
 * Can be filtered with {@see 'celandone_tremula_nthumb_schemes'}.
 *
 *
 * @since CelandOne 1.0
 *
 * @return array An associative array of tremula nthumb options.
 */
function celandone_get_tremula_nthumb_schemes() {
	return apply_filters( 'celandone_tremula_nthumb_schemes', array(
		'default' => array(
			'label'  => __( 'Two', 'celandone' ),
			'type'   => '1',
		),
		'one' => array(
			'label'  => __( 'One', 'celandone' ),
			'type' => '1',
		),
		'three' => array(
			'label'  => __( 'Three', 'celandone' ),
			'type' => '2',
		),
	) );
}

if ( ! function_exists( 'celandone_get_tremula_nthumb_scheme' ) ) :
 
function celandone_get_tremula_nthumb_scheme() {
	$tremula_nthumb_scheme_option = get_theme_mod( 'tremula_nthumb_scheme', 'default' );
	$tremula_nthumb_schemes       = celandone_get_tremula_nthumb_schemes();
	if ( array_key_exists( $tremula_nthumb_scheme_option, $tremula_nthumb_schemes ) ) {
		return $tremula_nthumb_schemes[ $tremula_nthumb_scheme_option ]['type'];
	}
	return $tremula_nthumb_schemes['default']['type'];
}
endif; // celandone_get_tremula_nthumb_scheme

if ( ! function_exists( 'celandone_get_tremula_nthumb_scheme_choices' ) ) :
/**
 * Returns an array of tremula nthumb size choices registered for CelandOne.
 *
 * @since CelandOne 1.0
 *
 * @return array Array of tremula nthumb sizes.
 */
function celandone_get_tremula_nthumb_scheme_choices() {
	$tremula_nthumb_schemes                = celandone_get_tremula_nthumb_schemes();
	$tremula_nthumb_scheme_control_options = array();
	foreach ( $tremula_nthumb_schemes as $tremula_nthumb_scheme => $value ) {
		$tremula_nthumb_scheme_control_options[ $tremula_nthumb_scheme ] = $value['label'];
	}
	return $tremula_nthumb_scheme_control_options;
}
endif; // celandone_get_tremula_nthumb_scheme_choices
if ( ! function_exists( 'celandone_sanitize_tremula_nthumb_scheme' ) ) :
/**
 * Sanitization callback for tremula nthumb schemes.
 *
 * @since CelandOne 1.0
 *
 * @param string $value tremula nthumb schemes name value.
 * @return string tremula nthumb scheme name.
 */
function celandone_sanitize_tremula_nthumb_scheme( $value ) {
	$tremula_nthumb_schemes = celandone_get_tremula_nthumb_scheme_choices();
	if ( ! array_key_exists( $value, $tremula_nthumb_schemes ) ) {
		$value = 'default';
	}
	return $value;
}
endif; // celandone_sanitize_tremula_nthumb_scheme

/**
 * Register color schemes for CelandOne.
 *
 * Can be filtered with {@see 'celandone_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since CelandOne 1.0
 *
 * @return array An associative array of color scheme options.
 */
function celandone_get_color_schemes() {
	return apply_filters( 'celandone_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'celandone' ),
			'colors' => array(
				'#f1f1f1',
				'#ffffff',
				'#ffffff',
				'#333333',
				'#333333',
				'#f7f7f7',
			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'celandone' ),
			'colors' => array(
				'#111111',
				'#202020',
				'#202020',
				'#bebebe',
				'#bebebe',
				'#1b1b1b',
			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'celandone' ),
			'colors' => array(
				'#f4ca16',
				'#ffdf00',
				'#ffffff',
				'#111111',
				'#111111',
				'#f1f1f1',
			),
		),
		'pink'    => array(
			'label'  => __( 'Pink', 'celandone' ),
			'colors' => array(
				'#ffe5d1',
				'#e53b51',
				'#ffffff',
				'#352712',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'purple'  => array(
			'label'  => __( 'Purple', 'celandone' ),
			'colors' => array(
				'#674970',
				'#2e2256',
				'#ffffff',
				'#2e2256',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'celandone' ),
			'colors' => array(
				'#e9f2f9',
				'#55c3dc',
				'#ffffff',
				'#22313f',
				'#ffffff',
				'#f1f1f1',
			),
		),
	) );
}

if ( ! function_exists( 'celandone_get_color_scheme' ) ) :
/**
 * Get the current CelandOne color scheme.
 *
 * @since CelandOne 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function celandone_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = celandone_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // celandone_get_color_scheme

if ( ! function_exists( 'celandone_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for CelandOne.
 *
 * @since CelandOne 1.0
 *
 * @return array Array of color schemes.
 */
function celandone_get_color_scheme_choices() {
	$color_schemes                = celandone_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // celandone_get_color_scheme_choices

if ( ! function_exists( 'celandone_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since CelandOne 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function celandone_sanitize_color_scheme( $value ) {
	$color_schemes = celandone_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // celandone_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since CelandOne 1.0
 *
 * @see wp_add_inline_style()
 */
function celandone_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = celandone_get_color_scheme();

	// Convert main and sidebar text hex color to rgba.
	$color_textcolor_rgb         = celandone_hex2rgb( $color_scheme[3] );
	$color_sidebar_textcolor_rgb = celandone_hex2rgb( $color_scheme[4] );
	$colors = array(
		'background_color'            => $color_scheme[0],
		'header_background_color'     => $color_scheme[1],
		'box_background_color'        => $color_scheme[2],
		'textcolor'                   => $color_scheme[3],
		'secondary_textcolor'         => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_textcolor_rgb ),
		'border_color'                => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_textcolor_rgb ),
		'border_focus_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_textcolor_rgb ),
		'sidebar_textcolor'           => $color_scheme[4],
		'sidebar_border_color'        => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_sidebar_textcolor_rgb ),
		'sidebar_border_focus_color'  => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_sidebar_textcolor_rgb ),
		'secondary_sidebar_textcolor' => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_sidebar_textcolor_rgb ),
		'meta_box_background_color'   => $color_scheme[5],
	);

	$color_scheme_css = celandone_get_color_scheme_css( $colors );

	wp_add_inline_style( 'celandone-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'celandone_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since CelandOne 1.0
 */
function celandone_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', celandone_get_color_schemes() );
	wp_localize_script( 'tremula-scheme-control', 'tremulaScheme', celandone_get_tremula_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'celandone_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since CelandOne 1.0
 */
function celandone_customize_preview_js() {
	wp_enqueue_script( 'celandone-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'celandone_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since CelandOne 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function celandone_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'            => '',
		'header_background_color'     => '',
		'box_background_color'        => '',
		'textcolor'                   => '',
		'secondary_textcolor'         => '',
		'border_color'                => '',
		'border_focus_color'          => '',
		'sidebar_textcolor'           => '',
		'sidebar_border_color'        => '',
		'sidebar_border_focus_color'  => '',
		'secondary_sidebar_textcolor' => '',
		'meta_box_background_color'   => '',
	) );

	$css = <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Sidebar Background Color */
	body:before,
	.site-header {
		background-color: {$colors['header_background_color']};
	}

	/* Box Background Color */
	.post-navigation,
	.pagination,
	.secondary,
	.site-footer,
	.hentry,
	.page-header,
	.page-content,
	.comments-area,
	.widecolumn {
		background-color: {$colors['box_background_color']};
	}

	/* Box Background Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus,
	.sticky-post {
		color: {$colors['box_background_color']};
	}

	/* Main Text Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.page-links a,
	.sticky-post {
		background-color: {$colors['textcolor']};
	}

	/* Main Text Color */
	body,
	blockquote cite,
	blockquote small,
	a,
	.dropdown-toggle:after,
	.image-navigation a:hover,
	.image-navigation a:focus,
	.comment-navigation a:hover,
	.comment-navigation a:focus,
	.widget-title,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .edit-link a:hover,
	.pingback .edit-link a:focus,
	.comment-list .reply a:hover,
	.comment-list .reply a:focus,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['textcolor']};
	}

	/* Main Text Color */
	.entry-content a,
	.entry-summary a,
	.page-content a,
	.comment-content a,
	.pingback .comment-body > a,
	.author-description a,
	.taxonomy-description a,
	.textwidget a,
	.entry-footer a:hover,
	.comment-metadata a:hover,
	.pingback .edit-link a:hover,
	.comment-list .reply a:hover,
	.site-info a:hover {
		border-color: {$colors['textcolor']};
	}

	/* Secondary Text Color */
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['secondary_textcolor']};
	}

	/* Secondary Text Color */
	blockquote,
	a:hover,
	a:focus,
	.main-navigation .menu-item-description,
	.post-navigation .meta-nav,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.image-navigation,
	.image-navigation a,
	.comment-navigation,
	.comment-navigation a,
	.widget,
	.author-heading,
	.entry-footer,
	.entry-footer a,
	.taxonomy-description,
	.page-links > .page-links-title,
	.entry-caption,
	.comment-author,
	.comment-metadata,
	.comment-metadata a,
	.pingback .edit-link,
	.pingback .edit-link a,
	.post-password-form label,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.no-comments,
	.site-info,
	.site-info a,
	.wp-caption-text,
	.gallery-caption,
	.comment-list .reply a,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		color: {$colors['secondary_textcolor']};
	}

	/* Secondary Text Color */
	blockquote,
	.logged-in-as a:hover,
	.comment-author a:hover {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['secondary_textcolor']};
	}

	/* Border Color */
	hr,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}

	/* Border Color */
	pre,
	abbr[title],
	table,
	th,
	td,
	input,
	textarea,
	.main-navigation ul,
	.main-navigation li,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.comment-navigation,
	.widget li,
	.widget_categories .children,
	.widget_nav_menu .sub-menu,
	.widget_pages .children,
	.site-header,
	.site-footer,
	.hentry + .hentry,
	.author-info,
	.entry-content .page-links a,
	.page-links > span,
	.page-header,
	.comments-area,
	.comment-list + .comment-respond,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-list .reply a,
	.no-comments {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}

	/* Border Focus Color */
	a:focus,
	button:focus,
	input:focus {
		outline-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['border_focus_color']};
	}

	input:focus,
	textarea:focus {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_focus_color']};
	}

	/* Sidebar Link Color */
	.secondary-toggle:before {
		color: {$colors['sidebar_textcolor']};
	}

	.site-title a,
	.site-description {
		color: {$colors['sidebar_textcolor']};
	}

	/* Sidebar Text Color */
	.site-title a:hover,
	.site-title a:focus {
		color: {$colors['secondary_sidebar_textcolor']};
	}

	/* Sidebar Border Color */
	.secondary-toggle {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_color']};
	}

	/* Sidebar Border Focus Color */
	.secondary-toggle:hover,
	.secondary-toggle:focus {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_focus_color']};
	}

	.site-title a {
		outline-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['sidebar_border_focus_color']};
	}

	/* Meta Background Color */
	.entry-footer {
		background-color: {$colors['meta_box_background_color']};
	}

	@media screen and (min-width: 38.75em) {
		/* Main Text Color */
		.page-header {
			border-color: {$colors['textcolor']};
		}
	}

	@media screen and (min-width: 59.6875em) {
		/* Make sure its transparent on desktop */
		.site-header,
		.secondary {
			background-color: transparent;
		}

		/* Sidebar Background Color */
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			color: {$colors['header_background_color']};
		}

		/* Sidebar Link Color */
		.secondary a,
		.dropdown-toggle:after,
		.widget-title,
		.widget blockquote cite,
		.widget blockquote small {
			color: {$colors['sidebar_textcolor']};
		}

		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a {
			background-color: {$colors['sidebar_textcolor']};
		}

		.textwidget a {
			border-color: {$colors['sidebar_textcolor']};
		}

		/* Sidebar Text Color */
		.secondary a:hover,
		.secondary a:focus,
		.main-navigation .menu-item-description,
		.widget,
		.widget blockquote,
		.widget .wp-caption-text,
		.widget .gallery-caption {
			color: {$colors['secondary_sidebar_textcolor']};
		}

		.widget button:hover,
		.widget button:focus,
		.widget input[type="button"]:hover,
		.widget input[type="button"]:focus,
		.widget input[type="reset"]:hover,
		.widget input[type="reset"]:focus,
		.widget input[type="submit"]:hover,
		.widget input[type="submit"]:focus,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: {$colors['secondary_sidebar_textcolor']};
		}

		.widget blockquote {
			border-color: {$colors['secondary_sidebar_textcolor']};
		}

		/* Sidebar Border Color */
		.main-navigation ul,
		.main-navigation li,
		.widget input,
		.widget textarea,
		.widget table,
		.widget th,
		.widget td,
		.widget pre,
		.widget li,
		.widget_categories .children,
		.widget_nav_menu .sub-menu,
		.widget_pages .children,
		.widget abbr[title] {
			border-color: {$colors['sidebar_border_color']};
		}

		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.widget hr {
			background-color: {$colors['sidebar_border_color']};
		}

		.widget input:focus,
		.widget textarea:focus {
			border-color: {$colors['sidebar_border_focus_color']};
		}

		.sidebar a:focus,
		.dropdown-toggle:focus {
			outline-color: {$colors['sidebar_border_focus_color']};
		}
	}
CSS;

	return $css;
}

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since CelandOne 1.0
 */
function celandone_color_scheme_css_template() {
	$colors = array(
		'background_color'            => '{{ data.background_color }}',
		'header_background_color'     => '{{ data.header_background_color }}',
		'box_background_color'        => '{{ data.box_background_color }}',
		'textcolor'                   => '{{ data.textcolor }}',
		'secondary_textcolor'         => '{{ data.secondary_textcolor }}',
		'border_color'                => '{{ data.border_color }}',
		'border_focus_color'          => '{{ data.border_focus_color }}',
		'sidebar_textcolor'           => '{{ data.sidebar_textcolor }}',
		'sidebar_border_color'        => '{{ data.sidebar_border_color }}',
		'sidebar_border_focus_color'  => '{{ data.sidebar_border_focus_color }}',
		'secondary_sidebar_textcolor' => '{{ data.secondary_sidebar_textcolor }}',
		'meta_box_background_color'   => '{{ data.meta_box_background_color }}',
	);
	?>
	<script type="text/html" id="tmpl-celandone-color-scheme">
		<?php echo celandone_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'celandone_color_scheme_css_template' );