import ModuleImet from "../../../Module.js";

import { computed } from "vue";

export default class Equipments extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const averages = computed(() => {
            return setup_obj.calculateGroupsAverages('AdequacyLevel');
        });

        return {
            ...setup_obj,
            averages
        };

    }

}