<?php foreach($args['sections'] as $section) : ?>
<?php
  $title = 'SUP ' . ucfirst($section['section_name']);
?>
<?php get_template_part('includes/components/page-title', null, array(
    'title' => $title,
)); ?>
<div class="flexibleContainer" id="<?= $section['section_name'] ?>"
  data-scroll-target="<?= $section['section_name'] ?>">
  <div class="container">
    <div class="flexibleContainer__inner">
      <?php get_template_part('includes/section-content/_core', null, array(
        'section' => $section['section_content'],
      )); ?>
    </div>
  </div>
</div>
<?php endforeach; ?>