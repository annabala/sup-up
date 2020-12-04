<?php
/**
 * Template Name: Strona główna
 */
get_header(); ?>

<main class="sections">
  <?php get_template_part( 'includes/components/slider-home'); ?>

  <?php get_template_part( 'includes/flexible/moved-grid-content'); ?>

  <?php get_template_part('includes/flexible/_core'); ?>
</main>

<?php get_footer(); ?>