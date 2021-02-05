<?php
  $image = get_field('header_image');
  $archiveImage = get_field($args['post_type'] . '_header_image', 'option')
?>
<div class="headerPage">
  <div class="headerPage__inner">
    <?php if ($image && (!is_archive('blog') || !is_archive('multimedia'))) : ?>
    <div class="headerPage__image">
      <img class="headerPage__imageElement" src="<?= $image['sizes']['1536x1536']; ?>" alt="<?= $image['alt']; ?>">
    </div>
    <?php else : ?>
    <div class="headerPage__image">
      <img class="headerPage__imageElement" src="<?= $archiveImage['sizes']['1536x1536']; ?>"
        alt="<?= $archiveImage['alt']; ?>">
    </div>
    <?php endif; ?>
  </div>
</div>