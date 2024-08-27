export default {

    create(name, value){
        document.cookie = `${name}=${value};max-age=86400`;
    },

    update(name, value){
        document.cookie = `${name}=${value}`;
    },

    delete(name){
        document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 GMT`;
    },

    getByName(name){
        return document.cookie.split(";").find(element => element.includes(name))
    }

};
