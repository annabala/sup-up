import Macy from 'macy';
export default class Masonry {
  constructor() {
    if (!this.setVars()) return;

    this.bindEvents();
    this.initMasonry();
  }

  setVars() {
    this.lists = document.querySelectorAll('.masonryList');
    if (!this.lists) return;
    return true;
  }

  bindEvents() {
    this.initMasonry = this.initMasonry.bind(this);
  }

  initMasonry() {
    this.lists.forEach((list) => {
      new Macy({
        container: list,
        mobileFirst: true,
        trueOrder: true,
        columns: 1,
        breakAt: {
          320: 1,
          600: 2,
          1024: 3,
        },
        margin: {
          x: 20,
          y: 20,
        }
      })
    });
  }
}
