<?php
  $blogLead = get_field('blog_lead') ;
  $blogImage = get_field('blog_image') ;
  $blogTextContent  = get_field('blog_content') ;
  $publishDate = get_the_date('d.m.Y \,\ G:i');
  $modifyDate = get_the_modified_date('d.m.Y \,\ G:i');
?>

<div class="blogPost">
  <div class="blogPost__inner">
    <div class="blogPost__header">
      <div class="blogPost__headerImage rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
        <img class="blogPost__headerImageElement" src="<?= $blogImage['sizes']['1536x1536'] ?>"
          alt="<?= $blogImage['alt'] ?>">
      </div>
      <div class="blogPost__headerTitle rellax" data-rellax-zindex="0" data-rellax-xs-speed="0"
        data-rellax-mobile-speed="0" data-rellax-speed="2">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-left" data-aos-once="true">
              <div class="blogPost__headerDate">
                <?= $publishDate ?>
                <?php if ($modifyDate > $publishDate) : ?>
                <span>, aktualizacja: <?= $modifyDate ?></span>
                <?php endif; ?>
              </div>
              <h1 class="blogPost__headerTitlePost"><?= the_title(); ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="blogPost__container container rellax" data-rellax-zindex="5" data-rellax-xs-speed="0"
      data-rellax-mobile-speed="0" data-rellax-speed="4">
      <div class="blogPost__content">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <p class="blogPost__lead">
              <?= $blogLead; ?>
            </p>
          </div>
          <div class="col-lg-10 offset-lg-1">
            <div class="blogPost__text wysiwyg wysiwyg--big wysiwyg--post">
              <?= $blogTextContent; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="blogPost__share">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="blogPost__shareList">
              <p class="blogPost__shareListLabel">Udostępnij: </p>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                target="_blank" class="blogPost__shareListItem"><span class="iconCustom"
                  data-icon="facebook"></span></a>
              <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>+<?php echo get_permalink(); ?>"
                target="_blank" class="blogPost__shareListItem"><span class="iconCustom"
                  data-icon="twitter"></span></a>
              <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>"
                target="_blank" class="blogPost__shareListItem"><span class="iconCustom"
                  data-icon="linkedin"></span></a>
            </div>
          </div>
        </div>
      </div>
      <div class="blogPost__author">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="blogPost__authorInner">
              <?php if($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE): ?>
              <div class="blogPost__authorImage"><?= get_avatar( get_the_author_meta( 'ID' ), 256 ); ?></div>
              <?php endif; ?>
              <div class="blogPost__authorBox">
                <span class="blogPost__authorIntro">O autorze</span>
                <h3 class="blogPost__authorName"><?= get_the_author(); ?></h3>
                <div class="blogPost__authorDesc wysiwyg">
                  <p><?= get_the_author_meta('description'); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
        ?>
    </div>
  </div>
</div>