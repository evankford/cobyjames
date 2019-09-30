import _ from 'underscore';

export default class Bit {
  constructor(
    target = '#bitTarget',//Defaults
    options = { //Defaults
      appId = 'BitMe',
      artist = 'Lauren Daigle',
      limit = 8,
      dateFormat = 'numbers',
      numberFormat = 'long',
      filterString = false,
      showLineup = false
    }) {
      
      this.appId = options.appId;
      this.artist = options.artist;
      this.dateFormat = options.dateFormat;
      this.filterString = options.filterString;
      this.limit = options.limit;
      this.numberString = options.numberString;
      this.showLineup = options.showLineup;
      
      this.shows = [];
      
      this.getShowData();
    }
    
    
    async getShowData() {
      let cleanArtist = this.artist.replace(' ', '');
      let url = 'https://rest.bandsintown.com/artists/' + cleanArtist + '/events?app_id=' + this.appId;
      let data = await fetch(url).then(response => response.json);
      console.log(data);
      
      
    }
}