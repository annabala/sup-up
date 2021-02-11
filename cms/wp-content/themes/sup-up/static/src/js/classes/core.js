import LiteEvents from './global/LiteEvents';
import FsLightbox from './global/FsLightbox';
import Animations from './global/Animations';

// import BoxesContent from './sections/BoxesContent';
import MobileMenu from './layout/MobileMenu';
import MenuSubpage from './layout/MenuSubpage';
import FixedHeaderOnScroll from './layout/FixedHeaderOnScroll';
import Masonry from './layout/Masonry';

import HomeSlider from './sections/HomeSlider';
import ImagesSlider from './sections/ImagesSlider';
import FloatingLabel from './sections/FloatingLabel';
import ScrollTop from './sections/ScrollTop';


class Core {
  constructor() {

    // Global
    new FsLightbox();
    new Animations();
    new LiteEvents();

    // Layout
    new MobileMenu();
    new MenuSubpage();
    new FixedHeaderOnScroll();
    new Masonry();

    // Sections
    new HomeSlider();
    new ImagesSlider();
    new FloatingLabel();
    new ScrollTop();
    // new BoxesContent();
  }
}

new Core();
