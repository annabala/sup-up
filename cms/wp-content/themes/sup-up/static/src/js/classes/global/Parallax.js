import Rellax from 'rellax';

export default class Parallax {
  constructor() {
    new Rellax('.rellax', {
      // eslint-disable-next-line no-magic-numbers
      breakpoints: [576, 768, 1201],
    });
  }
}
