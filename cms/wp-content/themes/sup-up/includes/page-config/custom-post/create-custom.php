<?php
// Our custom post type function
function sup_create_posttype() {
  register_post_type( 'blog',
    array(
      'labels' => array(
      'name' => __( 'Blog' ),
      'singular_name' => __( 'wpis' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon'   => 'dashicons-format-aside',
      'supports' => array( 'title', 'editor'),
      'rewrite' => array('slug' => 'blog'),
    )
  );

  register_post_type('multimedia',
    array(
      'labels'        => array(
      'name'          => __( 'Multimedia' ),
      'singular_name' => __( 'multimedia' )
    ),
    'public'      => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-images-alt2',
    'supports' => array( 'title', 'editor'),
    'rewrite' => array(
      'slug' => 'multimedia'
    ),
    )
  );

}

add_action( 'init', 'sup_create_posttype' );