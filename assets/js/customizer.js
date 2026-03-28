/* global wp, jQuery */
/**
 * Customizer behavior
 */
( function( $ ) {

	// Site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Body Color
	wp.customize( 'body_color', function( value ) {
		value.bind( function( newval ) {
			$( ':root' ).css( '--body', newval );
		} );
	} );

	// Subdued Body Color
	wp.customize( 'subdued_body_color', function( value ) {
		value.bind( function( newval ) {
			$( ':root' ).css( '--subdued-body', newval );
		} );
	} );

	// Lightest Color
	wp.customize( 'lightest_color', function( value ) {
		value.bind( function( newval ) {
			$( ':root' ).css( '--lightest', newval );
		} );
	} );

	// Darkest Color
	wp.customize( 'darkest_color', function( value ) {
		value.bind( function( newval ) {
			$( ':root' ).css( '--darkest', newval );
			$( ':root' ).css( '--subdued-action', newval );
		} );
	} );

	// Action Color
	wp.customize( 'action_color', function( value ) {
		value.bind( function( newval ) {
			$( ':root' ).css( '--action', newval );
		} );
	} );

}( jQuery ) );