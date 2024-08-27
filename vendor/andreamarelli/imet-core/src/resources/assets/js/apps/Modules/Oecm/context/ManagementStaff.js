import ModuleImet from "../../../Module.js";

import { computed } from "vue";

export default class Areas extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const diffs = computed(() => {
            let diffs = [];
            setup_obj.records.forEach(function (item, index) {
                diffs[index] = null;
                if (item['Number'] !== null && item['AdequateNumber'] !== null) {
                    diffs[index] += parseInt(item['Number']) - parseInt(item['AdequateNumber']);
                }
            });
            return diffs;
        });


        return {
            ...setup_obj,
            diffs
        };

    }

}
