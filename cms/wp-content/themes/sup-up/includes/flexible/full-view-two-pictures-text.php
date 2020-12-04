<?php
  $picture = $section['main_picture'];
  $smallPicture = $section['small_picture'];
  $isBigger = $section['small_picture_bigger'];
?>
<section class="section section__fullSizePictures">
  <div class="fullSizePictures">
    <div class="container">
      <div class="row">
        <div class="fullSizePictures__wrapper col-lg-5">
          <?php if ($picture) : ?>
            <div class="fullSizePictures__imageWrapper" data-aos="fade-right" data-aos-once="true">
              <img class="fullSizePictures__image fullSizePictures__image--right" src="<?= $picture['url'] ?>" alt="<?= $picture['alt'] ?>"/>
            </div>
          <?php endif; ?>
        </div>

        <div class="fullSizePictures__wrapper fullSizePictures__wrapper--content col-lg-7">
          <?php if ($smallPicture) : ?>
            <div class="fullSizePictures__imageWrapper<?= $isBigger ? ' fullSizePictures__imageWrapper--bigger' : '' ?>" data-aos="fade-left" data-aos-once="true">
              <img class="fullSizePictures__image fullSizePictures__image--left <?= $isBigger ? ' fullSizePictures__image--bigger' : '' ?>" src="<?= $smallPicture['sizes']['medium_large'] ?>" alt="<?= $smallPicture['alt'] ?>"/>
            </div>
          <?php endif; ?>

          <div class="fullSizePictures__content">
            <h2 class="fullSizePictures__title" data-aos="fade-right" data-aos-once="true"> <?= $section['title'] ?> </h2>

            <div class="fullSizePictures__text" data-aos="fade-left" data-aos-once="true">
              <?= $section['text'] ?>
            </div>

            <?php if ($section['buttons']) : ?>
              <div class="fullSizePictures__buttons">
                <?php foreach ($section['buttons'] as $key => $button) : ?>
                  <a href="#"
                     class="fullSizePictures__button"
                     <?= ($button['button']['value'] === 'booking') ? 'data-popup-trigger' : 'data-popup-offer-trigger'; ?>>
                    <span> <?= $button['button']['label'] ?> </span> <i class="icon icon-arrow-right"></i>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_template_part('includes/components/popup-offer'); ?>
