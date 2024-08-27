import ModuleImet from "../../../Module.js";

import { ref, computed } from "vue";

export default class ManagementStaff extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const diffs = computed(() => {
            let diffs = [];
            setup_obj.records.forEach(function (item, index) {
                diffs[index] = null;
                if (item['ExpectedPermanent'] !== null && item['ActualPermanent']!== null) {
                    diffs[index] = parseInt(item['ActualPermanent']) - parseInt(item['ExpectedPermanent']);
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