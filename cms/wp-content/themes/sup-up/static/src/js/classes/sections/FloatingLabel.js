export default class FloatingLabel {
  constructor() {
    if (!this.setVars()) return;

    this.bindEvents();
  }

  setVars() {
    this.classes = {
      inputWithLabel: '.form__field--withLabel > .wpcf7-form-control-wrap',
      moved: 'form__inputLabel--moved',
      permanentMoved: 'form__inputLabel--permanent',
    };
    this.form = document.querySelector('#wpcf7-f5-o1');
    this.inputWrappers = document.querySelectorAll(this.classes.inputWithLabel);
    this.inputs = document.querySelectorAll('.wpcf7-form-control.form__input--floatingLabel');
    this.labels = document.querySelectorAll('.form__inputLabel');

    if (!this.form) return false;

    return true;
  }

  bindEvents() {
    this.labelMoveUp = this.labelMoveUp.bind(this);
    this.labelMoveDown = this.labelMoveDown.bind(this);
    this.getSibling = this.getSibling.bind(this);

    this.inputs.forEach((input) => {
      input.addEventListener('focus', this.labelMoveUp);
    });

    this.inputs.forEach((input) => {
      input.addEventListener('blur', this.labelMoveDown);
    });

    this.form.addEventListener('wpcf7mailsent', () => {
      this.labels.forEach(label => {
        if (!label.hasClass(this.classes.permanentMoved)) {
          label.removeClass(this.classes.moved);
        }
      });
    }, false);
  }

  labelMoveDown(e) {
    const field = this.getSibling(e);
    if (!field.value && field.label) {

      field.label.removeClass(this.classes.moved);
    }
  }


  labelMoveUp(e) {
    const field = this.getSibling(e);
    if (field.label) {
      field.label.addClass(this.classes.moved);
    }
  }

  // eslint-disable-next-line class-methods-use-this
  getSibling(e) {
    const target = e.currentTarget ? e.currentTarget : e;
    const targetParent = target.parentNode;
    const label = targetParent.nextElementSibling;
    const inputVal = target.value ? target.value.trim() : null;

    const fieldObj = {
      label,
      value: inputVal,
    };

    return fieldObj;
  }
}
