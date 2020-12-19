<header class="header" data-header>
  <div class="header__wrapper">
    <div class="header__top">
      <div class="header__logo">
        <a href="<?= get_site_url(); ?>"><img src="<?php the_field('logo', 'option'); ?>"
            alt="<?php echo bloginfo('name'); ?>" class="header__logoImg"></a>
      </div>
      <button class="menu__mobileButton" data-mobile-toggle>
        <div class="menu__mobileBar"></div>
        <div class="menu__mobileBar"></div>
        <div class="menu__mobileBar"></div>
      </button>
    </div>
    <nav class="menu header__menu" data-mobile-menu>
      <div class="menu__wrapper">
        <?php get_template_part( 'includes/layout/menu'); ?>
      </div>
      <ul class="header__menuSocials iconSocials">
        <?php
        if( have_rows('social_media', 'option') ):
          while ( have_rows('social_media', 'option') ) : the_row();
      ?>
        <li class="header__menuSocialsIcon">
          <a href="<?= the_sub_field('link'); ?>" target="_blank" rel="noopener noreferrer"
            class="header__menuSocialsIconLink iconSocial icon-<?= the_sub_field('icon'); ?>"></a>
        </li>
        <?php
        endwhile;
          endif; ?>
      </ul>
    </nav>
  </div>
</header>