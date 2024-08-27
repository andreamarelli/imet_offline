import LocalStorage from "./local.storage.store";

class BasketStore {
    constructor() {
        this.db = null;
        this.init();
    }

    init() {
        this.db = window.indexedDB.open("basket");
    }

    save(url) {
        LocalStorage.save(this.get_local_storage_images_key(), url);
    }

    delete_item(id){
        return LocalStorage.delete_item_child(this.get_local_storage_images_key(), id);
    }

    retrieve() {
        return LocalStorage.retrieve(this.get_local_storage_images_key());
    }

    clear() {
        LocalStorage.delete(this.get_local_storage_images_key());
    }

    get_unique_id() {
        return this.unique_id;
    }

    get_local_storage_images_key() {
        return `basket`;
    }

    success() {
        this.db.success
    }
};

export default new BasketStore();