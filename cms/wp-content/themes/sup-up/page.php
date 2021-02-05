<?php
get_header();
?>
<?php get_template_part('includes/layout/header-page'); ?>
<div class="sections">
  <?php get_template_part('includes/components/page-title', null, array(
    'title' => get_the_title(),
  )); ?>
  <?php get_template_part('includes/components/content'); ?>
</div>
<?php
get_footer();