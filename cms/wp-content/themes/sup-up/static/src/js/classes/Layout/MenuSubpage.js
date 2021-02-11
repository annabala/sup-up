export default class MenuSubpage {
  constructor() {

    if (!this.setVars()) return;

    this.setEvents();
  }

  setVars() {
    this.subMenuItems = document.querySelectorAll('.sub-menu .menu-item > a');

    if (!this.subMenuItems) return;

    return true;
  }

  setEvents() {
    this.subMenuItems.forEach((item) => {
      item.setAttribute('data-scroll-to', item.title);
    });
  }
}
