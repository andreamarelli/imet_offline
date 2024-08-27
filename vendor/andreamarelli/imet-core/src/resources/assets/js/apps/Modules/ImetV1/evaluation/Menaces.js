import ModuleImet from "../../../Module.js";

import {computed} from "vue";

export default class ControlLevel extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            stats: {
                type: Array,
                default: []
            }
        };

        return super(input_data, custom_props);
    }

}
