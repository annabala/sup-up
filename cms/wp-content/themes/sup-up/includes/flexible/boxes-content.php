<?php
if( have_rows('list') ):
  while ( have_rows('list') ) : the_row();
    if( get_row_layout() == 'boxes-content' ):
?>
<section class="section section__boxesContent">
  <div class="boxesContent">
    <div class="container">
      <div class="boxesContent__container" data-boxes-container>
        <?php if ( have_rows('box') ):
          while ( have_rows('box') ) : the_row();
          $bg = "background-color:". get_sub_field('box_bg') ."";
          $color = "color:". get_sub_field('box_colorText') ."";
          $box_elColor = "background-color:". get_sub_field('box_elColor') ."";
        ?>
        <div class="boxesContent__box boxesContent__box--col<?= get_sub_field('box_width') ?>"
          style="<?= get_sub_field('box_addBg') ? $bg : '' ?><?= get_sub_field('box_changeColor') ? $color : '' ?>"
          data-box data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">
          <?php if (!empty(get_sub_field('box_icon'))) : ?>
          <div class="boxesContent__iconWrapper">
            <div class="boxesContent__iconAfterEl"
              style="<?= get_sub_field('box_changeElColor') ? $box_elColor : '' ?>"></div>
            <img class="boxesContent__icon" src="<?= get_sub_field('box_icon')['sizes']['medium'] ?>"
              alt="<?= get_sub_field('box_title') ?>">
          </div>
          <?php endif; ?>
          <h2 class="boxesContent__title"><?= get_sub_field('box_title') ?></h2>
          <div class="boxesContent__content"><?= get_sub_field('box_content') ?></div>
          <?php if (!empty(get_sub_field('box_buttonBg'))) : ?>
          <a class="boxesContent__button button button--yellow"
            style="<?= get_sub_field('box_changeColor') ? $color : '' ?>"
            href="<?= get_sub_field('box_buttonBg')['url'] ?>"><span><?= get_sub_field('box_buttonBg')['title'] ?></span></a>
          <?php elseif(!empty(get_sub_field('box_button'))) : ?>
          <a class="boxesContent__button button button--borderBottom"
            style="<?= get_sub_field('box_changeColor') ? $color : '' ?>"
            href="<?= get_sub_field('box_button')['url'] ?>"><span><?= get_sub_field('box_button')['title'] ?></span></a>
          <?php endif; ?>
        </div>
        <?php
          endwhile;
            endif;
        ?>
      </div>
    </div>
  </div>
  </div>
</section>
<?php
  endif;
    endwhile;
      endif;
?>