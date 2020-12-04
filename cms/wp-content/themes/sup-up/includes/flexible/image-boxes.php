<section class="section section__imageBoxes">
  <div class="container">
    <div class="imageBoxes">
      <h2 class="imageBoxes__title"> <?= $section['title'] ?> </h2>

      <div class="imageBoxes__boxesWrapper row">
        <?php
          if ($section['images']):
            foreach ($section['images'] as $imageIndex => $image):
        ?>
            <a href="<?= $image['link']; ?>" class="imageBoxes__box col-lg-3 col-md-6">
              <div class="imageBoxes__boxInner" data-aos="<?= ($imageIndex > 0) ? 'fade-left' : 'fade-right';  ?>" data-aos-once="true">
                <img class="imageBoxes__boxImage" src="<?= $image['image']['url'] ?>" alt="<?= $image['image']['alt'] ?>"/>
              </div>
            </a>
        <?php
            endforeach;
          endif;
        ?>
      </div>

      <div class="imageBoxes__description wysiwyg">
        <?= $section['description'] ?>
      </div>
    </div>
  </div>
</section>