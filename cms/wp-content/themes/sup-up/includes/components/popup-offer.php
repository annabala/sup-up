<section class="section section__contactForm popup" data-popup-offer>
  <div class="contactForm contactForm--popup popup__inner popup__inner--blue">
    <div class="contactForm__formTitleBox">
      <h3 class="contactForm__formTitle">Mam pytanie odnośnie terapii</h3>
    </div>
    <div class="contactForm__form contactForm__form--popup">
      <?= do_shortcode( get_field('offer_form') ) ?>
    </div>
    <a href="#" class="popup__close popup__close--white" data-popup-offer-close></a>
  </div>
</section>