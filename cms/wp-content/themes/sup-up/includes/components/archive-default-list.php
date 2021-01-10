<?php
$args = array(
  'posts_per_page' => -1,
  'post_type'      => $args['post_type'],
  'order'          => 'ASC',
  'paged'          => $paged,
);

$the_query = new WP_Query($args);

?>
<div class="defaultList wysiwyg wysiwyg--listNoBullets">
  <ul class="defaultList__items">
    <?php
        while ( $the_query->have_posts() ) : $the_query->the_post();
      ?>
    <li class="defaultList__item">
      <a href="<?= the_permalink(); ?>" class="defaultList__itemTitle">
        <?= the_title(); ?>
      </a>
    </li>
    <?php
        endwhile;
      ?>
  </ul>
  <?php wp_reset_postdata(); ?>
</div>