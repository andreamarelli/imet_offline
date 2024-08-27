import ModuleImet from "../../Module.js";

import { watch } from "vue";

export default class CreateNonWDPA extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        watch(setup_obj.records, () => {
            setup_obj.status.value = 'idle'; // set the status to idle (override standard behaviour)
            recordChanged();
        }, { deep: true });

        function recordChanged(){

            let empty = [];
            for (const [key, value] of Object.entries(setup_obj.records[0])) {
                if(value === null || value === ''){
                    empty.push(key);
                }
            }

            if(empty.includes('version') &&
                empty.includes('FormID') &&
                empty.includes('UpdateDate') &&
                empty.includes('UpdateBy')){
                if(empty.length === 4 ||
                    (empty.length === 5 &&  empty.includes('rep_m_area')) ||
                    (empty.length === 5 &&  empty.includes('rep_area'))
                ){
                   setup_obj.status.value = 'changed';
                } else {
                   setup_obj.status.value = 'init';
                }
            }
            else {
               setup_obj.status.value = 'init';
            }

        }

        return {
            ...setup_obj
        };

    }

}