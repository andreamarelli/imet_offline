import ModuleImet from "../../../Module.js";

import { computed } from "vue";

export default class KeyElements extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);
        const Locale = window.ModularForms.Helpers.Locale;

        function get_index(element_id) {
            return element_id
                .replace(props.module_key, '')
                .replace('Aspect', '')
                .replaceAll('_', '');
        }

        function group_label(element_id) {
            let index = get_index(element_id);
            if (setup_obj.records[index]['__group_stakeholders'] !== null) {
                return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.from_group')
                    + ': <b>' + setup_obj.records[index]['__group_stakeholders'] + '</b>';
            }
            return '';
        }

        function percentage_stakeholder_label(element_id) {
            let index = get_index(element_id);
            let group_key = setup_obj.records[index][props.group_key_field];
            if (group_key==='group0'){
                let num_dir = setup_obj.records[index]['__num_stakeholders_direct'];
                let num_ind = setup_obj.records[index]['__num_stakeholders_indirect'];
                if(num_dir !== null || num_ind){
                    num_dir = num_dir !== null ? parseInt(num_dir) : 0;
                    num_ind = num_ind !== null ? parseInt(num_ind) : 0;
                    return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.num_stakeholders', {
                        'num_dir': '<b>' + num_dir + '</b>',
                        'num_ind': '<b>' + num_ind + '</b>',
                    })
                }
            } else if(group_key==='group1'){
                let score = setup_obj.records[index]['__score'];
                if(score!==null && score!==''){
                    return '<b>' + Locale.getLabel('imet-core::oecm_evaluation.KeyElements.ranking') + '</b>: ' + String(score);
                }

            }
            return '';
        }

        return {
            ...setup_obj,
            group_label,
            percentage_stakeholder_label,
        };

    }

}
