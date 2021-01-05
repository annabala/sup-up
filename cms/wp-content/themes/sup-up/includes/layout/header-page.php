<?php
  $image = get_field('header_image');
?>
<div class="headerPage">
  <div class="headerPage__inner">
    <?php if ($image) : ?>
    <div class="headerPage__image">
      <img class="headerPage__imageElement" src="<?= get_field('header_image')['sizes']['1536x1536']; ?>"
        alt="<?= get_field('header_image')['alt']; ?>">
    </div>
    <?php endif; ?>
  </div>
</div>