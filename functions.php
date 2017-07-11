<?php
/**
 * Initialize the theme settings loading.
 */
// Include Dustpress. Because of provider we don't use autoloaders.
include('dustpress/dustpress.php');
// Use dustpress
dustpress();
// Require all function files under /lib.
$lib_path = dirname( __FILE__ ) . '/lib/';
// List your /lib files here.
$includes = [
	'acf-theme-settings.php', // Theme settings
	'acf-article-fields.php', // Post fields
    'extras.php', 			  // Custom functions
    'setup.php',  			  // Theme setup
    'images.php', 			  // Image functions
];

foreach ( $includes as $file ) {
    $file_path = $lib_path . $file;
    if ( is_file( $file_path ) ) {
        require $file_path;
    }
}