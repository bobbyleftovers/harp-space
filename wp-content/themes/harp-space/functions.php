<?php
define('IS_DEV', isset( $_SERVER['HTTP_X_DEV'] ) ? true : false );

add_filter('body_class','my_class_names');
function my_class_names($classes) {
    return array();
}

// // Backend only
include_once( __DIR__ . '/lib/class-theme-init.php' );

// // Global helpers
require_once( __DIR__ . '/lib/helpers/wordpress.php' );
require_once( __DIR__ . '/lib/helpers/modules.php' );
require_once( __DIR__ . '/lib/helpers/scripts.php' );
require_once( __DIR__ . '/lib/helpers/media.php' );
require_once( __DIR__ . '/lib/helpers/sub-nav-features.php' );
// require_once( __DIR__ . '/lib/helpers/sub-nav-mobile.php' );
require_once( __DIR__ . '/lib/helpers/shortcodes.php' );
require_once( __DIR__ . '/lib/carbon.php' );
