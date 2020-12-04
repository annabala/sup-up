<footer class="footer">
  <div class="footer__inner">
    <?php if (!is_page('Kontakt')): ?>
      <div class="footer__top">
        <div class="footer__topWrapper" style="background-color:<?= get_field('bg_top' ,'option'); ?>">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <h2 class="section__heading--large footer__heading" data-aos="fade-left" data-aos-once="true">
                  <span
                    class="section__heading--color section__heading--colorBlack footer__heading--small"><?= get_field('heading_small', 'option'); ?></span>
                  <?= get_field('heading_big' ,'option'); ?>
                </h2>
              </div>
              <div class="col-12">
                <ul class="footer__icons row">
                  <?php
                    if( have_rows('icon_el', 'option') ):
                      while ( have_rows('icon_el', 'option') ) : the_row();
                  ?>
                  <li class="footer__icon col-md-4">
                    <img src="<?= get_sub_field('icon')['sizes']['medium']; ?>" alt="">
                    <p class="footer__iconText"><?= get_sub_field('icon_text'); ?></p>
                  </li>
                  <?php
                    endwhile;
                      endif;
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <div class="footer__bottom">
      <div class="footer__bottomWrapper" style="background-color:<?=get_field('bg_bottom' ,'option'); ?>">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="footer__bottomText">
                &copy;
                <?= date("Y"); ?>
                <?= the_field('text_bottom', 'option') ?>
              </div>
            </div>
            <div class="col-md-6">
              <ul class="footer__socials">
                <?php
                  if( have_rows('socials', 'option') ):
                    while ( have_rows('socials', 'option') ) : the_row();
                ?>
                <?php if(get_sub_field('display_footer')) : ?>
                <li class="footer__social iconCustomWrapper">
                  <a href="<?= the_sub_field('link'); ?>" class="footer__socialLink iconCustom" data-icon="<?= the_sub_field('icon'); ?>"><?= the_sub_field('label'); ?></a>
                </li>
                <?php endif; ?>
                <?php
                  endwhile;
                  endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>