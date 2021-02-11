/* eslint-disable class-methods-use-this */
import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { each } from '../../vendors/helpers/array';

export default class ScrollTop {
  constructor() {
    this.init();
    this.bindDocEvents();
    this.refresh();
  }

  init() {
    this.header = document.querySelector('.header');
    this.triggersArr = [];
  }

  bindDocEvents() {
    this.onTriggerClick = this.onTriggerClick.bind(this);
  }

  refresh() {
    this.unbindEvents();
    this.triggersArr = document.querySelectorAll('[data-scroll-to]');
    this.bindEvents();
  }

  bindEvents() {
    gsap.registerPlugin(ScrollToPlugin);

    each(this.triggersArr, (trigger) => {
      trigger.addEventListener('click', this.onTriggerClick);
    });
  }

  unbindEvents() {
    each(this.triggersArr, (trigger) => {
      trigger.removeEventListener('click', this.onTriggerClick);
    });
  }

  onTriggerClick(e) {
    const targetId = e.target.getAttribute('data-scroll-to');
    this.targetEl = document.querySelector(`[data-scroll-target="${targetId}"]`);
    if (!this.targetEl) return;

    e.preventDefault();
    this.scrollToTarget(this.targetEl);
  }

  scrollToTarget(targetEl) {
    this.scrollTo(targetEl);
    console.log(targetEl);
  }

  scrollTo(targetEl) {
    gsap.to(window, { duration: 1.2, scrollTo: { y: targetEl, offsetY: 200 } });

  }
}
