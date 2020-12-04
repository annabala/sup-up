<?php
// Our custom post type function
function sup_create_posttype() {
  register_post_type('events',
    array(
      'labels'        => array(
      'name'          => __( 'Eventy' ),
      'singular_name' => __( 'Event' ),
    ),
    'public'      => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-smiley',
    'rewrite' => array(
      'slug' => 'event'
    ),
    )
  );

  // register_post_type( 'Porady',
  //   array(
  //     'labels' => array(
  //     'name' => __( 'Porady' ),
  //     'singular_name' => __( 'Porada' )
  //     ),
  //     'public' => true,
  //     'has_archive' => true,
  //     'taxonomies' => array('category'),
  //     'menu_icon'   => 'dashicons-editor-alignleft',
  //     'supports' => array( 'title', 'comments', 'author'),
  //     'rewrite' => array('slug' => 'blog'),
  //   )
  // );
  register_post_type('multimedia',
    array(
      'labels'        => array(
      'name'          => __( 'Multimedia' ),
      'singular_name' => __( 'Multimedia' )
    ),
    'public'      => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-images-alt2',
    'rewrite' => array(
      'slug' => 'multimedia'
    ),
    )
  );

}

add_action( 'init', 'sup_create_posttype' );