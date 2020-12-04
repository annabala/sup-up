import { gsap } from 'gsap';

export default class MobileMenu {
  constructor() {

    if (!this.setVars()) return;

    this.setEvents();
  }

  setVars() {
    this.mobileButton = document.querySelector('[data-mobile-toggle]');
    this.menu = document.querySelector('[data-mobile-menu]');
    this.menuList = document.querySelector('.menu__items');
    this.menuItems = document.querySelectorAll('.menu-item-has-children');
    this.subMenuItems = document.querySelectorAll('.sub-menu .menu-item');

    const mediaMatch = window.matchMedia('(max-width: 1023px)');
    if (mediaMatch.matches) {
      this.mobile = true;
    }
    if (!this.mobile) return;

    if (!this.menu) return;

    return true;
  }

  setEvents() {

    document.addEventListener('resize', () => {
      const mediaMatch = window.matchMedia('(max-width: 1023px)');
      if (mediaMatch.matches) {
        this.mobile = true;
      }
      if (!this.mobile) return;
      return true;
    });

    this.mobileButton.addEventListener('click', (e) => {
      e.preventDefault();
      this.toggleMenu();
    });

    this.menuItems.forEach((item) => {
      item.addEventListener('click', event => this.toggleChildMenu(event));
    });

    this.subMenuItems.forEach((item) => {
      item.addEventListener('click', (event) => {
        event.stopPropagation();
      });
    });

  }

  toggleMenu() {
    this.menu.classList.toggle('menu--active');
    this.menuList.classList.toggle('menu__items--active');
    this.mobileButton.classList.toggle('menu__mobileButton--active');
  }

  // eslint-disable-next-line class-methods-use-this
  toggleChildMenu(event) {
    event.preventDefault();

    const target = event.currentTarget;
    const targetChildList = target.querySelector('.sub-menu');
    targetChildList.style.position = 'static';
    gsap.set(targetChildList, { height: 'auto' });

    if (!target.hasClass('menu-itemParent--active')) {
      // eslint-disable-next-line no-magic-numbers
      gsap.from(targetChildList, { height: 0, duration: 0.4 });
      target.addClass('menu-itemParent--active');
      this.menu.addClass('menu--scroll');
    } else {
      target.removeClass('menu-itemParent--active');
      this.menu.removeClass('menu--scroll');
      gsap.to(targetChildList, { height: 0, duration: 0.4 });
    }
  }
}
