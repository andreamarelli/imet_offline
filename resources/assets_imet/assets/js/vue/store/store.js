// import * as actions from './actions';
// import * as getters from './getters';
import validator from './modules/validator';
import staff_rights from './modules/staff_rights';

window.vueStore = new window.Vuex.Store({

    modules: {
        validator: validator,
        staff_rights: staff_rights
    },

    strict: !window.is_production,
    debug: !window.is_production,

});