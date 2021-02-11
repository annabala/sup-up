<div class="flexibleContainer" data-scroll-target="page-nav">
  <div class="container">
    <div class="flexibleContainer__inner">
      <?php if(!empty($args['navigation'])) : ?>
      <nav class="flexibleContainer__nav">
        <?php foreach($args['navigation'] as $item) : ?>
        <button class="flexibleContainer__item" data-scroll-to="<?= $item ?>">SUP
          <?= ucfirst($item) ?></button>
        <?php endforeach; ?>
      </nav>
      <?php endif; ?>
      <?php get_template_part('includes/flexible/_core'); ?>
    </div>
  </div>
</div>