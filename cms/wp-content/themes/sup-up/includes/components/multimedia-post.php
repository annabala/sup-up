<?php
  $multimediaImage = get_field('folder_cover') ;
  $imageGallery = get_field('folder_images') ;
  $movieGallery = get_field('folder_movies') ;
  $multimediaTextContent  = get_field('post_content') ;
?>

<div class="multimediaPost">
  <div class="multimediaPost__inner">
    <div class="multimediaPost__container container">
      <div class="multimediaPost__content">
        <div class="multimediaPost__text">
          <?php get_template_part('includes/components/content'); ?>
        </div>
        <?php if ( have_rows('folder_images') ): ?>
        <div class="multimediaPost__itemsTitle">Zdjęcia</div>
        <div class="multimediaPost__items">
          <?php if ( have_rows('folder_images') ):
                while ( have_rows('folder_images') ) : the_row(); ?>
          <a class="multimediaPost__item" href="<?= get_sub_field('folder_image')['url'] ?>" data-fslightbox>
            <img class="multimediaPost__image" src="<?= get_sub_field('folder_image')['sizes']['medium_large'] ?>"
              alt=""></a>
          <?php
            endwhile;
              endif;
          ?>
        </div>
        <?php endif; ?>
        <?php if ( have_rows('folder_movies') ): ?>
        <div class="multimediaPost__itemsTitle">Filmy</div>
        <div class="multimediaPost__items">
          <?php if ( have_rows('folder_movies') ):
                while ( have_rows('folder_movies') ) : the_row(); ?>
          <a class="multimediaPost__item multimediaPost__item--movie" href="<?= get_sub_field('folder_movieUrl') ?>"
            data-type="video" data-fslightbox>
            <img class="multimediaPost__image" src="<?= get_sub_field('folder_movieCover')['sizes']['medium_large']?>"
              alt="movie" />
            <span data-type="Videos" class="multimediaPost__play"></span>
          </a>
          <?php
            endwhile;
              endif;
          ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>