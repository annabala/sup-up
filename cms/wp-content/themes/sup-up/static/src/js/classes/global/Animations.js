import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles

export default class Animations
{
  constructor()
  {
    if (!this.setVars()) return;

    this.setEvents();
  }

  setVars()
  {

    this.settings = {
      duration: 800,
    };

    return true;
  }

  setEvents()
  {
    window.onload = () => {
      this.initAos();
    };
  }

  initAos() {
    AOS.init(this.settings);
  }
}
