
// import './js/navigation';
import './js/skip-link-focus-fix';

import './sass/style.scss';

import lazysizes from 'lazysizes';
import '../node_modules/lazysizes/plugins/parent-fit/ls.parent-fit';



window.addEventListener('load', function() {
  let bgVideosLazy = document.querySelectorAll('.bgvideo-wrap');
  bgVideosLazy.forEach(el => {
    let toLoad = el.querySelectorAll('[data-src]');
    toLoad.forEach(el => {
      el.setAttribute('src', el.getAttribute('data-src'))
    });
    el.classList.remove('loading');
    el.classList.add('loaded');
    el.vid = el.querySelector('video');
    el.vid.load();
  })
})


let nav = document.querySelector('.main-navigation');
let links = nav.querySelectorAll('a');
links.forEach(element => {
  element.addEventListener('click', function (event) {
    let hashFinder = /\#(.*)/;
    let targEl = document.getElementById(hashFinder.exec(event.target.href)[1]);
    if (targEl) {
      event.preventDefault();
      targEl.scrollIntoView({ behavior: "smooth" });
      menuButton.setAttribute('aria-expanded', 'false');
    }

  })
});
Array.from(document.querySelectorAll('[data-module]')).forEach(el => {
  const name = el.getAttribute('data-module');
  const Module = require(`./js/modules/${name}`).default
  new Module(el)
})