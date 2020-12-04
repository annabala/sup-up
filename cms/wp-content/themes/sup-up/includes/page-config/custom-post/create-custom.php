<?php
// Our custom post type function
function fis_create_posttype() {
  register_post_type('offer',
    array(
      'labels'        => array(
      'name'          => __( 'Usługi' ),
      'singular_name' => __( 'Usługa' )
    ),
    'public'      => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-cart',
    'rewrite' => array(
      'slug' => 'uslugi'
    ),
    )
  );

  register_post_type( 'Blog',
    array(
      'labels' => array(
      'name' => __( 'Blog' ),
      'singular_name' => __( 'Wpis' )
      ),
      'public' => true,
      'has_archive' => true,
      'taxonomies' => array('category'),
      'menu_icon'   => 'dashicons-editor-alignleft',
      'supports' => array( 'title', 'comments', 'author'),
      'rewrite' => array('slug' => 'blog'),
    )
  );

}

add_action( 'init', 'fis_create_posttype' );