import ModuleImet from "../../../Module.js";

import { ref, computed } from "vue";

export default class GeographicalLocation extends ModuleImet {

    setupApp(props, input_data) {
        let setup_obj = super.setupApp(props, input_data);

        const limit_exists = computed(() => {
            return setup_obj.records[0]['LimitsExist']==="true"
                || setup_obj.records[0]['LimitsExist']===true
                || setup_obj.records[0]['LimitsExist']===1
                || setup_obj.records[0]['LimitsExist']==='1';
        });

        return {
            ...setup_obj,
            limit_exists
        };

    }

}
