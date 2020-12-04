import Swiper from 'swiper/js/swiper';

export default class HomeSlider {
  constructor() {

    if (!this.setVars()) return;

    this.initSlider();
  }

  setVars() {

    this.slider = document.querySelector('.slider');
    if (!this.slider) return;

    this.selectors = {
      navigation: '.slider__control',
      prev: '.swiper-button-prev',
      next: '.swiper-button-next',
    };

    this.navigation = document.querySelector(this.selectors.navigation);

    this.setting = {
      media: '(max-width: 991.99px)',
    };

    this.config = {
      // Optional parameters
      direction: 'horizontal',
      loop: true,
      speed: 1000,
      fadeEffect: {
        crossFade: true,
      },
      // autoplay: {
      //   delay: 4000,
      //   disableOnInteraction: false,
      // },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
        renderBullet(index, className) {
          return `<span class="${className} slider__bullet"></span>`;
        },
      },
      // Navigation arrows
      // navigation: {
      //   nextEl: '.swiper-button-next',
      //   prevEl: '.swiper-button-prev',
      // },
      on: {
        init: () => {
          window.dispatchEvent(
            new CustomEvent('home-header-init'),
          );

          if (!this.mobile) {
            const slideActive = document.querySelector('.swiper-slide-active .slider__slideContent');
            slideActive.classList.add('slider__slideContent--active');
          }


        },
        transitionStart: () => {
          const slideActive = document.querySelector('.swiper-slide-active .slider__slideContent');
          const slideNext = document.querySelector('.swiper-slide-next .slider__slideContent');
          const slidePrev = document.querySelector('.swiper-slide-prev .slider__slideContent');

          slideActive.classList.remove('slider__slideContent--active');
          slideNext.classList.remove('slider__slideContent--active');
          slidePrev.classList.remove('slider__slideContent--active');

        },
        transitionEnd: () => {
          const slideActive = document.querySelector('.swiper-slide-active .slider__slideContent');

          slideActive.classList.add('slider__slideContent--active');

        },
      },

    };

    this.mediaMatch = window.matchMedia(this.setting.media);

    this.mobile = false;

    if (this.mediaMatch.matches) {
      this.mobile = true;
    }

    return true;
  }

  initSlider() {
    new Swiper('.slider', this.config);
  }
}
