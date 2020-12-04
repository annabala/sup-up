<?php if (get_field('is_popup_active' ,'option')) : ?>
<div class="popup" id="popup" data-popup>
  <div class="popup__inner">
    <div class="popup__icon"></div>
    <div class="popup__content wysiwyg wysiwyg--big">
      <?= get_field('popup_content' ,'option'); ?>
    </div>
    <form class="popup__form" action="<?= get_field('booking', 'option')['url']; ?>" method="post" target="_blank">
      <div class="popup__checkbox">
        <input class="popup__checkboxInput" type="checkbox" id="agree" required>
        <label class="popup__checkboxLabel" for="agree">Akceptuję powyższe warunki</label>
      </div>
      <button class="button--booking button--blue" type="submit"><?= get_field('booking', 'option')['text']; ?></button>
    </form>
    <a href="#" class="popup__close" data-popup-close></a>
  </div>
</div>
<?php endif; ?>