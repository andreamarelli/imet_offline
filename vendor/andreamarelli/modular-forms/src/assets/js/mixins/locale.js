export default {

    getLocale: function(){
        return window.Laravel.locale;
    },

    getLabel: function(key, arg=null){

        let translator = new window.I18n;

        let label = '';
        if(arg===null){
            label = translator.trans(key)
        } else if(typeof arg === "object"){
            label = translator.trans(key, arg)
        } else if(typeof arg === "number"){
            label = translator.trans_choice(key, arg)
        }
        return _.upperFirst(label);
    },

};
