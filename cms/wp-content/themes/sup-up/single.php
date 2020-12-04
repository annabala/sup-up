<?php get_header(); ?>

<?php get_template_part( 'includes/layout/header-page'); ?>

<main class="sections">
  <?php if (is_singular('offer')) : ?>
    <?php get_template_part('includes/components/offer-banner'); ?>
  <?php endif; ?>

  <?php if (is_singular('offer')) : ?>
    <?php get_template_part('includes/flexible/_core'); ?>
  <?php else: ?>
    <?php get_template_part('includes/components/blog-post'); ?>
  <?php endif; ?>

</main>

<?php get_footer(); ?>