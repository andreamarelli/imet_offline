import I18n from "@vendor/conedevelopment/i18n/resources/js/I18n.js";

export default{

    getLocale(){
        return window.Laravel.locale;
    },

    getLabel(key, arg=null){

        let translator = new I18n;

        let label = '';
        if(arg===null){
            label = translator.trans(key)
        } else if(typeof arg === "object"){
            label = translator.trans(key, arg)
        } else if(typeof arg === "number"){
            label = translator.trans_choice(key, arg)
        }
        return label.charAt(0).toUpperCase() + label.slice(1);
    }

}
