/* ---
  Docs: https://www.npmjs.com/package/mati-mix/
--- */
const mix = require('mati-mix');

mix.js([
  'static/src/js/vendors/polyfills/**/*.js',
  'static/src/js/vendors/helpers/**/*.js',
  'static/src/js/classes/core.js',
], 'static/dist/js/scripts.js');

mix.sass(
  'static/src/sass/core.scss'
  , 'static/dist/css/styles.css');

/* ---
  Config
--- */
mix
  // .sassMobileFirst()
  // .aliases({
  //   'class': __dirname + '/_dev/js/classes',
  // })
  .browserSync('sup.test', [
    'static/dist/css/styles.css',
  ])
  // .version()
  ;

