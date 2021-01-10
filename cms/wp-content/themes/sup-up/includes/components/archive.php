<div class="content">
  <div class="content__inner container">
    <h1 class="content__pageTitle">SUP <?= strtoupper($args['post_type']) ?></h1>
    <?php get_template_part('includes/components/archive-default-list', null, array(
        'post_type' => $args['post_type'],
      )); ?>
    <div class="content__content wysiwyg">
      <?php the_field($args['post_type'] . '_content', 'option'); ?>
    </div>
  </div>
</div>