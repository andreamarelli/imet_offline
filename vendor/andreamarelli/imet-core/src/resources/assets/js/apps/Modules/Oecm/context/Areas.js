import ModuleImet from "../../../Module.js";

import { ref, nextTick } from "vue";

export default class Areas extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const AdministrativeArea_km2 = ref(input_data.records[0]['AdministrativeArea']/100);
        const WDPAArea_km2 = ref(input_data.records[0]['WDPAArea']/100);
        const GISArea_km2 = ref(input_data.records[0]['GISArea']/100);
        const StrictConservationArea_km2 = ref(input_data.records[0]['StrictConservationArea']/100);

        function convertToKm(fieldName) {
            if(fieldName==='AdministrativeArea'){
                AdministrativeArea_km2.value = parseFloat(setup_obj.records[0][fieldName])/100;
            } else if(fieldName==='WDPAArea'){
                WDPAArea_km2.value = parseFloat(setup_obj.records[0][fieldName])/100;
            } else if(fieldName==='GISArea'){
                GISArea_km2.value = parseFloat(setup_obj.records[0][fieldName])/100;
            } else if(fieldName==='StrictConservationArea'){
                StrictConservationArea_km2.value = parseFloat(setup_obj.records[0][fieldName])/100;
            }
        }
        function convertToHa(fieldName) {
            nextTick().then(() => {
                if(fieldName==='AdministrativeArea'){
                    setup_obj.records[0][fieldName] = AdministrativeArea_km2.value*100;
                } else if(fieldName==='WDPAArea'){
                    setup_obj.records[0][fieldName] = WDPAArea_km2.value*100;
                } else if(fieldName==='GISArea'){
                    setup_obj.records[0][fieldName] = GISArea_km2.value * 100;
                } else if(fieldName==='StrictConservationArea'){
                    setup_obj.records[0][fieldName] = StrictConservationArea_km2.value * 100;
                }
            });
        }


        return {
            ...setup_obj,
            AdministrativeArea_km2,
            WDPAArea_km2,
            GISArea_km2,
            StrictConservationArea_km2,
            convertToKm,
            convertToHa
        };

    }

}
