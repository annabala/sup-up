<section class="imagesBlock">
  <div class="imagesBlock__inner">
    <div class="imagesBlock__slider">
      <div class="swiper-wrapper">
        <?php foreach($section['images'] as $image) : ?>
        <?php if($image['image']['url']) : ?>
        <div class="imagesBlock__imageWrapper swiper-slide">
          <a href="<?= $image['image']['url'] ?>" data-fslightbox><img class="imagesBlock__image"
              src="<?= $image['image']['sizes']['medium_large'] ?>" alt="<?= $image['image']['title'] ?>"></a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="imagesBlock__control">
      <div class="imagesBlock__prev icon-arrow-long"></div>
      <div class="imagesBlock__next icon-arrow-long"></div>
    </div>
  </div>
</section>