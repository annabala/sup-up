export default class FixedHeaderOnScroll {
  constructor() {

    if (!this.setVars()) return;

    this.setEvents();
  }

  setVars() {
    this.header = document.querySelector('[data-header]');
    this.fixedClass = 'header--fixed';
    this.fixed = false;


    if (!this.header) return;

    return true;
  }

  setEvents() {
    this.checkFixed = this.checkFixed.bind(this);

    window.addEventListener('liteScroll', this.checkFixed);
  }

  checkFixed(e) {
    const { scrollTop } = e.detail;
    const scrollValue = 100;

    if (scrollTop > scrollValue) {
      if (this.fixed) return;
      this.fixed = true;
      this.header.classList.add(this.fixedClass);
    } else {
      if (!this.fixed) return;
      this.fixed = false;
      this.header.classList.remove(this.fixedClass);
    }
  }

}
