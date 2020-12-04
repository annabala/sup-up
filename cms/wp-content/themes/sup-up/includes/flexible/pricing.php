<section class="pricing">
  <div class="pricing__inner">
    <div class="container">
      <div class="offset-md-2 col-md-8">
        <div class="pricing__labels">
          <span class="pricing__label" data-aos="fade-up" data-aos-once="true">Typ zabiegu</span>
          <span class="pricing__label" data-aos="fade-up" data-aos-once="true">Koszt</span>
        </div>
        <ul class="pricing__elements" data-aos="fade-up" data-aos-delay="300" data-aos-once="true">
          <?php foreach ($section['elements'] as $index => $el) : ?>
          <li class="pricing__element <?= ($index === 0 || $index === 1) ? 'pricing__element--blue' : '' ?>">
            <div class="pricing__elementTitle">
              <?= $el['el']['el_name']; ?>
              <?php if ($el['el']['el_additional']) :?>
              <span class="pricing__elementInfo <?= ($index === 0 || $index === 1) ? 'pricing__elementInfo--blue' : '' ?>">
                <?= $el['el']['el_info']; ?>
              </span>
            <?php endif; ?>
            </div>
            <div class="pricing__elementPrice"><?= $el['el_price'] . ' PLN '; ?></div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>