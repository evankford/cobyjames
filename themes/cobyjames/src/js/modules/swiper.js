import Swiper from 'swiper';
import './../../../node_modules/swiper/css/swiper.min.css';


export default class TestModule {
  constructor(el) {
    this.el = el;
    
    el.defaultWidth = 2;
    el.defaultAnimation = 'slide'
    el.defaultSlide = 1;
    el.defaultSpeed = 400;
    el.defaultSpace = 30;
    el.smallSpace = 20;
    el.defaultScrollbar = false;
    el.mobileSlideWidth = 1.25;
    el.pagination = false;
    el.loop = false;
    el.centered = true;
    el.giantSpace = 75;
    
    
    if (el.getAttribute('data-swiper-type') == 'music') {

      el.defaultAnimation = 'flip';
      el.defaultWidth = 1
      el.defaultSpeed = 800
      el.defaultSlide = 0;
      el.defaultSpace = el.smallSpace = 0;
      el.pagination = {
        el: '.swiper-pagination',
        dynamicBullets: true
      };
      el.mobileSlideWidth = 1;
    }
    
    
    if (el.getAttribute('data-swiper-type') == 'video') {
      el.defaultSlide = 0;
      el.loop = true;
      el.defaultWidth = 'auto'
      el.mobileSlideWidth = 1.5;
      el.centered = true;
      el.pagination = {
        el: '.swiper-pagination',
        dynamicBullets: true
      };
      
    }

    el.mySwiper = new Swiper(el, {
      slidesPerView: el.defaultWidth,
      spaceBetween: el.defaultSpace,
      centeredSlides: el.centered,
      breakpoints: {
        900: {
          slidesPerView: el.mobileSlideWidth,
          spaceBetween: el.smallSpace
        },
        1400: {
         spaceBetween: el.giantSpace 
        }
      },
      flipEffect: {
        slideShadows: false
      },
      speed: el.defaultSpeed,
      cssMode: false,
      autoHeight: true,
      loop: el.loop,
      centeredSlides: true,
      effect: el.defaultAnimation,
      threshold:7,
      draggable: true,
      slideToClickedSlide: true,
      initialSlide: el.defaultSlide,
      scrollbar: el.defaultScrollbar,
      centerInsufficientSlides: true,
      pagination: el.pagination,
      navigation: {
        nextEl: el.querySelector('.swiper-button-next'),
        prevEl: el.querySelector('.swiper-button-prev'),
      },
    });
    
    window.addEventListener('load', function() {
      el.mySwiper.update();
    })
  }
}