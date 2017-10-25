<?php
/*
Plugin Name: Contact Form 7 - Minlength Text Extension
Plugin URI: http://wordpress.org/plugins/minimum-length-for-contact-form-7/
Description: Add (required) minimum length to textfields in Contact Form 7.
Version: 1.4.1
Author: Tussendoor internet & marketing
Author URI: http://tussendoor.nl
Tested up to: 4.7
*/

require_once('wpcf7_min_text.php');
require_once('wpcf7_min_textarea.php');

/* Validation filter */

add_filter( 'wpcf7_validate_text', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_text*', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_email', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_url', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_url*', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_tel', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_tel*', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_textarea', 'wpcf7_min_length_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_textarea*', 'wpcf7_min_length_validation_filter', 10, 2 );

function wpcf7_min_length_validation_filter( $result, $tag ) {
	$tag = new WPCF7_Shortcode( $tag );

	$name = $tag->name;

	$value = isset( $_POST[$name] )
		? trim( stripslashes( strtr( (string) $_POST[$name], "\n", " " ) ) )
		: '';

	$option = $tag->get_option('minlength');
	$minlength = $option[0];
	
	if ( strlen($value) < $minlength ) {
		$result['valid'] = false;
		$result['reason'][$name] = wpcf7_get_message( 'invalid_length' );
	}

	return $result;
}

/* Validation messages */

add_filter( 'wpcf7_messages', 'wpcf7_min_text_messages' );

function wpcf7_min_text_messages( $messages ) {
	return array_merge( $messages, array(
		'invalid_length' => array(
			'description'	=> __( 'The text needs a minimum length.', 'contact-form-7' ),
			'default' => __( 'The text needs a minimum length.', 'contact-form-7' )
		) ) );
}