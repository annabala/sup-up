<div class="socialBadge">
  <span class="socialBadge__text">Follow us!</span>
  <ul class="socialsBadge__icons iconSocials">
    <?php
    if( have_rows('social_media', 'option') ):
      while ( have_rows('social_media', 'option') ) : the_row();
  ?>
    <li class="socialBadge__icon">
      <a href="<?= the_sub_field('link'); ?>" target="_blank" rel="noopener noreferrer"
        class="socialBadge__iconLink iconSocial  iconSocial--hoverBlue iconSocial--black icon-<?= the_sub_field('icon'); ?>"></a>
    </li>
    <?php
    endwhile;
      endif; ?>
  </ul>
</div>