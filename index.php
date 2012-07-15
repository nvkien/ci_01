<?php

// The key used in the request to specify the API version to use
define( 'API_VER', 'v' );

// Check that the key was given in the request if not, use the default API version
array_key_exists( API_VER, $_REQUEST ) ? $v	= $_REQUEST[ API_VER ] : $v = '1.0.0';

// Does the given key correspond to an existing API version
if ( file_exists( "{$v}.php" ) ) {
	if ( is_dir( dirname( __FILE__ ) . "/{$v}" ) ) {
		require dirname( __FILE__ ) . "/{$v}.php";
	} else {
		$error	= new stdClass();
		$error->error		= true;
		$error->description	= 'INVALID_API_VERSION';
		echo json_encode( $error );
		exit;
	}
} else {
	$error	= new stdClass();
	$error->error		= true;
	$error->description	= 'INVALID_API_VERSION';
	echo json_encode( $error );
	exit;
}