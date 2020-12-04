<?php
if( have_rows('list') ):
  while ( have_rows('list') ) : the_row();
    if( get_row_layout() == 'list-of-three' ):
?>
<section class="section section__listOfThree section--margin">
  <div class="listOfThree">
    <div class="listOfThree__inner">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="section__heading--large listOfThree__heading">
              <span
                class="section__heading--color listOfThree__heading--small"><?= get_sub_field('heading_small'); ?></span>
              <?= get_sub_field('heading_big'); ?>
            </h2>
          </div>
        </div>
        <ul class="listOfThree__elements row">
          <?php
            if( have_rows('element') ):
              while ( have_rows('element') ) : the_row();
          ?>
          <li class="listOfThree__element col-md-4" data-aos="fade-up" data-aos-once="true">
            <img src="<?= get_sub_field('image')['sizes']['large']; ?>" alt="">
            <h3 class="listOfThree__elementHeading"><?= the_sub_field('heading'); ?></h3>
            <div class="listOfThree__elementContent wysiwyg"><?= the_sub_field('text'); ?></div>
          </li>
          <?php
            endwhile;
              endif;
          ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php
  endif;
    endwhile;
      endif;
?>