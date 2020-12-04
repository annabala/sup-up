<?php
  $pages = get_posts([
    'posts_per_page' => -1,
    'post_type' => 'offer',
    'parent'    => 0,
    'meta_key'    =>'order',
    'orderby'			=> 'meta_value_num',
    'order'				=> 'ASC',
  ]);
?>
<section class="section section__offerBanner">
  <div class="offerBanner">
    <div class="offerBanner__container container">
      <img class="offerBanner__background" src="<?= get_field('offer-img-single')['url'] ?>"
           alt="<?= get_field('offer-img-single')['alt'] ?>"/>
      <div class="offerBanner__inner">
        <h1 class="offerBanner__title" data-aos="fade-left" data-aos-once="true">
          <?= get_field('offer-title-single') ?>
        </h1>
        <ul class="offerBanner__nav" data-aos="fade-left" data-aos-once="true">
          <?php foreach ($pages as $key => $page) : ?>
            <li class="offerBanner__navElement<?= $page->ID == $post->ID ? ' offerBanner__navElement--active' : '' ?>">
              <a href="<?= get_permalink($page->ID) ?>">
                <?= get_the_title($page->ID) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>