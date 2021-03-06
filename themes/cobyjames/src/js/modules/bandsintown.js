import _ from 'underscore';
var monthsLong = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ];
var monthsShort = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ];


export default class Bit {
  constructor(el,
    options = {
      appId: 'mySite',
      artist: 'Lauren Daigle',
      limit: 8,
      dateFormat: 'long numbers',
      numberFormat: 'long',
      filterString: false,
      showLineup: false,
      fallback: '.bit-fallback',
      showYear: false
    }) {
      
 
      this.el = el;
      this.shows = [];
      this.expandButton = this.el.querySelector('[data-expand-bit]')
      
      this.checkDefaultValues(options);
      
      this.getShowData().then(response => {
        this.shows = response;
        this.renderAllShows();
      });
      
      var _this = this;
      
      this.addClickListeners();
    }
    
    checkDefaultValues(options) {
      this.appId = options.appId;
      this.artist = options.artist;
      this.dateFormat = options.dateFormat;
      this.filterString = options.filterString;
      this.limit = options.limit;
      this.showLineup = options.showLineup;
      this.showYear = options.showYear;
      if (this.el.getAttribute('data-artist') != false) {
        this.artist = this.el.getAttribute('data-artist');
      }
      if (this.el.getAttribute('data-app-id') != false) {
        this.appId = this.el.getAttribute('data-app-id');
      }
      if (this.el.getAttribute('data-limit') != false) {
        this.limit = this.el.getAttribute('data-limit');
      }
      if (this.el.getAttribute('data-filter') != false) {
        this.filterString = this.el.getAttribute('data-filter');
      }
      if (this.el.getAttribute('data-show-lineup') != false && this.el.getAttribute('data-show-lineup') != 'false') {
        this.showLineup = this.el.getAttribute('data-show-lineup');
      }
      if (this.el.getAttribute('data-year') != false && this.el.getAttribute('data-year') != 'false') {
        this.showYear = this.el.getAttribute('data-year');
      }
      if (this.el.getAttribute('data-date-format') != false ) {
        this.dateFormat = this.el.getAttribute('data-date-format');
      }
      if (this.el.getAttribute('data-date-format') != false ) {
        this.dateFormat = this.el.getAttribute('data-date-format');
      }
    }
    async getShowData() {
      let cleanArtist = this.artist.replace(' ', '');
      let url = 'https://rest.bandsintown.com/artists/' + cleanArtist + '/events?app_id=' + this.appId;
      try {
        const response = await fetch(url, {method : 'GET'});
        if (!response.ok) {
          this.el.querySelector('.error').classList.remove('hidden');
          throw new Error('Failed to load dates. ' + response.message);
        }
        return response.json();
      } catch {
        console.log('There has been a problem with your fetch operation: ', error.message);
      }
    }
    
    renderDate(show) {
      
      //Store data
      let showDate = new Date(show.datetime);
      let month = showDate.getMonth();
      let year = showDate.getYear() - 100;
      let day = showDate.getDate().toString();
      
      ///Element
      let dateEl = document.createElement('span');
      dateEl.classList.add('bit-date');
      let string = ''
      
      //Contitional markup
      switch (this.dateFormat) {
        case 'long numbers':
          month = (month + 1).toString();
          if (month.length == 1) {
            string += '0'
          }
          string += month + '.';
          if (day.length == 1) {
            string += '0'
          }
          string += day;
          if (this.showYear) {
            string += '.' + year;
          }
          break;
        case 'long words':
          string += monthsLong[month] + ' ' + day;
          if (this.showYear) {
            string += ', ' + year;
          }
          break;
        case 'short words': 
          string += monthsShort[month] + ' ' + day;
          if (this.showYear) {
            string += ', ' +  year ;
          }
          break;
        default: 
          month = (month + 1).toString();
          string += month + '.' + day;
          if (this.showYear) {
            string += '.' + year;
          }
      }
      
      //Load markup into element
      dateEl.innerHTML =  string;
      return dateEl;
    }
    
    renderInfo(show) {
      //Create elements
      let infoEl = document.createElement('span');
      infoEl.classList.add('bit-info');
      
      //Get Data
      let region = show.venue.region;
      if (show.venue.country != 'United States') {
         region = show.venue.country 
      }
      let venue = show.venue.name;
      
      //Conditional formating
      var string = '<span class="bit-city">' + show.venue.city + ', ' + region + '</span><span class="bit-venue">' + venue + '</span>';
      if (this.showLineup) {
        string += '<span class="bit-lineup">' + show.lineup + '</span>';
      }
      
      infoEl.innerHTML = string;
      return infoEl
    }
    
    renderLinks(show) {
      let linksEl = document.createElement('span');
      linksEl.classList.add('bit-links');
      
      const offers = show.offers;
      offers.forEach(offer=> {
        let button = document.createElement('a');
        button.setAttribute('href', offer.url);
        button.classList.add('button');
        button.classList.add('arrow-after');
        button.classList.add('small');
        if (offer.status == 'sold out') {
          button.innerHTML = 'Sold Out';
          button.classList.add('sold-out');
          
        } else if (offer.status != 'available') {
          button.innerHTML = 'Info';
        } else {
          button.innerHTML = offer.type;
        }
        
        if (offer.type == 'VIP') {
          button.classList.add('link-vip');
        }
        
        linksEl.append(button);
      })
      
      if (offers.length == 0 ) {
        let infoButton= document.createElement('a');
        infoButton.setAttribute('href', show.url);
        infoButton.innerHTML = 'Info';
        infoButton.classList.add('button');
        infoButton.classList.add('arrow-after');
        infoButton.classList.add('small');
        linksEl.append(infoButton);
      }
      
      return linksEl;
    }
    
    renderShow(show) {
      
      let showEl = document.createElement('div');
      showEl.classList.add('bit-show');
      
      let date = this.renderDate(show); 
      let info = this.renderInfo(show); 
      let links = this.renderLinks(show);
      
      showEl.append(date, info, links);
      
      return showEl;
    }
    
    renderAllShows() { 
      //CreateWrapper
      let wrapper = document.createElement('div');
      let extras = document.createElement('div');
      wrapper.classList.add('bit-wrapper');
      extras.classList.add('bit-wrapper');
      extras.classList.add('bit-extra');
      
      
      //Loop through shows
      let counter = 0;
      this.shows.forEach(show=> {
        let showItem = this.renderShow(show);
        
        //Counter
        counter++;
        if (counter <= this.limit) {
          wrapper.append(showItem);
          
        } else {
          extras.append(showItem)
        };
      })
      
    
      if (this.shows.length < this.limit) {
        const fallbackEl = this.el.querySelector(this.fallback);
        if (fallbackEl) {
          fallbackEl.classList.remove('hidden');
        }
      } else {
        this.expandButton.classList.remove('hidden');
      }
      
      
      this.el.prepend(wrapper, extras);
      this.el.querySelector('.loader').classList.add('hidden');
      
    }
    
    toggleExpand() {
      let extraWrapper = this.el.querySelector('.bit-extra');
      if (this.expandButton.getAttribute('data-expand-bit') == 'expanded') {
        //collapse
        this.expandButton.innerHTML = 'More Shows';
        this.expandButton.setAttribute('data-expand-bit' , '');
        extraWrapper.style.maxHeight = 0 + 'px';
      } else  {
        this.expandButton.setAttribute('data-expand-bit' , 'expanded');
        let extraShows = extraWrapper.querySelectorAll('.bit-show')
        let heightTarget = extraShows[0].getBoundingClientRect().height*(extraShows.length*1.75);
        console.log(heightTarget);
        extraWrapper.style.maxHeight = heightTarget + 'px';
        this.expandButton.innerHTML = 'Less Shows';
      }
    }
    clickListener (event) {
      if (event.target == this.expandButton) {
        this.toggleExpand();
      }
    };
    addClickListeners() {
      
      this.el.addEventListener('click', evt => this.clickListener(evt));
    }
}