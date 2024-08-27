import ModuleImet from "../../../Module.js";

import { computed } from "vue";

export default class DesignatedValuesConservationTendency extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const averages = computed(() => {
            return setup_obj.calculateGroupsAverages('EvaluationScore');
        });

        return {
            ...setup_obj,
            averages
        };

    }

}
