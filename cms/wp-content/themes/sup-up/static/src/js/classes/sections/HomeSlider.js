import Swiper from 'swiper/js/swiper';

export default class HomeSlider
{
  constructor()
  {

    if (!this.setVars()) return;

    this.setEvents();
    this.initSlider();
  }

  setVars()
  {

    this.slider = document.querySelector('.slider');
    if (!this.slider) return;

    this.selectors = {
      homeHeader: '[data-header-position]',
      navigation: '.slider__control',
      prev:       '.swiper-button-prev',
      next:       '.swiper-button-next',
    };

    this.navigation = document.querySelector(this.selectors.navigation);
    this.header = document.querySelector(this.selectors.homeHeader);
    this.headerPosition = this.header.getBoundingClientRect().left.toString();

    this.setting = {
      media : '(max-width: 991.99px)',
    };

    this.config = {
      // Optional parameters
      direction: 'horizontal',
      loop: true,
      speed: 1000,
      fadeEffect: {
        crossFade: true,
      },
      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
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

        }
      },

    };

    this.mediaMatch = window.matchMedia(this.setting.media);

    this.mobile = false;

    if (this.mediaMatch.matches) {
      this.mobile = true;
    }

    return true;
  }

  setEvents() {

    window.addEventListener('home-header-init', () => {
      this.navigation.style.right = `${this.headerPosition}px`;
    });
  }

  initSlider() {

    if (this.mobile) {
      this.config.pagination = {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
        renderBullet(index, className) {
          return `<span class="${className} slider__bullet"></span>`;
        },
      };
    } else {
      this.config.pagination = {
        el: '.swiper-pagination',
        type: 'fraction',
        renderFraction(currentClass, totalClass) {
          return `<span class="slider__fraction--current ${currentClass}"></span>`
          + `<span class="slider__fractionSlash">/<span class="slider__fraction--total
          ${totalClass}"></span></span>`;
        },
      };
    }
    new Swiper('.slider', this.config);
  }
}
