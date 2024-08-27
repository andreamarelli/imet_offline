import ModuleImet from "../../../Module.js";

import { computed } from "vue";

export default class ManagementPlan extends ModuleImet {

    setupApp(props, input_data) {
        let setup_obj = super.setupApp(props, input_data);

        const plan_exists = computed(() => {
            let exists = setup_obj.records[0]['PlanExistence'];
            return (exists==="true" || exists===true);
        });

        return {
            ...setup_obj,
            plan_exists
        };

    }

}
