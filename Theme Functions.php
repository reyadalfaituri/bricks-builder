<?php 

/**
  Dark Mode Toggle (Enabe Light/Dark Mode Theme) 
  Bricks Builder - GS Design System
  PHP Code - Functions.php
  */
 function toggle_dark_mode($classes) {
    $toggle_dark_mode = isset($_COOKIE['gs_toggle_mode_state']) ? $_COOKIE['gs_toggle_mode_state'] : '';
    //if the cookie is stored..
    if ($toggle_dark_mode !== '') {
        // Add 'dark-mode' body class
        return array_merge($classes, array('dark-mode'));
    }
    return $classes;
}
add_filter('body_class', 'toggle_dark_mode', 1, 2);

/**
 * Register custom elements
 */
add_action( 'init', function() {
  $element_files = [
    __DIR__ . '/elements/title.php',
  ];

  foreach ( $element_files as $file ) {
    \Bricks\Elements::register_element( $file );
  }
}, 11 );



/**
 * Add text strings to builder
 */
add_filter( 'bricks/builder/i18n', function( $i18n ) {
  // For element category 'custom'
  $i18n['custom'] = esc_html__( 'Custom', 'bricks' );

  return $i18n;
} );

/**
 * Register/enqueue custom scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {
	// Enqueue your files on the canvas & frontend, not the builder panel. Otherwise custom CSS might affect builder)
	if ( ! bricks_is_builder_main() ) {
		wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime( get_stylesheet_directory() . '/style.css' ) );
	}
} );




/*Tab*/
function enqueue_custom_scripts() {
  wp_enqueue_script('custom-tab-menu', get_template_directory_uri() . '/path/to/tab-menu.js', array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
