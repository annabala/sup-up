export default class MobileMenu
{
  constructor()
  {

    if (!this.setVars()) return;

    this.setEvents();
  }

  setVars()
  {
    this.mobileButton = document.querySelector('[data-mobile-toggle]');
    this.menu = document.querySelector('[data-mobile-menu]');
    this.menuList = document.querySelector('.menu__items');

    if (!this.menu) return;

    return true;
  }

  setEvents() {

    this.mobileButton.addEventListener('click', (e) => {
      e.preventDefault();
      this.toggleMenu();
    });
  }

  toggleMenu() {
    this.menu.classList.toggle('menu--active');
    this.menuList.classList.toggle('menu__items--active');
    this.mobileButton.classList.toggle('menu__mobileButton--active');
  }
}
