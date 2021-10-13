// Environment variables
window.is_production = process.env.NODE_ENV === 'production';

// Urls
window.urls = window.urls || {};

// Load Vue Store, Filters and Components
window.formStore = window.ModularForms.formStore; // Alias

window.onload = function() {

    // #### Bootstrap tooltip  ####
    window.$('[data-toggle="tooltip"]').tooltip();

};
