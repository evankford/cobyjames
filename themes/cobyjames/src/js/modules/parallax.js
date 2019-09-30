import Parallax from 'parallax-js';


export default class TestModule {
  constructor(el) {
    this.el = el;
    el.paraInstance = new Parallax(el)
  }
}