import ModuleImet from "../../../Module.js";

import { ref, watch } from "vue";

export default class Areas extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const relative_importance = ref(setup_obj.records[0]['RelativeImportance']);

        watch(setup_obj.records, () => {
            recordChanged();
        }, { deep: true });

        watch(relative_importance, () => {
            setup_obj.records[0]['RelativeImportance'] = relative_importance.value;
        });

        function recordChanged(){
            if(setup_obj.records[0]['RelativeImportance'] !== setup_obj.relative_importance){
                setup_obj.relative_importance = setup_obj.records[0]['RelativeImportance'];
            }
        }

        return {
            ...setup_obj,
            relative_importance
        };

    }

}
