<?php

/**
 * Fizjoterapia i sport functions and definitions
 *
 * @package fis
 * @since fis 1.0
 */

/**
 * First, let's set the maximum content width based on the theme's design and stylesheet.
 * This will limit the width of all uploaded images and embeds.
 */
if ( ! isset( $content_width ) )
    $content_width = 800; /* pixels */

if ( ! function_exists( 'fis_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function fis_setup() {

  function add_theme_scripts() {

    // wp_enqueue_style( 'style', get_template_directory_uri() . '/static/dist/css/core.css', array(), '1.1', 'all');

    // wp_enqueue_script( 'vendors', get_template_directory_uri() . '/static/dist/js/vendors.js', array(), true);
    // wp_enqueue_script( 'script', get_template_directory_uri() . '/main.bundle.js', array(), true);


      // if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      //   wp_enqueue_script( 'comment-reply' );
      // }
  }
  add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

  // Disable wp-editor from all pages

  add_action('admin_head', 'remove_content_editor');
  /**
   * Remove the content editor from ALL pages
   */
  function remove_content_editor()
  {
    remove_post_type_support( 'offer', 'editor' );
    remove_post_type_support( 'team', 'editor' );
    remove_post_type_support( 'page', 'editor' );
    remove_post_type_support( 'post', 'editor' );
    remove_post_type_support( 'blog', 'editor' );
  }
  /**
   * Change the number of posts for Offers only
   * **/

  function get_all_offer_posts( $query ) {
    if( !is_admin() && $query->is_main_query() && is_post_type_archive( 'offer' ) ) {
        $query->set( 'posts_per_page', '-1' );
    }
  }
  add_action( 'pre_get_posts', 'get_all_offer_posts' );
  /**
  * Make theme available for translation.
  * Translations can be placed in the /languages/ directory.
  */
  load_theme_textdomain( 'fis', get_template_directory() . '/languages' );

  /**
  * Add support for two custom navigation menus.
  */
  register_nav_menus( array(
    'primary'   => __( 'Primary Menu', 'fis' ),
    'secondary' => __('Secondary Menu', 'fis' )
  ) );

  /**
  * Enable support for the following post formats:
  * aside, gallery, quote, image, and video
  */
  add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );

  /**
  * Create options page for ACF.
  */
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
  }
}
endif; // fis_setup
add_action( 'after_setup_theme', 'fis_setup' );

//Remove default Wordpress post type
add_action('admin_menu','customprefix_remove_default_post_type_menu_item');

function customprefix_remove_default_post_type_menu_item() {
 remove_menu_page('edit.php');
}

add_filter('wpcf7_autop_or_not', '__return_false');

// Included files

require_once('includes/page-config/custom-post/create-custom.php');
