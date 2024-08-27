import ModuleImet from "../../../Module.js";

import { watch } from "vue";

export default class KeyElementsImpact extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        watch(setup_obj.records, () => {
            recordChanged();
        }, { deep: true });

        function recordChanged(){
            Object.entries(setup_obj.records).forEach(([index, record]) => {
                setup_obj.records[index]['EffectSH'] = calculate_effect(record['StatusSH'],  record['TrendSH']);
                setup_obj.records[index]['EffectER'] = calculate_effect(record['StatusER'],  record['TrendER']);
            });
        }

        function
        calculate_effect(status, trend){
            let effect = null;
            if(status!==null || trend!==null){
                // average
                effect = (
                    (status!==null ? parseFloat(status): 0) +
                    (trend!==null ? parseFloat(trend): 0)
                ) / (status!==null && trend!==null ? 2 : 1);
                // rescale scale -100 to 100
                effect = effect * 100 / 2;
            }
            return effect;
        }

        return {
            ...setup_obj
        };

    }

}