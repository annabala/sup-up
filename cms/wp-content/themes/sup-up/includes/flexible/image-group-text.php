<?php
if( have_rows('list') ):
  while ( have_rows('list') ) : the_row();
    if( get_row_layout() == 'image-group-text' ):
?>
<section class="section section__imageGroupText section--margin">
  <div class="imageGroupText">
    <div class="imageGroupText__wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-once='true'>
            <div class="imageGroupText__images">
              <div class="plus--big"></div>
              <div class="plus--small"></div>
              <img src="<?= get_sub_field('image')['sizes']['large']; ?>" alt="<?= get_sub_field('image')['alt']; ?>"
                class="imageGroupText__image--big">
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-once='true'>
            <h2 class="section__heading--large imageGroupText__heading headingDecoration">
              <span
                class="section__heading--color imageGroupText__heading--small"><?= get_sub_field('heading_small'); ?></span>
              <svg version="1.1" class="headingDecoration--right" id="line_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="2px" xml:space="preserve">
                <path fill="#D3DCE6" stroke-width="3" stroke="#D3DCE6" d="M0 0 l1120 0"/>
              </svg>
              <?= get_sub_field('heading_big'); ?>
            </h2>
            <div class="imageGroupText__container wysiwyg">
              <article class="imageGroupText__description">
                <?= get_sub_field('content'); ?>
              </article>
            </div>
            <?php
            endif;
              endwhile;
                endif;
            ?>
            <p class="imageGroupText__heading--social">
              Znajdziesz mnie na:
            </p>

            <ul class="imageGroupText__socials">
              <?php
                if( have_rows('socials', 'option') ):
                  while ( have_rows('socials', 'option') ) : the_row();
              ?>
              <li class="imageGroupText__social iconCustomWrapper">
                <a href="<?= the_sub_field('link'); ?>" class="imageGroupText__socialLink iconCustom iconCustom--bigPadding" data-icon="<?= the_sub_field('icon'); ?>">
                <?= the_sub_field('label'); ?></a>
              </li>
              <?php
                endwhile;
                endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>