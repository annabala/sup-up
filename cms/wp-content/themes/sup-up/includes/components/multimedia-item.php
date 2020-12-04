<?php
  $publishDate = get_the_date('d.m.Y \,\ G:i');
  $modifyDate  = get_the_modified_date('d.m.Y \,\ G:i');
  $image       = get_field('folder_cover');

?>
<div class="multimediaItem" data-aos="fade-up" data-aos-once='true'>
  <div class="multimediaItem__inner">
    <a href="<?= the_permalink(); ?>" class="multimediaItem__imageWrapper">
      <img src="<?= $image['sizes']['medium_large'] ?>" alt="<?= $image['title'] ?>" class="multimediaItem__image">
    </a>
    <div class="multimediaItem__date">
      <?= $publishDate ?>
      <?php if ($modifyDate > $publishDate) : ?>
      <span>, aktualizacja: <?= $modifyDate ?></span>
      <?php endif; ?>
    </div>
    <a href="<?= the_permalink(); ?>" class="multimediaItem__titleWrapper">
      <h2 class="multimediaItem__title"><?= the_title(); ?>
      </h2>
    </a>
  </div>
</div>