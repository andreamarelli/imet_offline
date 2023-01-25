export default {

    /**
     * Encode JSON object to Base64
     * @param obj
     * @returns {string}
     */
    encode(obj){
        return window.Base64.encode(JSON.stringify(obj));
    },

    /**
     * Decode JSON object from Base64
     *
     * @param encoded_obj
     * @returns {any}
     */
    decode(encoded_obj){
        return JSON.parse(window.Base64.decode(encoded_obj));
    }

};