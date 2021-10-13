import storage from './db.store';

export default class BasketStore {
    constructor(args) {
        this.scaling_up_id = args.scaling_up_id;
        this.init();
    }

    init() {

    }

    async save(values) {
        values.scaling_up_id = this.scaling_up_id;
        return await storage.save(values);
    }

    // delete_item(id){
    //     return storage.delete_item_child(id);
    // }

    delete(id){
        return storage.delete(id);
    }

    retrieve(id) {
        return storage.retrieve(id);
    }

    retrieve_all() {
        return storage.all(this.scaling_up_id);
    }

    clear() {
       return storage.clear(this.scaling_up_id);
    }

    get_scaling_up_id() {
        return this.scaling_up_id;
    }

    get_local_storage_images_key() {
        return `basket`;
    }

};

