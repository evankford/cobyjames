import * as BasicLightbox from 'basiclightbox';
import '../../../node_modules/basiclightbox/dist/basicLightbox.min.css';

export default class TestModule {
  constructor(el) {
    this.el = el;

    if (el.getAttribute('data-lightbox-type') == 'video') {
      var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
      let url = el.getAttribute('href');
      let matches = url.match(p);
      console.log(url);
      let id = matches[1];
      
      const instance = BasicLightbox.create(`
      <div class="iframe-wrap">
        <iframe src="https://www.youtube.com/embed/${id}?rel=0&autoplay=1" width="560" height="315" frameborder="0" allowfullscreen="true" autoplay="true"></iframe>
      </div>`)
      el.addEventListener('click', function(event) {
        event.preventDefault();
        instance.show();
      })
    }
  }
}