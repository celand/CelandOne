<?php
/**
 * CelandOne back compat functionality
 *
 * Prevents CelandOne from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package WordPress
 * @subpackage CelandOne
 * @since CelandOne 1.0
 */

/**
 * Prevent switching to CelandOne on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since CelandOne 1.0
 */
function celandone_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'celandone_upgrade_notice' );
}
add_action( 'after_switch_theme', 'celandone_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * CelandOne on WordPress versions prior to 4.1.
 *
 * @since CelandOne 1.0
 */
function celandone_upgrade_notice() {
	$message = sprintf( __( 'CelandOne requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'celandone' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 *
 * @since CelandOne 1.0
 */
function celandone_customize() {
	wp_die( sprintf( __( 'CelandOne requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'celandone' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'celandone_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
 * @since CelandOne 1.0
 */
function celandone_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'CelandOne requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'celandone' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'celandone_preview' );
