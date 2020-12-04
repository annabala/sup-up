<?php
/**
 * Template Name: Blog
 */
get_header(); ?>

<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
  'posts_per_page' => 12,
  'post_type'      => 'blog',
  'order'          => 'ASC',
  'paged'          => $paged,
);

$the_query = new WP_Query($args);
?>

<?php get_template_part('includes/layout/header-page'); ?>

<main>

<section class="section section__blogList">
  <div class="blogList">
    <div class="blogList__inner container">
      <div class="blogList__container">
        <ul class="blogList_items row">
          <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
          ?>
          <li class="blogList__item col-lg-6 col-xl-4">
            <?php get_template_part('includes/components/blog-item'); ?>
          </li>
          <?php
            endwhile;
          ?>
        </ul>
        <div class="blogList__pagination pagination">
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
</main>

<?php get_footer(); ?>