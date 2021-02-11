<?php
  $image       = get_field('listing_image');
?>

<div class="blogItem" data-aos="fade-up" data-aos-once='true'>
  <div class="blogItem__inner">
    <a href="<?= the_permalink(); ?>" class="blogItem__imageWrapper">
      <img src="<?= $image['sizes']['medium_large'] ?>" alt="<?= $image['title'] ?>" class="blogItem__image">
    </a>
    <div class="blogItem__content">
      <a href="<?= the_permalink(); ?>" class="blogItem__titleWrapper">
        <h2 class="blogItem__title"><?= the_title(); ?></h2>
      </a>
      <p class="blogItem__desc"><?= get_the_excerpt() ?><a class="blogItem__desc--more" href="<?= the_permalink(); ?>">
          czytaj
          więcej</a></p>
    </div>
  </div>
</div>