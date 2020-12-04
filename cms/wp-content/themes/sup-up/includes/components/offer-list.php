<?php

  $args = array(
    'numberposts' => -1,
    'post_type'   => 'offer',
    'meta_key'    =>'order',
    'orderby'			=> 'meta_value_num',
    'order'				=> 'ASC',
  );

$movedGrid = new WP_Query( $args );
?>
<section class="section section__movedGrid">
  <div class="movedGrid movedGrid--smallTop">
    <div class="movedGrid__inner container">
      <div class="movedGrid__container">
        <ul class="movedGrid_items row">
          <?php
            while ( $movedGrid->have_posts() ) : $movedGrid->the_post();
          ?>
            <?php get_template_part('includes/components/offer-tile'); ?>
          <?php
            endwhile;
            wp_reset_postdata();
          ?>
        </ul>
      </div>
    </div>
  </div>
</section>