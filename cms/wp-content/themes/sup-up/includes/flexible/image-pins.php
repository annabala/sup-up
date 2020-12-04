<?php
if( have_rows('list') ):
  while ( have_rows('list') ) : the_row();
    if( get_row_layout() == 'image-pins' ):
?>
<section class="section section__imagePins section--margin">
  <div class="imagePins">
    <div class="imagePins__wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="section__heading--large imagePins__heading">
            <span class="section__heading--color imagePins__heading--small"><?= get_sub_field('heading_small'); ?></span>
            <?= get_sub_field('heading_big'); ?>
          </h2>
        </div>
        <div class="col-12">
          <div class="imagePins__container opacityAnimation__container" data-image-container>
            <div class="imagePins__image opacityAnimation" data-image data-aos="fade-up" data-aos-once="true">
              <img src="<?= get_sub_field('image')['sizes']['large']; ?>" alt="<?= get_sub_field('image')['alt']; ?>" class="imagePins__imageElement">
              <?php
              if( have_rows('element') ):
                $index = 0;
                  while ( have_rows('element') ) : the_row();
              ?>
              <div class="imagePins__pin" data-pin data-pin-index="<?= $index++; ?>" data-body-part="<?= the_sub_field('body_part'); ?>">
                <span class="imagePins__pin--outer"></span>
                <span class="imagePins__pin--inner"></span>
              </div>
              <div class="imagePins__pinWrapper" data-image-wrapper>
                <div class="imagePins__pinContent wysiwyg <?= (get_sub_field('body_part') === 'ankle') ? 'imagePins__pinContent--bottom' : '' ?>">
                  <?= the_sub_field('content'); ?>
                </div>
              </div>
              <?php
                endwhile;
                  endif;
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
</section>
<?php
  endif;
    endwhile;
      endif;
?>