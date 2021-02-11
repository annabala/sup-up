<footer class="footer">
  <?php get_template_part('includes/components/scroll-top'); ?>
  <div class="footer__inner">
    <div class="container">
      <div class="footer__content">
        <div class="footer__logo">
          <a href="<?= get_site_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/static/src/img/logo-white.svg"
              alt="<?php echo bloginfo('name'); ?>" class="footer__logoImage"></a>
        </div>
        <ul class="footer__socials iconSocials">
          <?php
          if( have_rows('social_media', 'option') ):
            while ( have_rows('social_media', 'option') ) : the_row();
          ?>
          <li class="footer__social">
            <a href="<?= the_sub_field('link'); ?>" target="_blank" rel="noopener noreferrer"
              class="footer__socialLink iconSocial iconSocial--bigger icon-<?= the_sub_field('icon'); ?>"></a>
          </li>
          <?php
            endwhile;
            endif; ?>
          <li class="footer__social iconSocials">
            <a href="mailto:<?php the_field('contact_mail', 'option'); ?>"
              class="footer__socialLink iconSocial iconSocial--bigger icon-email"></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>