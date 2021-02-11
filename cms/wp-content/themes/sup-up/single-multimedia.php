<?php get_header(); ?>

<?php get_template_part('includes/layout/header-page', null, array(
  'title' => get_the_title(),
)); ?>
<main class="sections">
  <?php get_template_part('includes/components/multimedia-post'); ?>
</main>
<?php get_template_part('includes/components/wave'); ?>
<?php get_footer(); ?>