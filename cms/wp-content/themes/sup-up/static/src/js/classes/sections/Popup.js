export default class Popup
{
  constructor()
  {
    if (!this.setVars()) return;

    this.setEvents();
  }

  setVars()
  {

    this.selectors = {
      trigger: '[data-popup-trigger]',
      popup: '[data-popup]',
      closePopup: '[data-popup-close]',
    };

    this.classes = {
      active: 'popup--open',
    };

    return true;
  }

  setEvents()
  {
    const triggers = Array.from(document.querySelectorAll(this.selectors.trigger));
    const popup = document.querySelector(this.selectors.popup);
    const closePopup = document.querySelector(this.selectors.closePopup);

    triggers.forEach((el) => {
      el.addEventListener('click', () => {
        popup.classList.add(this.classes.active);
      });
    });

    closePopup.addEventListener('click', () => {
      popup.classList.remove(this.classes.active);
    });

  }
}
