<section class="section section__smallRedBoxes">
  <div class="container">
    <div class="smallRedBoxes">
      <p class="smallRedBoxes__description"> <?= $section['text'] ?> </p>

      <?php
        if ($section['boxes']):
          foreach ($section['boxes'] as $box):
      ?>
        <div class="smallRedBoxes__box" data-aos="fade-up" data-aos-once="true">
          <span class="icon icon-bus"></span>
          <?= $box['text'] ?>
        </div>
      <?php
          endforeach;
        endif;
      ?>
    </div>
  </div>
</section>