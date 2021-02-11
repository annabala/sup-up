<?php
  $contact = is_page('Kontakt');
?>
<div class="content">
  <div class="container">
    <div class="content__inner">
      <div class="content__content wysiwyg">
        <?= the_content(); ?>
      </div>
      <?php if ($contact) : ?>
      <?php get_template_part('includes/components/contact'); ?>
      <?php endif; ?>
    </div>
  </div>
</div>