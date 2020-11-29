<?php
/**
 * File to add helper functions.
 *
 * @package WPGraphQLPlus
 */

/**
 * Function to make string camel case
 *
 * @param string $string String to make it camel case.
 *
 * @return string
 */
function wp_gql_plus_make_camel_case( $string ) {

	$string = preg_replace( '/[^a-zA-Z0-9 ]/s', '', $string );

	if ( empty( $string ) ) {
		return $string;
	}

	return lcfirst( str_replace( ' ', '', ucwords( $string ) ) );
}
