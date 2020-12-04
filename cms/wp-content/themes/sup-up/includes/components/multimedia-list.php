<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
  'posts_per_page' => 12,
  'post_type'      => 'multimedia',
  'order'          => 'ASC',
  'paged'          => $paged,
);

$the_query = new WP_Query($args);

?>
<section class="section section__multimediaList">
  <div class="multimediaList">
    <div class="multimediaList__inner container">
      <div class="multimediaList__container">
        <ul class="multimediaList_items row">
          <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
          ?>
          <li class="multimediaList__item col-lg-6 col-xl-4">
            <?php get_template_part('includes/components/multimedia-item'); ?>
          </li>
          <?php
            endwhile;
          ?>
        </ul>
        <div class="multimediaList__pagination pagination">
          <div class="pagination__inner">
            <?= paginate_links( array(
                    'format'  => 'page/%#%',
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'total'   => $the_query->max_num_pages,
                    'mid_size'        => 2,
                    'prev_text'       => __('Poprzednia'),
                    'next_text'       => __('Następna'),
                ) );
              ?>
          </div>
        </div>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</section>