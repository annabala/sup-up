import HomeSlider from './sections/HomeSlider';
import MobileMenu from './layout/MobileMenu';
import Popup from './sections/Popup';
import PopupOffer from './sections/PopupOffer';
import ImagePins from './sections/ImagePins';
import Parallax from './global/Parallax';
import Animations from './global/Animations';


class Core
{
  constructor()
  {

    // Global
    new Parallax();
    new Animations();

    // Layout
    new MobileMenu();

    // Home Slider
    new HomeSlider();

    // Sections
    new ImagePins();
    new Popup();
    new PopupOffer();
  }
}

new Core();
