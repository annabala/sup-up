<?php
  $multimediaLead = get_field('post_lead') ;
  $multimediaImage = get_field('folder_cover') ;
  $imageGallery = get_field('folder_images') ;
  $movieGallery = get_field('folder_movies') ;
  $multimediaTextContent  = get_field('post_content') ;
  $publishDate = get_the_date('d.m.Y \,\ G:i');
  $modifyDate = get_the_modified_date('d.m.Y \,\ G:i');
?>

<div class="multimediaPost">
  <div class="multimediaPost__inner">
    <div class="multimediaPost__header">
      <div class="multimediaPost__headerImage rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
        <img class="multimediaPost__headerImageElement" src="<?= $multimediaImage['sizes']['1536x1536'] ?>"
          alt="<?= $multimediaImage['alt'] ?>">
      </div>
      <div class="multimediaPost__headerTitle rellax" data-rellax-zindex="0" data-rellax-xs-speed="0"
        data-rellax-mobile-speed="0" data-rellax-speed="2">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-left" data-aos-once="true">
              <div class="multimediaPost__headerDate">
                <?= $publishDate ?>
                <?php if ($modifyDate > $publishDate) : ?>
                <span>, aktualizacja: <?= $modifyDate ?></span>
                <?php endif; ?>
              </div>
              <h1 class="multimediaPost__headerTitlePost"><?= the_title(); ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="multimediaPost__container container rellax" data-rellax-zindex="5" data-rellax-xs-speed="0"
      data-rellax-mobile-speed="0" data-rellax-speed="4">
      <div class="multimediaPost__content">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <p class="multimediaPost__lead">
              <?= $multimediaLead; ?>
            </p>
          </div>
          <div class="col-lg-12">
            <div class="multimediaPost__images">
              <?php if ( have_rows('folder_images') ):
                while ( have_rows('folder_images') ) : the_row(); ?>
              <img class="multimediaPost__headerImageElement"
                src="<?= get_sub_field('folder_image')['sizes']['medium'] ?>" alt="">
              <?php
                  endwhile;
                    endif;
                ?>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="multimediaPost__movies">
              <?php if ( have_rows('folder_movies') ):
                while ( have_rows('folder_movies') ) : the_row(); ?>
              <a href="<?= get_sub_field('folder_movieUrl')  ?>">
              </a>
              <div
                style="height: 200px;background-image:url(<?= get_sub_field('folder_movieCover')['sizes']['medium']?>);">
              </div>

              <?php
                  endwhile;
                    endif;
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>