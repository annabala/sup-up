import LiteEvents from './global/LiteEvents';
import HomeSlider from './sections/HomeSlider';
// import BoxesContent from './sections/BoxesContent';
import MobileMenu from './layout/MobileMenu';
import FixedHeaderOnScroll from './layout/FixedHeaderOnScroll';
import Parallax from './global/Parallax';
import Animations from './global/Animations';


class Core {
  constructor() {

    // Global
    new Parallax();
    new Animations();
    new LiteEvents();

    // Layout
    new MobileMenu();
    new FixedHeaderOnScroll();

    // Sections
    new HomeSlider();
    // new BoxesContent();
  }
}

new Core();
