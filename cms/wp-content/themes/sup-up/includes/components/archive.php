<div class="content">
  <div class="container">
    <div class="content__inner">
      <?php get_template_part('includes/components/archive-default-list', null, array(
        'post_type' => $args['post_type'],
      )); ?>
      <div class="content__content wysiwyg">
        <?php the_field($args['post_type'] . '_content', 'option'); ?>
      </div>
    </div>
  </div>
  <?php get_template_part('includes/components/scroll-top'); ?>
</div>