<?php

/**
 * Sup up functions and definitions
 *
 * @package sup
 * @since sup 1.0
 */

/**
 * First, let's set the maximum content width based on the theme's design and stylesheet.
 * This will limit the width of all uploaded images and embeds.
 */
if ( ! isset( $content_width ) )
    $content_width = 1200; /* pixels */

if ( ! function_exists( 'sup_setup' ) ) :

function sup_setup() {

  function supup_widgets_init() {

    register_sidebar( array(
        'name' => 'Social feed',
        'id' => 'supup_social_feed',
    ) );
  }
  add_action( 'widgets_init', 'supup_widgets_init' );

  // Disable wp-editor from all pages
  add_action( 'init', function() {
    remove_post_type_support( 'post', 'editor' );
    remove_post_type_support( 'page', 'editor' );
    remove_post_type_support( 'multimedia', 'editor' );
    remove_post_type_support( 'blog', 'editor' );
    }, 99);

  load_theme_textdomain( 'sup', get_template_directory() . '/languages' );

  register_nav_menus( array(
    'primary'   => __( 'Primary Menu', 'sup' ),
    'secondary' => __( 'Secondary Menu', 'sup' )
  ) );

  add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );

  add_action('acf/init', 'my_acf_op_init');
  function my_acf_op_init() {

      // Check function exists.
      if( function_exists('acf_add_options_sub_page') ) {

          // Add parent.
          $parent = acf_add_options_page(array(
              'page_title'  => __('Opcje strony'),
              'menu_title'  => __('Opcje strony'),
              'redirect'    => false,
          ));
      }
  }
}
endif; // sup_setup
add_action( 'after_setup_theme', 'sup_setup' );

//Remove default Wordpress post type
add_action('admin_menu','customprefix_remove_default_post_type_menu_item');

function customprefix_remove_default_post_type_menu_item() {
 remove_menu_page('edit.php');
}

add_filter('wpcf7_autop_or_not', '__return_false');

// Included files
require_once('includes/page-config/custom-post/create-custom.php');