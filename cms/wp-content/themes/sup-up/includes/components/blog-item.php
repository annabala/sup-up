<?php
  $publishDate = get_the_date('d.m.Y \,\ G:i');
  $modifyDate  = get_the_modified_date('d.m.Y \,\ G:i');
  $image       = get_field('blog_image_small') ? get_field('blog_image_small') : get_field('blog_image');
  $lead        = get_field('blog_lead');
  $trimmed     = wp_trim_words( $lead, $num_words = 15, $more = '...' );
?>

<div class="blogItem" data-aos="fade-up" data-aos-once='true'>
  <div class="blogItem__inner">
    <a href="<?= the_permalink(); ?>" class="blogItem__imageWrapper">
      <img src="<?= $image['sizes']['medium_large'] ?>" alt="<?= $image['title'] ?>" class="blogItem__image">
    </a>
    <div class="blogItem__date">
      <?= $publishDate ?>
      <?php if ($modifyDate > $publishDate) : ?>
        <span>, aktualizacja: <?= $modifyDate ?></span>
      <?php endif; ?>
    </div>
    <a href="<?= the_permalink(); ?>" class="blogItem__titleWrapper">
      <h2 class="blogItem__title"><?= the_title(); ?></h2>
    </a>
    <p class="blogItem__desc par"><?= $trimmed; ?><a  class="blogItem__desc--more" href="<?= the_permalink(); ?>"> czytaj więcej</a></p>
  </div>
</div>
