<section class="section section__textTitle">
  <div class="textSectionTitle" style="background-color:<?= $section['bg_color'] ?>">
    <div class="container">
      <div class="textSectionTitle__inner row">
        <div class="textSectionTitle__titleWrapper col-lg-4">
          <h2 class="textSectionTitle__title" data-aos="fade-right" data-aos-once="true"> <?= $section['title'] ?> </h2>

          <h5 class="textSectionTitle__subtitle" data-aos="fade-left" data-aos-once="true"> <?= $section['subtitle'] ?> </h5>
        </div>

        <div class="textSectionTitle__text col-lg-8 wysiwyg--blueList" data-aos="fade-left" data-aos-once="true">
          <?= $section['text'] ?>
        </div>
      </div>
    </div>
  </div>
</section>