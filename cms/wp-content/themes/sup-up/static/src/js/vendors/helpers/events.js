/* Example of use is at the bottom of file */

Element.prototype.addEvent = function addEvent(name, fn) {

  if (name === undefined) return;

  this.events      = this.events || {};
  this.events.name = (e) => { fn(e.detail); };
  this.addEventListener(name, this.events.name);

};

Element.prototype.triggerEvent = function triggerEvent(name, data) {

  if (name === undefined) return;

  this.dispatchEvent(new CustomEvent(name, {
    detail : data,
  }));

};

Element.prototype.removeEvent = function removeEvent(name) {

  if (name === undefined) return;

  this.removeEventListener(name, this.events.name);
  delete this.events.name;

};

HTMLCollection.prototype.addEvent     = NodeList.prototype.addEvent;
HTMLCollection.prototype.triggerEvent = NodeList.prototype.triggerEvent;
HTMLCollection.prototype.removeEvent  = NodeList.prototype.removeEvent;

document.addEvent     = Element.prototype.addEvent.bind(document);
window.addEvent       = Element.prototype.addEvent.bind(window);
document.triggerEvent = Element.prototype.triggerEvent.bind(document);
window.triggerEvent   = Element.prototype.triggerEvent.bind(window);
document.removeEvent  = Element.prototype.removeEvent.bind(document);
window.removeEvent    = Element.prototype.removeEvent.bind(window);

/*

  Example:

    window.addEvent('myCustomEvent', (e) => {
      console.log(e.test)
      window.removeEvent('myCustomEvent')
    })

    window.triggerEvent('myCustomEvent', { test: 'Example' })

*/
