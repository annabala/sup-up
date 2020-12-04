<section class="section section__columnsIconText">
  <div class="container">
    <ul class="columnsIconText" data-aos="fade-left" data-aos-once="true">
      <?php
        if ($section['column']):
          foreach ($section['column'] as $column):
      ?>
      <li class="columnsIconText__wrapper">
        <img src="<?= $column['icon']['sizes']['medium']; ?>" alt="<?= $column['icon']['alt'] ?>">
        <p class="footer__iconText"><?= $column['description'] ?></p>
      </li>
      <?php
          endforeach;
        endif;
      ?>
    </ul>
  </div>
</section>