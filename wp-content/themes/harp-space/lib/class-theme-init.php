<?php

require_once( __DIR__ . '/class-base-theme.php' );

class Base_Theme extends BB_Theme {
  static $text_domain = 'kupper';

  public function __construct(){
    parent::__construct();
    // $this->  _json_path = TEMPLATEPATH . '/acf-json';
    // $this->cpt_json_path = TEMPLATEPATH . '/cpt-json';

    add_action( 'after_setup_theme', array( &$this, 'register_menus' ) );
    // add_filter( 'image_size_names_choose', array( &$this, 'image_size_names_choose' ) );
    add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts_and_styles' ) );

    add_action( 'wp_head', array(&$this, 'add_critical_css'), 1);
    // add_action( 'wp_footer', array(&$this, 'load_rest_css') );
    // add_action( 'wp_footer', array(&$this, 'load_google_fonts') );
    // add_action( 'wp_footer', array(&$this, 'load_vimeo_scripts') );

    // add_action( 'wp_head', array( &$this, 'print_site_favicons' ) );

    // add_filter( 'show_admin_bar', '__return_false' );

    // add_action( 'init', array( &$this, 'change_post_object_label' ) );
    // add_action( 'admin_menu', array( &$this, 'change_post_menu_label' ) );

    // add_action( 'init', array( &$this, 'exclude_attachments_from_search' ) );

    // add_shortcode( 'year', array( &$this, 'shortcode_year' ) );

    // add_filter( 'tiny_mce_before_init', array( &$this, 'insert_formats' ) );
    // add_filter( 'mce_buttons_2', array( &$this, 'add_mce_button' ), 10, 2 );
    // add_filter( 'after_setup_theme', array( &$this, 'add_editor_styles' ), 10, 2 );

    add_filter( 'init', array( &$this, 'add_post_types' ), 10, 2 );
    add_filter( 'init', array( &$this, 'add_taxonomies' ), 10, 2 );
    // add_filter( 'wp_nav_menu_items', array(&$this, 'add_to_nav'), 10, 2 );

    // if you want to prevent acf from filtering wysiwyg editor fields
    // remove_filter( 'acf_the_content', array( &$this, 'wpautop') );
    add_filter( 'default_page_template_title', array(&$this, 'rename_default_template' ) );

    $labels = array(
      'name'                => 'Tracks',
      'singular_name'       => 'Track',
      'menu_name'           => 'Track List',
      'parent_item_colon'   => 'Parent Item:',
      'all_items'           => 'All Tracks',
      'view_item'           => 'View Item',
      'add_new_item'        => 'Add New Track',
      'add_new'             => 'Add New',
      'edit_item'           => 'Edit Track',
      'update_item'         => 'Update Track',
      'search_items'        => 'Search Tracks',
      'not_found'           => 'Not found',
      'not_found_in_trash'  => 'Not found in Trash',
    );
    $rewrite = array(
      'slug'                => 'track',
      'with_front'          => false,
      'pages'               => true,
      'feeds'               => true,
    );
    $args = array(
      'label'               => 'track',
      'labels'              => $labels,
      'supports'            => array( 'title' ),
      'hierarchical'        => false,
      'menu_position'       => 9,
      'publicly_queryable'  => true,
      'query_var'           => true,
      'public'              => true,
      'rewrite'             => $rewrite,
      'capability_type'     => 'post',
      'show_in_rest'        => true
    );
    register_post_type( 'track', $args );

    // $this->add_options_page();
    $this->register_image_sizes();
  }

  public function add_to_nav( $items, $args ) {
    if( $args->theme_location === 'header-primary' && get_field('add_to_main_nav', 'options') ) {
      $items .= get_module('current-music', array(
        'artist' => get_field('artist', 'options'),
        'title' => get_field('track_name', 'options'),
        'album' => get_field('album', 'options'),
        'nav_label' => get_field('nav_label', 'options'),
        'embed' => get_field('track', 'options')
      ));
    }
    return $items;
  }

  /**
  * Change "posts" to "news" in the admin side menu
  */
  public function change_post_menu_label() {
      global $menu;
      global $submenu;
      $menu[5][0] = 'Posts';
      $submenu['edit.php'][5][0] = 'Posts';
      $submenu['edit.php'][10][0] = 'Add Post';
      $submenu['edit.php'][16][0] = 'Tags';
      echo '';
  }

  /**
  * Change post object labels to "news"
  */
  public function change_post_object_label() {
      global $wp_post_types;
      $labels = &$wp_post_types['post']->labels;
      $labels->name = 'Posts';
      $labels->singular_name = 'Post';
      $labels->add_new = 'Add Post';
      $labels->add_new_item = 'Add Post';
      $labels->edit_item = 'Edit Post';
      $labels->new_item = 'Post';
      $labels->view_item = 'View Post';
      $labels->search_items = 'Search Posts';
      $labels->not_found = 'No Posts found';
      $labels->not_found_in_trash = 'No Posts found in Trash';
  }



  // /**
  // * Add a global Theme Settings page in admin area
  // */
  // public function add_options_page() {
  //   if ( function_exists('acf_add_options_page')) {
  //     acf_add_options_page( array (
  //       'page_title'  => __( 'Theme Options', self::$text_domain ),
  //       'menu_title'  => 'Theme Options',
  //       'menu_slug'   => 'theme-options',
  //       'capability'  => 'administrator',
  //       'redirect'    => false
  //     ) );
  //   }
  // }

  /**
  * Register post types used in this theme
  */
  public function add_post_types()
  {
    // $ctp_post_types = $this->cpt_config_data();
    $types = [];

    foreach( $types as $type ) {
      $this->add_post_type($type);
    }

    add_post_type_support( 'events', 'excerpt' );
  }

  /**
  * Register taxonomies used in this theme
  */
  public function add_taxonomies()
  {
    // $cpt_taxonomies = $this->cpt_config_data( false );
    $taxonomies = [];

    foreach( $taxonomies as $taxonomy_args ) {
      $post_type = $taxonomy_args['types'];
      unset($taxonomy_args['types']);
      $this->add_taxonomy( $taxonomy_args, $post_type );
    }
  }

  /**
  * Add theme support for features required in this theme
  */
  public function add_theme_supports(){
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'post-thumbnails' );
  }

  /**
  * Body class when info bar is active
  * @param  array $class Array of classes
  * @return array
  */
  public function body_class( $class ) {
    return $class;
  }

  /**
  * Exclude attachments from search results on the front-end
  */
  public function exclude_attachments_from_search() {
    if ( is_admin() ) {
      return;
    }

    global $wp_post_types;

    $wp_post_types['attachment']->exclude_from_search = true;
  }

  /**
  * Rename Default Template to Basic Page
  */
  public function rename_default_template()
  {
    return __('Basic Page', 'kupper');
  }

  /**
  * Enqueue JavaScript and vendor dependencies
  */
  public function enqueue_scripts_and_styles() {
    $handle = self::$text_domain;
    $git_version = substr( exec( "git rev-parse HEAD" ), 0, 6 );
    $version = empty( $git_version ) ? wp_get_theme()->get( 'Version' ) : $git_version;

    // allowing jquery for gravity forms
    try {
      jquery_reregister();
    }
    catch ( Exception $ex ){}

    $script_path = THEME_URI . "/assets/js";

    // associative array with key-value pairs to be json encoded
    $wp_vars = array(
    );

    // scripts
    wp_enqueue_script( $handle, "$script_path/main.js", null, $version, ( IS_DEV ? false : true ) );
    if ( !empty( $wp_vars ) )
    {
      wp_localize_script( $handle, 'wpVars', $wp_vars );
    }
  }

  /**
  * Provide size choices for media library
  * @param  string[] $sizes
  * @return string[]
  */
  public function image_size_names_choose( $sizes ) {
    return array_merge( $sizes, array(
      'tiny'   => 'Tiny Image',
      'small'  => 'Small Image',
      'medium' => 'Medium Image',
      'large'  => 'Large Image'
    ) );
  }

  /**
  * Print favicons saved in the theme
  * @todo add checks to prevent output unless assets exists
  */
  public function print_site_favicons()
  {
    $favicon_path = '/assets/img/favicon/';
    $favicon_files = array(
      "apple-touch-icon.png",
      "favicon-32x32.png",
      "favicon-16x16.png",
      "manifest.json",
      "favicon.ico",
      "browserconfig.xml",
    );
    $favi = THEME_URI . $favicon_path; ?>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= $favi; ?>apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $favi; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $favi; ?>favicon-16x16.png">
    <link rel="manifest" href="<?= $favi; ?>manifest.json">
    <link rel="mask-icon" href="<?= $favi; ?>safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?= $favi; ?>favicon.ico">
    <meta name="msapplication-config" content="<?= $favi; ?>browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
  <?php
  }

  /**
  * Register image sizes to ensure whatever image sizes client uploads will properly get
  * scaled down to ensure good load time.
  *
  * These sizes already account for 2x retina displays.
  */
  public function register_image_sizes() {

    // large image size is used for full-width cover images
    add_image_size( 'large', 1440 );

    // medium image size is used for featured post thumbnails in list context
    add_image_size( 'medium', 450 );

    // small image size is used for smaller items such as logos
    add_image_size( 'small', 225 );

    // tiny image size is used for thumbnails (especially in WYSIWYG)
    add_image_size( 'tiny', 100 );
  }

  /**
  * Register navigation menu areas that can be configurable via Appearance -> Menus
  */
  public function register_menus() {
    register_nav_menus( array(
      'header-primary'     => __( 'Header Primary Menu', self::$text_domain ),
      'header-quick-links' => __( 'Header Quick Links Menu', self::$text_domain ),
      'footer'             => __( 'Footer Menu', self::$text_domain ),
      'footer-meta'        => __( 'Footer Copyright Links', self::$text_domain )
    ) );
  }

  /**
  * Shortcodes
  */

  public function shortcode_year() {
    return date('Y');
  }

  /**
  * WYSIWYG / Format Dropdown
  */
  public function insert_formats( $init_array ) {
    $style_formats = array(
      array(
        'title' => 'Main Heading',
        'classes' => 'main-heading',
        'block' => 'div',
        'wrapper' => false,
      ),
      array(
        'title' => 'Sub Heading',
        'classes' => 'sub-heading',
        'block' => 'div',
        'wrapper' => false,
      ),
      array(
        'title' => 'Secondary Sub Heading',
        'classes' => 'secondary-sub-heading',
        'block' => 'div',
        'wrapper' => false,
      ),
      array(
        'title' => 'Intro Text',
        'classes' => 'intro-text',
        'block' => 'p',
        'wrapper' => false,
      ),
      array(
        'title' => 'Button',
        'selector' => 'a',
        'classes' => 'button',
        'wrapper' => true,
      ),
      array(
        'title' => 'Byline',
        'block' => 'p',
        'classes' => 'byline',
        'wrapper' => false,
      ),

    );

    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;
  }

  /**
  * Add Buttons To WP Editor Toolbar.
  */
  public function add_mce_button( $buttons, $editor_id ){
    /* Add it as first item in the row */
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
  }

  /**
  * Add styles css to admin
  */
  public function add_editor_styles(){
    add_editor_style('assets/editor.min.css');
  }

  /**
  * Add critical css file to <head></head>
  */
  public function add_critical_css() {
    $theme = wp_get_theme();
    $file = TEMPLATEPATH . '/assets/critical.min.css';
    $file_content = @file_get_contents( $file );
    // note that we might need to write a filter here to dynamically replace filepaths to font files
    if (!empty($file_content)) {
      printf('<style type="text/css">%s</style>', $file_content);
    }

    // if not using load_rest_css use this
    wp_enqueue_style('main_css', get_template_directory_uri() . '/assets/css/main.css?ver=' . $theme->version );
  }

  /**
  * Load google fonts (deferred via webfont loader)
  */
  public function load_google_fonts() {
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,300;0,500;0,600;1,300;1,500;1,600&display=swap" rel="stylesheet">
    <!-- <script type="text/javascript">
      WebFontConfig = {
        google: { families: [ 'Montserrat:500', 'Raleway:400,400i,700,700i' ] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
      // ]]>
    </script> -->
    <?php
  }

  /**
  * Load vimeo script for video player api
  */
  public function load_vimeo_scripts() {
    ?>
      <script src="//player.vimeo.com/api/player.js" async></script>
    <?php
  }

  /**
  * Load main css (rest styles) file asynchrounsly in footer
  */
  public function load_rest_css() {
    $theme     = wp_get_theme();
    $theme_ver = $theme->version;
    if ( !IS_DEV ) {
      ?>
      <noscript id="deferred-styles">
        <link rel="stylesheet"
            href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/main.css?ver=' . $theme_ver ); ?>">
      </noscript>
      <script>
        var loadDeferredStyles = function () {
          var addStylesNode = document.getElementById("deferred-styles");
          var replacement = document.createElement("div");
          replacement.innerHTML = addStylesNode.textContent;
          document.body.appendChild(replacement)
          addStylesNode.parentElement.removeChild(addStylesNode);
        };
        var raf = requestAnimationFrame || mozRequestAnimationFrame ||
          webkitRequestAnimationFrame || msRequestAnimationFrame;
        if (raf) raf(function () {
          window.setTimeout(loadDeferredStyles, 0);
        });
        else window.addEventListener('load', loadDeferredStyles);
      </script>
      <?php
    }
  }
}

new Base_Theme();
