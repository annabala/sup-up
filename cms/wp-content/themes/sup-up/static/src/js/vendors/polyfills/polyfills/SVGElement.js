/* ie11svg.js https://gist.github.com/EvanAgee/350b5072e1ec3d82d34cc6a735914eff */

if (!('classList' in SVGElement.prototype)) {
  Object.defineProperty(SVGElement.prototype, 'classList', {
    get() {
      return {
        contains: className => this.className.baseVal.split(' ').indexOf(className) !== -1,
        add: className => this.setAttribute('class', this.getAttribute('class') + ' ' + className),
        remove: (className) => {
          const removedClass = this.getAttribute('class').replace(new RegExp('(\\s|^)' + className + '(\\s|$)', 'g'), '$2');
          if (this.classList.contains(className)) {
            this.setAttribute('class', removedClass);
          }
        },
      };
    },
  });
}
