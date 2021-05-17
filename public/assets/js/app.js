// Environment variables
window.is_production = process.env.NODE_ENV === 'production';

// Urls
window.urls = window.urls || {};
window.urls.dopa_services = 'https://dopa-services.jrc.ec.europa.eu/services/';

// Common Utilities
window.Locale = require('./utils/locale.js');
require('./utils/input.js');
window.Common = require('./utils/common.js');

// Load Vue Store, Filters and Components
require('./vue/store/formStore.js');
require('./vue/vue-components.js');

// Load other js files
require('./vue/moduleController/controller.js');


$(function() {

    // ###########################  Header - Menu  ###########################
    $('header#header nav#menu').hover(function () {
        $('header#header').addClass('openedNav');
    },function () {
        $('header#header').removeClass('openedNav');
    });
    // ###########################  Sidebar nav  ###########################
    $('.sidebar > ul > li:not(.selected)').hover(function () {
        $(this).find('> ul').stop(true).slideDown();
    },function () {
        $(this).find('> ul').stop(true).slideUp();
    });
    // ###########################  Bootstrap tooltip  ###########################
    $('[data-toggle="tooltip"]').tooltip();

});
