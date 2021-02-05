<?php
/**
 * Template Name: Multimedia
 */
get_header(); ?>

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

<?php get_template_part('includes/layout/header-page', null, array(
  'post_type' => 'multimedia',
  'title' => 'Multimedia'
)); ?>

<main>

  <section class="section section__blogList">
    <div class="blogList">
      <div class="blogList__inner container">
        <ul class="blogList__items masonryList">
          <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
          ?>
          <li class="blogList__item">
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
                    'prev_text'       => __(''),
                    'next_text'       => __(''),
                ) );
              ?>
          </div>
        </div>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
</main>
<?php get_template_part('includes/components/wave'); ?>
<?php get_footer(); ?>