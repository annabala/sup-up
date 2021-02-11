<?php
  $detailsList = preg_split('/\r\n|\r|\n/', $section['details']);
?>

<section class="contactContent">
  <div class="contactContent__inner">
    <div class="contactContent__content">
      <div class="contactContent__headings">
        <?php foreach($section['headings'] as $heading) : ?>
        <h3 class="contactContent__heading"><?= $heading['heading'] ?></h3>
        <?php endforeach; ?>
      </div>
      <div class="contactContent__item contactContent__phone">
        <h3 class="contactContent__label">Telefon:</h3>
        <a href="tel:<?= $section['phone'] ?>" class="contactContent__value contactContent__value--hover">
          <?= $section['phone'] ?>
          (<?= $section['phone_label'] ?>)
        </a>
      </div>
      <div class="contactContent__item contactContent__email">
        <h3 class="contactContent__label">E-mail:</h3>
        <a href="mailto:<?= $section['email'] ?>"
          class="contactContent__value contactContent__value--hover"><?= $section['email'] ?></a>
      </div>
      <div class="contactContent__details">
        <h3 class="contactContent__label">Dane do firmy:</h3>
        <?php foreach ($detailsList as $detail) : ?>
        <p class="contactContent__value"><?= $detail ?></p>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="contactContent__images">
      <?php foreach($section['images'] as $image) : ?>
      <div class="contactContent__imageWrapper">
        <figure class="contactContent__image">
          <img class="contactContent__imageEl" src="<?= $image['image']['sizes']['medium'] ?>"
            alt="<?= $image['image']['title'] ?>">
        </figure>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="contactContent__widget">
      <?= do_shortcode("{$section['fb_widget']}") ?>
    </div>
  </div>
</section>