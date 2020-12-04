<?php
$slider = get_field('slider');
?>

<section class="section section__slider">
  <div class="slider">
    <div class="slider__wrapper swiper-wrapper">
      <!-- Slides -->
      <?php if ( have_rows('slider') ):
          while ( have_rows('slider') ) : the_row();
        ?>
      <?php
          $bg = "background-image:url(".get_sub_field('slider_bg')['sizes']['large'].")";
          $gradient = 'background-image:radial-gradient(circle, rgba(234,244,248,1) 0%, rgba(198,231,251,1) 50%, rgba(159,216,254,1) 100%);';
         ?>
      <div class="swiper-slide slider__slide"
        style="<?= (get_sub_field('slider_bg')['sizes']['large']) ? $bg : $gradient; ?>">
        <div class="container slider__slideInner">
          <div class="slider__slideImg">
            <img class="slider__slideImgElem <?= get_sub_field('slider_img_big') ? 'slider__slideImgElem--big' : '' ?>"
              src="<?= get_sub_field('slider_img')['sizes']['large'] ?>" alt="">
          </div>
          <div class="slider__slideContent" data-gradient="<?= get_sub_field('slider_mobile_gradient')?>">
            <div class="slider__slideHeading"><?= get_sub_field('slider_heading') ?></div>
            <div class="slider__slideText"><?= get_sub_field('slider_text') ?></div>
            <?php if (!empty(get_sub_field('slider_btn_extra'))) : ?>
            <?php
                  if ( have_rows('slider_btn_extra') ):
                    while ( have_rows('slider_btn_extra') ) : the_row();
                ?>
            <a href="<?= get_sub_field('btn_extra')['url'] ?>"
              class="button button--bgWhite button--icon slider__button">
              <?= get_sub_field('btn_extra')['title'] ?>
              <img src="<?= get_sub_field('btn_icon')['sizes']['large'] ?>" alt="">
            </a>
            <?php
                    endwhile;
                  endif;
                ?>
            <?php else : ?>
            <a href="<?= get_sub_field('slider_button')['url'] ?>"
              class="button button--bgWhite button--arrow slider__button">
              <?= get_sub_field('slider_button')['title'] ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php
          endwhile;
            endif;
        ?>
    </div>
    <div class="slider__control">
      <!-- <div class="swiper-button-prev slider__prev"></div> -->
      <div class="swiper-pagination slider__pagination"></div>
      <!-- <div class="swiper-button-next slider__next"></div> -->
    </div>

  </div>
</section>