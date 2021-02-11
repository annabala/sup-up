import Swiper from 'swiper/js/swiper';

export default class ImagesSlider {
  constructor() {

    if (!this.setVars()) return;

    this.initSlider();
  }

  setVars() {

    this.slider = document.querySelector('.imagesBlock__slider');
    if (!this.slider) return;

    this.selectors = {
      navigation: '.imagesBlock__control',
      prev: '.imagesBlock-button-prev',
      next: '.imagesBlock-button-next',
    };

    this.navigation = document.querySelector(this.selectors.navigation);

    this.config = {
      // slidesPerView: 3,
      speed: 800,
      // spaceBetween: 35,
      fadeEffect: {
        crossFade: true,
      },
      // autoplay: {
      //   delay: 4000,
      //   disableOnInteraction: false,
      // },
      navigation: {
        nextEl: '.imagesBlock__next',
        prevEl: '.imagesBlock__prev',
      },
      breakpoints: {
        // when window width is >= 320px
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        // when window width is >= 480px
        600: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        // when window width is >= 640px
        1024: {
          slidesPerView: 3,
          spaceBetween: 35
        }
      }
    };
    return true;
  }

  initSlider() {
    new Swiper('.imagesBlock__slider', this.config);
  }
}
