module.exports = {

    getLocale: function(){
        return Lang.getLocale();
    },

    getLabel: function(key, arg=null){
        let label = '';
        if(arg===null){
            label = Lang.get(key)
        } else if(typeof arg === "object"){
            label = Lang.get(key, arg)
        } else if(typeof arg === "number"){
            label = Lang.choice(key, arg)
        }
        return _.upperFirst(label);
    },

};