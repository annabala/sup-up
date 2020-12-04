<header class="header" data-header>
  <div class="header__wrapper container-fluid">
    <div class="header__top">
      <div class="header__logo">
        <a href="<?= get_site_url(); ?>"><img src="<?php the_field('logo', 'option'); ?>"
            alt="<?php echo bloginfo('name'); ?>" class="header__logoImg"></a>
      </div>
      <ul class="header__socials iconSocials" data-header-socials>
        <?php
                  if( have_rows('social_media', 'option') ):
                    while ( have_rows('social_media', 'option') ) : the_row();
                ?>
        <li class="header__social">
          <a href="<?= the_sub_field('link'); ?>"
            class="header__socialLink iconSocial iconSocial--smallOnMobile iconSocial--<?= the_sub_field('icon'); ?> icon-<?= the_sub_field('icon'); ?>"></a>
        </li>
        <?php
                  endwhile;
                  endif; ?>
      </ul>
      <button class="menu__mobileButton" data-mobile-toggle>
        <div class="menu__mobileBar"></div>
        <div class="menu__mobileBar"></div>
        <div class="menu__mobileBar"></div>
      </button>
    </div>
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
      </div>
    </nav>
  </div>
</header>