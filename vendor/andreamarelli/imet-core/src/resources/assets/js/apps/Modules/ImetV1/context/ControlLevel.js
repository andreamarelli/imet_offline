import ModuleImet from "../../../Module.js";

import {computed} from "vue";

export default class ControlLevel extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            area: {
                type: Number,
                default: input_data.area
            }
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const area_percentage = computed(() => {
            let result = null;
            let value = setup_obj.records[0]['UnderControlArea'];
            let value2 = props.area;
            if(isValid(props.area) && isValid(value) && value>0){
                result = parseFloat(value) / parseFloat(value2) * 100;
                result = result.toFixed(2);
            }
            return result;
        });
        
        const average_time = computed(() => {
            let result = null;
            let value = setup_obj.records[0]['UnderControlPatrolManDay'];
            let value2 = props.area;
            if(isValid(props.area) && isValid(value) && value>0){
                result = parseFloat(value) / parseFloat(value2);
                result = result.toFixed(2);
            }
            return result;
        });
        
        const area_percentage_conversion = computed(() => {
            let result = null;
            let value = setup_obj.records[0]['UnderControlPatrolKm'];
            let value2 = props.area;
            if(isValid(props.area) && isValid(value) && value>0){
                result = parseFloat(value) / parseFloat(value2) * 10;
                result = result.toFixed(2);
            }
            return result;
        });
        
        const average_time_controlled = computed(() => {
            let result = null;
            let value = setup_obj.records[0]['UnderControlPatrolKm'];
            let value2 = setup_obj.records[0]['UnderControlArea'];
            if(isValid(props.area) && isValid(value) && value>0){
                result = parseFloat(value) / parseFloat(value2);
                result = result.toFixed(2);
            }
            return result;
            //UnderControlPatrolManDay/UnderControlArea
        });
        
        const ecologicalMonitoringPatrolKm_percentage = computed(() => {
            let result = null;
            let value = setup_obj.records[0]['EcologicalMonitoringPatrolKm'];
            let value2 = props.area;
            if(isValid(props.area) && isValid(value) && value>0){
                result = parseFloat(value) / parseFloat(value2) * 10;
                result = result.toFixed(2);
            }
            return result;
        });
        
        function isValid(n) {
            return !isNaN(parseFloat(n)) && isFinite(n) && n!==null;
        }

        return {
            ...setup_obj,
            area_percentage,
            average_time,
            area_percentage_conversion,
            average_time_controlled,
            ecologicalMonitoringPatrolKm_percentage
        };

    }

}
