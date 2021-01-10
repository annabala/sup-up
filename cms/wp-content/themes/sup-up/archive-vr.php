<?php
/**
 * Template Name: VR
 */
$type = 'vr';
get_header(); ?>

<?php get_template_part('includes/layout/header-page', null, array(
  'post_type' => $type,
)); ?>

<main>
  <?php get_template_part('includes/components/archive', null, array(
    'post_type' => $type,
  )); ?>
</main>
<?php get_footer(); ?>