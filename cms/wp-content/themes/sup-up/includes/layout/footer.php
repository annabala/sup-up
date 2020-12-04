<footer class="footer">
  <div class="footer__inner">
    <div class="container">
      <div class="footer__content">
        <ul class="footer__socials iconSocials">
          <?php
                    if( have_rows('social_media', 'option') ):
                      while ( have_rows('social_media', 'option') ) : the_row();
                  ?>
          <li class="footer__social">
            <a href="<?= the_sub_field('link'); ?>"
              class="footer__socialLink iconSocial iconSocial--bigger iconSocial--<?= the_sub_field('icon'); ?> icon-<?= the_sub_field('icon'); ?>"></a>
          </li>
          <?php
                    endwhile;
                    endif; ?>
        </ul>
        <div class="footer__text">
          &copy;
          <?= date("Y"); ?>
          <?= the_field('text_bottom', 'option') ?>
        </div>
      </div>
    </div>
  </div>
</footer>