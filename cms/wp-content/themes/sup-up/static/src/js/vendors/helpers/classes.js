/* Example of use is at the bottom of file */

Element.prototype.hasClass = function hasClass(className) {

  if (this.classList) {
    return this.classList.contains(className);
  }

  return !!this.className.match(new RegExp(`(\\s|^)${className}(\\s|$)`));

};

Element.prototype.addClass = function addClass(className) {

  if (this.hasClass(className)) return;

  if (this.classList) {
    this.classList.add(className);
  } else {
    this.className += ` ${className}`;
  }

};

NodeList.prototype.addClass = function addClass(className) {

  const { length } = this;
  for (let i = 0; i < length; i++) {
    this[i].addClass(className);
  }

};

Element.prototype.removeClass = function removeClass(className) {

  if (!this.hasClass(className)) return;

  if (this.classList) {
    this.classList.remove(className);
  } else {
    const reg      = new RegExp(`(\\s|^)${className}(\\s|$)`);
    this.className = this.className.replace(reg, ' ');
  }

};

NodeList.prototype.removeClass = function removeClass(className) {

  const { length } = this;
  for (let i = 0; i < length; i++) {
    this[i].removeClass(className);
  }

};

Element.prototype.toggleClass = function toggleClass(className) {

  if (!this.hasClass(className)) {
    this.addClass(className);
  } else {
    this.removeClass(className);
  }

};

NodeList.prototype.toggleClass = function toggleClass(className) {

  const { length } = this;
  for (let i = 0; i < length; i++) {
    this[i].toggleClass(className);
  }

};

HTMLCollection.prototype.addClass    = NodeList.prototype.addClass;
HTMLCollection.prototype.removeClass = NodeList.prototype.removeClass;
HTMLCollection.prototype.toggleClass = NodeList.prototype.toggleClass;

/*

  Example:

    document.body.addClass('myCustomClass')
    document.body.hasClass('myCustomClass')
    document.body.removeClass('myCustomClass')

*/
