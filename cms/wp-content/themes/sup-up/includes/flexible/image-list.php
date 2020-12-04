<?php
if( have_rows('list') ):
  while ( have_rows('list') ) : the_row();
    if( get_row_layout() == 'image-list' ):
?>
<section class="section section__imageList section--margin">
  <div class="imageList">
    <div class="imageList__wrapper">
      <div class="imageList__wrapper--map" style="background-image:url(<?= get_sub_field('map')['sizes']['large']; ?>)">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h1 class="imageList__heading">
                <span class="section__heading--color imageList__heading--small"><?= get_sub_field('heading_small'); ?></span>
                <?= get_sub_field('heading_big'); ?>
              </h1>
            </div>
            <div class="col-lg-6">
              <div class="imageList__container">
                <article class="imageList__description">
                  <ul class="imageList__elements">
                  <?php
                    if( have_rows('list_element') ):
                      while ( have_rows('list_element') ) : the_row();
                  ?>
                    <li class="imageList__element" data-aos="fade-up" data-aos-once="true">
                      <?php if(get_sub_field('icon') === 'heart') : ?>
                        <img class="imageList__elementIcon" src="<?php echo get_template_directory_uri(); ?>/static/src/img/heart.svg" alt="">
                      <?php elseif(get_sub_field('icon') === 'like') : ?>
                        <img class="imageList__elementIcon" src="<?php echo get_template_directory_uri(); ?>/static/src/img/like.svg" alt="">
                      <?php else : ?>
                        <img class="imageList__elementIcon" src="<?php echo get_template_directory_uri(); ?>/static/src/img/head.svg" alt="">
                      <?php endif; ?>
                      <h3 class="imageList__elementHeading"><?= the_sub_field('heading'); ?></h3>
                      <div class="imageList__elementContent"><?= the_sub_field('text'); ?></div>
                    </li>
                  <?php
                    endwhile;
                      endif;
                  ?>
                  </ul>
                </article>
              </div>
            </div>
          <div class="col-lg-6">
            <img src="<?= get_sub_field('image')['sizes']['large']; ?>" alt="<?= get_sub_field('image')['alt']; ?>" class="imageList__image" data-aos="fade-up" data-aos-once="true">
          </div>
        </div>
      </div>
      </div>

    </div>
  </div>
</section>
<?php
  endif;
    endwhile;
      endif;
?>