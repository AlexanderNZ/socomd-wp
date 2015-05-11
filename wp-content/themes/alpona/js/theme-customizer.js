/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-desc' ).html( newval );
		} );
	} );

	//Update site title color in real time...
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('.site-title, .site-desc').css('color', newval );
		} );
	} );

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	//Update site main post background...
	wp.customize( 'header_color', function( value ) {
		value.bind( function( newval ) {
			$('#main-header, .top-menu li a').css('background-color', newval );
		} );
	} );
	
	//Update site main post background...
	wp.customize( 'main_post', function( value ) {
		value.bind( function( newval ) {
			$('.main-bg').css('background-color', newval );
		} );
	} );
	
	//Update site widget background...
	wp.customize( 'sidebar_color', function( value ) {
		value.bind( function( newval ) {
			$('.widget').css('background-color', newval );
		} );
	} );
	
	//Update site footer background...
	wp.customize( 'footer_color', function( value ) {
		value.bind( function( newval ) {
			$('#footer').css('background-color', newval );
		} );
	} );
	
	//Update site menu link color background...
	wp.customize( 'topnavcol_color', function( value ) {
		value.bind( function( newval ) {
			$('.top-menu li a').css('color', newval );
		} );
	} );
	
	//Update site nav color...
	wp.customize( 'topnavbghover_color', function( value ) {
		value.bind( function( newval ) {
			$('.top-menu li a:hover').css('background-color', newval );
		} );
	} );
	
	//Update site text color...
	wp.customize( 'post_txt_color', function( value ) {
		value.bind( function( newval ) {
			$('p').css('color', newval );
		} );
	} );
	
	//Update site link color...
	wp.customize( 'post_lnk_color', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		} );
	} );
	
	//Update site footer color...
	wp.customize( 'foot_txt_color', function( value ) {
		value.bind( function( newval ) {
			$('#footer p, #footer a').css('color', newval );
		} );
	} );
	
	//Update site sticky color...
	wp.customize( 'sticky_color', function( value ) {
		value.bind( function( newval ) {
			$('.featured').css('background-color', newval );
		} );
	} );
	
} )( jQuery );
