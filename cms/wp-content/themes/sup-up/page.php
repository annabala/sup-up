<?php
get_header();
?>
<?php
  $sections = get_field('subpage-sections');
  $navigation = array();
  foreach($sections as $section) {
    array_push($navigation, $section['section_name']);
  }
?>
<?php get_template_part('includes/layout/header-page'); ?>
<div class="sections">
  <?php get_template_part('includes/components/page-title', null, array(
    'title' => get_the_title(),
  )); ?>
  <?php get_template_part('includes/flexible/flexibleContainer', null, array(
    'navigation' => $navigation ? $navigation : [],
  )); ?>
  <?php get_template_part('includes/section-content/sectionContentContainer', null, array(
    'sections' => $sections
  )); ?>
</div>
<?php
get_footer();