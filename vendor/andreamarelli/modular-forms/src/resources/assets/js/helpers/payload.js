import { Base64 } from "~/js-base64";

export default {

    /**
     * Encode JSON object to Base64
     * @param obj
     * @returns {string}
     */
    encode(obj){
        return Base64.encode(JSON.stringify(obj));
    },

    /**
     * Decode JSON object from Base64
     *
     * @param encoded_obj
     * @returns {any}
     */
    decode(encoded_obj){
        return JSON.parse(Base64.decode(encoded_obj));
    }

};
