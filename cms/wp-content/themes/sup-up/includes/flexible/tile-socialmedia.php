<section class="tileSocialMedia">
  <div class="tileSocialMedia__inner">
    <div class="container">
      <div class="row">
        <?php foreach ($section['tile_socialmedia'] as $index => $tile) : ?>
        <div class="col-lg-6" data-aos="<?= ($index > 0) ? 'fade-up-left' : 'fade-up-right';  ?>" data-aos-once="true">
          <div class="tileSocialMedia__item <?= ($index % 2 === 0) ? 'tileSocialMedia__item--blue' : ''?>"
              style="background-image:url('<?= $tile['image_socialmedia']['sizes']['large']; ?>')">
            <h2 class="tileSocialMedia__itemTitle"><?= $tile['heading_socialmedia']; ?></h2>
            <p class="tileSocialMedia__itemContent"><?= $tile['content_socialmedia']; ?></p>
            <a class="tileSocialMedia__itemButton" href="<?= $tile['button_socialmedia']['url']; ?>">
              <?= $tile['button_socialmedia']['title']; ?>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>