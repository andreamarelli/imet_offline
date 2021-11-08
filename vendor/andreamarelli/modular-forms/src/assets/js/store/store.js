
window.ModularForms.formStore = new window.Vuex.Store({

    modules: {
        validator: require('./modules/validator').default
    },

    strict: process.env.NODE_ENV !== 'production',
    debug: process.env.NODE_ENV !== 'production'

});
