<?php
// Our custom post type function
function sup_create_posttype() {
  register_post_type('events',
    array(
      'labels'        => array(
      'name'          => __( 'Eventy' ),
      'singular_name' => __( 'event' ),
    ),
    'public'      => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-smiley',
    'supports' => array( 'title'),
    'rewrite' => array(
      'slug' => 'event'
    ),
    )
  );

  register_post_type( 'blog',
    array(
      'labels' => array(
      'name' => __( 'Blog' ),
      'singular_name' => __( 'wpis' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon'   => 'dashicons-format-aside',
      'supports' => array( 'title',),
      'rewrite' => array('slug' => 'blog'),
    )
  );

  register_post_type( 'fun-park',
    array(
      'labels' => array(
      'name' => __( 'Fun Park' ),
      'singular_name' => __( 'atrakcja' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon'   => 'dashicons-palmtree',
      'supports' => array( 'title',),
      'rewrite' => array('slug' => 'fun-park'),
    )
  );

  register_post_type( 'vr',
    array(
      'labels' => array(
      'name' => __( 'SUP VR' ),
      'singular_name' => __( 'atrakcja' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon'   => 'dashicons-games',
      'supports' => array( 'title',),
      'rewrite' => array('slug' => 'vr'),
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
    'supports' => array( 'title'),
    'rewrite' => array(
      'slug' => 'multimedia'
    ),
    )
  );

}

add_action( 'init', 'sup_create_posttype' );