<?php
/**
 * Template Name: Blog
 */
get_header(); ?>

<?php get_template_part('includes/layout/header-page'); ?>

<main>
  <?php get_template_part('includes/components/blog-list'); ?>
</main>

<?php get_footer(); ?>