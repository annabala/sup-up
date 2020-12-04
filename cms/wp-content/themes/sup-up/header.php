<!DOCTYPE html>
<html lang="pl" dir="ltr">

<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="Fizjoterapia i sport">
  <?php global $title; ?>
  <title>Fizjoterapia i sport</title>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/static/dist/css/styles.css">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="header">
    <div class="container" data-header-position>
      <div class="header__wrapper">
        <div class="header__logo">
          <a href="<?= get_site_url(); ?>"><img src="<?php the_field('logo', 'option'); ?>" alt="<?php echo bloginfo('name'); ?>" class="header__logoImg"></a>
        </div>
        <button class="menu__mobileButton" data-mobile-toggle>
          <div class="menu__mobileBar"></div>
          <div class="menu__mobileBar"></div>
          <div class="menu__mobileBar"></div>
          <div class="menu__mobileBar"></div>
        </button>
        <nav class="menu header__menu" data-mobile-menu>
          <div class="menu__wrapper">
            <?php
              $args = array(
                'theme_location' => 'primary',
                'menu_class' => 'menu__items',
                'menu_id' => '',
                'container' => false
              );
              wp_nav_menu($args);
            ?>
            <?php if(get_field('booking_visible' , 'option')) : ?>
              <div class="menu__booking">
                <button class="menu__bookingLink button--blue" data-popup-trigger>
                  <?= get_field('booking', 'option')['text'] ?>
                </button>
              </div>
            <?php endif; ?>
          </div>
        </nav>
        <?php if(get_field('booking_visible' , 'option') && is_front_page()) : ?>
          <div class="menu__booking menu__booking--hiddenMobile">
            <button class="menu__bookingLink button--blue" data-popup-trigger>
              <?= get_field('booking', 'option')['text'] ?>
            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </header>