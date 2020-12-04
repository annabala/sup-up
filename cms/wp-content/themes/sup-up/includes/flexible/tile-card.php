<section class="tileCard">
  <div class="tileCard__inner">
    <div class="container">
      <h3 class="tileCard__title h3"><?= $section['title']; ?></h3>
      <div class="tileCard__cards">
        <?php foreach ($section['card'] as $index => $el) : ?>
          <div class="tileCard__card" data-aos="fade-up" data-aos-once="true">
            <div class="tileCard__cardIcon">
              <img class="tileCard__cardIconElement" src="<?= $el['icon']['sizes']['medium']; ?>" alt="">
            </div>
            <span class="tileCard__cardTitle"><?= $el['title']; ?></span>
            <?php if ( $el['info']) : ?>
              <span class="tileCard__cardInfo"><?= $el['info']; ?></span>
            <?php endif; ?>
            <span class="tileCard__cardPrice"><?= $el['price'] . ' zł '; ?></span>
            <a class="tileCard__cardButton button button--arrowWhite button--smallColored" data-popup-trigger href="<?= $el['button']['url']; ?>">
              <?= $el['button']['title']; ?>
            </a>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>