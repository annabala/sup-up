export default class PopupOffer
{
  constructor()
  {
    if (!this.setVars()) return;

    this.setEvents();
  }

  setVars()
  {
    this.section = document.querySelector('[data-popup-offer]');

    if (!this.section) return;

    this.selectors = {
      trigger: '[data-popup-offer-trigger]',
      popup: '[data-popup-offer]',
      closePopup: '[data-popup-offer-close]',
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

    console.log(closePopup);

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
