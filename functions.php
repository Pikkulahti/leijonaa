<?php
/**
 * Initialize the theme settings loading.
 */
// Use dustpress
dustpress();
// Require all function files under /lib.
$lib_path = dirname( __FILE__ ) . '/lib/';
// List your /lib files here.
$includes = [
	'acf-theme-settings.php', // Theme settings
	//'acf-post-fields.php',	  // Post fields
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