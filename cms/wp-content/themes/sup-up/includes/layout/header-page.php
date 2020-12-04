<?php
  $colorDesc = get_field('page_color_desc');
  $addImage  = get_field('add_image');
  $object    = get_queried_object();
?>
<div class="headerPage">
  <div class="headerPage__inner">
  <?php if ($addImage) : ?>
  <div class="headerPage__image">
    <img class="headerPage__imageElement" src="<?= get_field('header_image')['sizes']['1536x1536']; ?>"
        alt="<?= get_field('header_image')['alt']; ?>">
  </div>
  <?php endif; ?>
    <div class="container">
      <?php if (is_singular('offer') || is_singular('blog')) : ?>
      <div class="breadcrumbs">
        <?php
          if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p class="breadcrumbs__inner">','</p>' );
          }
        ?>
      </div>
        <?php endif; ?>
      <?php if (is_singular('offer') || is_singular('blog')) : ?>
        <h2 class="headerPage__title" data-aos="fade-right">
          <span class="headerPage__heading--h1 section__heading--h1">
          <?php if (is_singular('blog')) : ?>
            Blog
          <?php elseif(is_singular('offer')) : ?>
            Usługi
          <?php endif; ?>
          </span>
        </h2>
      <?php else:  ?>

      <h1 class="headerPage__title" data-aos="fade-right">
        <?php if ($colorDesc) : ?>
          <span class="headerPage__heading--small section__heading--color"><?= $colorDesc; ?></span>
        <?php endif; ?>
        <span class="headerPage__heading--h1 section__heading--h1">
        <?php if(is_singular('page')) : ?>
          <?= $object->post_title; ?>
        <?php elseif(is_archive()) : ?>
          <?= $object->label; ?>
        <?php endif; ?>
        </span>
      </h1>
      <?php endif; ?>
    </div>
  </div>
</div>