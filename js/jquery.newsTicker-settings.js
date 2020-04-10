/*
 * Settings of the ticker
 */
jQuery(document).ready(function(){
   jQuery('.newsticker').newsTicker({
      row_height: parseFloat(jQuery('.newsticker').css("font-size")) + JSINFO.NewsTickerOffset,
      max_rows: 1,
      speed: 1000,
      direction: 'down',
      duration: 4000,
      autostart: 1,
      pauseOnHover: 1
   });
});