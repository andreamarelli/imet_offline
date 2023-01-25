
class DBStorage {
    constructor() {

    }

    async ajax_request(url, params, method = 'POST'){
        return await window.axios({
            method,
            url: url,
            data: {
                _token: window.Laravel.csrfToken,
                ...params
            }
        })
            .then(function (response) {
                return response.data;
            })
            .catch(function (error) {
                console.log(error)
                return null;
            })
    }

    async save( value) {
        return await this.ajax_request(window.imet_routes.scaling_up_basket_add, {value})
    }

    async retrieve(id){
        return await this.ajax_request(window.imet_routes.scaling_up_basket_get, {id});
    }

    async all(id) {
        return await this.ajax_request(window.imet_routes.scaling_up_basket_all, {id})
    }

    delete_item_child(key, id){
        const children = JSON.parse(window.localStorage.getItem(key));
        const not_deleted_items = children.filter((child, key) => key !== id);
        window.localStorage.setItem(key, JSON.stringify(not_deleted_items));
        return this.retrieve(key);
    }

    async delete(id){
        return await this.ajax_request(window.imet_routes.scaling_up_basket_delete.replace('__id__', id), null,'DELETE');
    }

    async clear(id){
        return await this.ajax_request(window.imet_routes.scaling_up_basket_clear, {id});
    }

}

export default  new DBStorage();
