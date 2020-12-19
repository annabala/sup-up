<ul class="socialsBadge iconSocials" data-header-socials>
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