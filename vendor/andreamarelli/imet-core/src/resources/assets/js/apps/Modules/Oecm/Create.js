import ModuleImet from "../../Module.js";

import { watch } from "vue";
import { useLoadFromPrevious } from "../composables/module.load_from_previous";

export default class Create extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            previous_url: {
                type: String,
                default: null
            }
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const { show_language, retrieving_years, available_years, validateRecord, prev_year_selection } = useLoadFromPrevious({
            records: setup_obj.records,
            previous_url: props.previous_url,
        });

        watch(setup_obj.records, () => {
            setup_obj.status.value = 'idle'; // set the status to idle (override standard behaviour)
            setup_obj.status.value = validateRecord();
        }, { deep: true });

        return {
            ...setup_obj,
            show_language,
            retrieving_years,
            available_years,
            prev_year_selection
        };

    }

}