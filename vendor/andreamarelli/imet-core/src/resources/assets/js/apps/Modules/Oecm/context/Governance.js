import ModuleImet from "../../../Module.js";

import { watch, computed } from "vue";

export default class CreateNonWDPA extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            SubGovernanceModel_SelectionList: {
                type: Object,
                default: () => {}
            }
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        watch(setup_obj.records, () => {
            recordChanged();
        }, { deep: true });

        const management_unique = computed(() => {
            return setup_obj.records[0]['ManagementUnique'];
        })

        const SubGovernanceModel_options = computed(() => {
            return setup_obj.records[0]['GovernanceModel'] !== null &&
            setup_obj.records[0]['GovernanceModel'] in props.SubGovernanceModel_SelectionList
                ? JSON.stringify(props.SubGovernanceModel_SelectionList[setup_obj.records[0]['GovernanceModel']])
                : JSON.stringify([]);
        })

        function recordChanged(){
            if(setup_obj.records[0]['GovernanceModel'] === null
                || !(setup_obj.records[0]['GovernanceModel'] in props.SubGovernanceModel_SelectionList)
                || !(setup_obj.records[0]['SubGovernanceModel'] in props.SubGovernanceModel_SelectionList[setup_obj.records[0]['GovernanceModel']])
            ){
                setup_obj.records[0]['SubGovernanceModel'] = null;
            }
        }

        function resetManagement(){
            setup_obj.records[0]['ManagementName'] = null;
            setup_obj.records[0]['ManagementType'] = null;
            if(management_unique.value === null){
                setup_obj.records[0]['DateOfCreation'] = null;
                setup_obj.records[0]['OfficialRecognition'] = null;
                setup_obj.records[0]['SupervisoryInstitution'] = null;
            }
        }

        return {
            ...setup_obj,
            resetManagement,
            management_unique,
            SubGovernanceModel_options
        };

    }

}