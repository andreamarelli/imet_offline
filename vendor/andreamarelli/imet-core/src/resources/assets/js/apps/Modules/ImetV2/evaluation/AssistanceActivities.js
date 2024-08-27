import ModuleImet from "../../../Module.js";

export default class AssistanceActivities extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            marine_predefined: {
                type: Array,
                default: () => input_data.marine_predefined
            },
            terrestrial_predefined: {
                type: Array,
                default: () => input_data.terrestrial_predefined
            },
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        function is_marine(value){
            return props.marine_predefined.includes(value);
        }
        function is_terrestrial(value){
            return props.terrestrial_predefined.includes(value);
        }

        return {
            ...setup_obj,
            is_marine,
            is_terrestrial
        };

    }

}