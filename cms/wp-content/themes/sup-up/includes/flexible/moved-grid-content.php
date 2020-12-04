<?php
$args = array(
  'posts_per_page' => 4,
  'post_type'      => 'offer',
  'order'          => 'DESC',
  'meta_key'       => 'is_home',
  'meta_value'     => true,
);

$movedGrid = new WP_Query( $args );
?>

<section class="section section__movedGrid section--margin">
  <div class="movedGrid">
    <div class="movedGrid__inner container">
      <h2 class="movedGrid__heading section__heading--large headingDecoration" data-aos="fade-right" data-aos-once='true'>
        <svg version="1.1" class="headingDecoration--left" id="line_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="2px" xml:space="preserve">
          <path class="svg__path" fill="#D3DCE6" stroke-width="3" stroke="#D3DCE6" d="M0 0 l800 0"/>
        </svg>
        Usługi
      </h2>
      <div class="movedGrid__container">
        <ul class="movedGrid_items row">
          <?php
            while ($movedGrid->have_posts()) : $movedGrid->the_post();
          ?>
            <?php get_template_part('includes/components/offer-tile'); ?>
          <?php
            endwhile;
            wp_reset_postdata();
          ?>
        </ul>
        <div class="movedGrid__buttonRow">
          <a href="<?= get_post_type_archive_link( 'offer' ); ?>" class="movedGrid__button button button--border button--arrow">Pokaż wszystkie usługi</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>