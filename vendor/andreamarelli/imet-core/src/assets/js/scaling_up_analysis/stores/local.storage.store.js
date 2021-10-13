
class LocaleStorage {
    constructor() {

    }

    save(key, value) {
        const values = window.localStorage.getItem(key);
        if (values) {
            const json_recorded = JSON.parse(values);
            json_recorded.push(value)
            window.localStorage.setItem(key, JSON.stringify(json_recorded));
        } else {
            window.localStorage.setItem(key, JSON.stringify([value]));
        }
    }

    retrieve(key){
        return JSON.parse(window.localStorage.getItem(key));
    }

    delete_item_child(key, id){
        const children = JSON.parse(window.localStorage.getItem(key));
        const not_deleted_items = children.filter((child, key) => key !== id);
        window.localStorage.setItem(key, JSON.stringify(not_deleted_items));
        return this.retrieve(key);
    }

    delete(key){
        window.localStorage.removeItem(key);
    }

    clear(){
        window.localStorage.clear();
    }

}

export default  new LocaleStorage();