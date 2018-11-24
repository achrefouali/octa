/// some script
// var $ = require('jquery');

// window.jQuery = $;
// window.$ = $;



// import $ from 'jquery'
// import boostrap from 'bootstrap'
//
// import plugin from 'jquery-plugin'

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it


const imagesContext = require.context('../images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

jQuery.fn.load = function(callback){ $(window).on("load", callback) };
global.jQuery = require('jquery');
require('popper.js');
require('bootstrap-sass');
require('bootstrap-datepicker');
require('bootstrap-select');
require('owl.carousel');
require('@fancyapps/fancybox');


var googleMapsClient = require('@google/maps').createClient({
    key: 'AIzaSyBfm9QGxGpRXAJMZpPrZaxlOeNw3xrNXak'
});

// Geocode an address.
googleMapsClient.geocode({
    address: '1600 Amphitheatre Parkway, Mountain View, CA'
}, function(err, response) {
    if (!err) {
        console.log(response.json.results);
    }
});



$(function(){
    $('.selectpicker').selectpicker();
});