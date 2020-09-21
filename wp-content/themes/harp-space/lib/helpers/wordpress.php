<?php

/**
 * Theme URI
 * @internal for theme path, use TEMPLATEPATH constant
 */
if ( !defined( 'THEME_URI' ) ) {
  define( 'THEME_URI', get_template_directory_uri() );
}

/**
 * Components PATH
 */
if ( !defined( 'COMPONENTS_DIR' ) ) {
  define( 'COMPONENTS_DIR', TEMPLATEPATH . '/components' );
}

/**
 * Uploads PATH and URI
 */
$upload_dir = wp_upload_dir();
if ( !defined('UPLOADS_DIR')) {
  define( 'UPLOADS_DIR', $upload_dir['basedir'] );
}

if ( !defined('UPLOADS_URI')){
  define( 'UPLOADS_URI', $upload_dir['baseurl'] );
}

if ( ! function_exists( '_wp_render_title_tag' ) ) :
  /**
  * Wordpress 4.4 deprecates wp_title(), but this may change.
  * @link https://make.wordpress.org/core/2015/10/20/document-title-in-4-4/
  */
  function theme_slug_render_title() {
    echo '<title>';
    wp_title( '|', true, 'right' );
    echo '</title>';
  }
  add_action( 'wp_head', 'theme_slug_render_title' );
endif;

/**
 * Include ACF
 */


/**
 * Check if page should have pagination
 */
function has_pagination() {
    global $wp_query, $paged;
    return ($wp_query->max_num_pages > 1 && $paged < $wp_query->max_num_pages);
}

/**
 * Get nav menu items adjadcent to post
 */
function get_sibling_nav($post) {
  if ($post->post_parent) {
    $ancestors = get_post_ancestors($post->ID);
    $root = count($ancestors)-1;
    $parent = $ancestors[$root];
  } else {
    $parent = $post->ID;
  }

  $nav = [];
  $parent_path = get_permalink($parent);
  $locations = get_nav_menu_locations();
  $menu_id = $locations['header-primary'] ;
  $page_nav = wp_get_nav_menu_items(wp_get_nav_menu_object($menu_id));
  foreach( $page_nav as $item ) {

    // Check if link matches current parent, only if top level
    if($item->url == $parent_path && $item->menu_item_parent === "0") {
      $parent_item = $item;
    }

    // Include nav items under parent link
    if(!empty($parent_item) && $item->menu_item_parent == $parent_item->ID) {
      $nav[] = $item;
    }
  }
  return $nav;
}

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
//error_reporting(0);
