export default {

    create: function(name, value){
        document.cookie = `${name}=${value};max-age=86400`;
    },

    update: function(name, value){
        document.cookie = `${name}=${value}`;
    },

    delete: function(name){
        document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 GMT`;
    },

    getByName: function(name){
        return document.cookie.split(";").find(element => element.includes(name))
    }

};
