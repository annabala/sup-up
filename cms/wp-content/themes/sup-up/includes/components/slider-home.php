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
        style="<?= (get_sub_field('slider_bg')['sizes']['large'] && !get_sub_field('slider_video_file')) ? $bg : null; ?>">
        <?php if (get_sub_field('slider_video_file')) : ?>
        <div class="slider__slideVideoWrapper" style="<?= $bg ?>">
          <a class="slider__slideVideo" href="<?= get_sub_field('slider_video_file')['url'] ?>" data-type="video"
            data-fslightbox>
            <span data-type="Videos" class="slider__play"></span>
          </a>
        </div>
        <?php endif; ?>
        <div class="container slider__slideInner">
          <div class="slider__slideContent" data-gradient="<?= get_sub_field('slider_mobile_gradient')?>">
            <div class="slider__slideHeading"><?= get_sub_field('slider_heading') ?></div>
            <?php if (!empty(get_sub_field('slider_button'))) : ?>
            <a href="<?= get_sub_field('slider_button')['url'] ?>" class="slider__button button button--yellow">
              <span><?= get_sub_field('slider_button')['title'] ?></span>
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