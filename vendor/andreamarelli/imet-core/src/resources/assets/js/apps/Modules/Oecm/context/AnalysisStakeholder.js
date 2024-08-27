import ModuleImet from "../../../Module.js";

import { ref, toRaw } from "vue";

export default class AnalysisStakeholder extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const current_stakeholder = ref(null);

        setup_obj.emitter.on('moduleSaved', (data) => {
            current_stakeholder.value = null;
            window.ModularForms.Helpers.Animation.scrollPageToAnchor('module_' + props.module_key);
            window.AnalysisStakeholderSummary.refresh_importance(data.key_elements_importance);
        });

        function isCurrentStakeholder(value) {
            return current_stakeholder.value === value;
        }

        function switchStakeholder(value) {
            if (!isCurrentStakeholder(value)) {
                current_stakeholder.value = value;
            } else {
                current_stakeholder.value = null;
            }
            setup_obj.resetModule();
        }

        function showAddButton(group_key, stakeholder){
            let count = 0;
            setup_obj.records[group_key].forEach(function (item, index) {
                if (item['Stakeholder'] === stakeholder){
                    count++;
                }
            });
        }

        function numItemPerGroupAndStakeholder(group_key, stakeholder) {
            let count = 0;
            setup_obj.records.forEach(function (item, index) {
                if (item[props.group_key_field]===group_key && item['Stakeholder'] === stakeholder){
                    count++;
                }
            });
            return count;
        }

        function addItem(group_key, stakeholder) {
            let new_empty_record = JSON.parse(JSON.stringify(toRaw(props.empty_record)));
            new_empty_record[props.group_key_field] = group_key;
            new_empty_record['Stakeholder'] = stakeholder;
            setup_obj.records.push(new_empty_record);
        }

        function deleteItem(index, group_key, stakeholder) {

            let num_records = setup_obj.numRecordsInGroup(setup_obj.records[index][props.group_key_field]);
            if(num_records > 1){
                setup_obj.records.splice(index, 1);
            } else {
                let new_empty_record = JSON.parse(JSON.stringify(toRaw(props.empty_record)));
                new_empty_record[props.group_key_field] = group_key;
                new_empty_record['Stakeholder'] = stakeholder;
                setup_obj.records[index] = new_empty_record
            }
        }

        return {
            ...setup_obj,
            isCurrentStakeholder,
            switchStakeholder,
            numItemPerGroupAndStakeholder,
            addItem,
            deleteItem
        };

    }

}
