export default class ImagePins
{
  constructor()
  {
    if (!this.setVars()) return;

    this.setEvents();
    this.showContent();
  }

  setVars()
  {

    this.selectors = {
      container: '[data-image-container]',
      image: '[data-image]',
      pins: '[data-pin]',
      index: '[data-pin-index]',
      wrapper: '[data-image-wrapper]',
    };

    this.classes = {
      active: 'imagePins__pinWrapper--active',
    };

    this.container = document.querySelector(this.selectors.container);
    if (!this.container) return false;

    this.image = document.querySelector(this.selectors.image);
    this.pins = document.querySelectorAll(this.selectors.pins);
    this.index = document.querySelector(this.selectors.index);
    this.wrapper = document.querySelector(this.selectors.wrapper);
    this.allWrappers = document.querySelectorAll(this.selectors.wrapper);

    return true;
  }

  setEvents()
  {
    this.scrollAppear = this.scrollAppear.bind(this);
    window.addEventListener('scroll', this.scrollAppear);
  }

  scrollAppear() {
    const introPosition = this.container.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 2;

    if (introPosition < screenPosition) {
      this.image.classList.add('opacityAnimation--active');
    }
  }

  showContent() {
    this.image.addEventListener('click', (e) => {
      if (e.target && e.target.nodeName === 'DIV') {

        this.allWrappers.forEach((wrapper) => {
          wrapper.classList.remove(this.classes.active);
        });
        console.log(e.target.nextElementSibling);
        e.target.nextElementSibling.classList.add(this.classes.active);
      } else {
        this.allWrappers.forEach((wrapper) => {
          wrapper.classList.remove(this.classes.active);
        });
      }
    });
  }
}
