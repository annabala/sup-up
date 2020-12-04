<section class="section section__contactForm">
  <div class="contactForm">
    <div class="container">
      <?php if ($section['title']): ?>
        <div class="row">
          <h3 class="contactForm__title">
            <?= $section['title'] ?>
          </h3>
        </div>
      <?php endif; ?>

      <div class="row">
        <?php if ($section['show_map']): ?>
          <a href="<?= $section['location']['url'] ?>" target="<?= $section['location']['target']; ?>"
          class="contactForm__column contactForm__column--noPadding col-lg-6" data-aos="fade-right" data-aos-once="true">
            <img src="<?= $section['map']['url'] ?>" alt="<?= $section['map']['alt'] ?>"/>
            <span class="contactForm__pin">
              <span class="contactForm__pin--outer"></span>
              <span class="contactForm__pin--inner"></span>
            </span>
          </a>
        <?php else: ?>
          <div class="contactForm__column col-lg-6 wysiwyg wysiwyg--big" data-aos="fade-right" data-aos-once="true">
            <?= $section['text'] ?>
          </div>
        <?php endif; ?>

        <div class="contactForm__column contactForm__column--noPadding col-lg-6" data-aos="fade-left" data-aos-once="true">
          <div class="contactForm__formWrapper">
            <div class="contactForm__form">
              <?= do_shortcode("{$section['contact_form']}") ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>