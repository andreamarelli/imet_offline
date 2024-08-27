import ModuleImet from "../../../Module.js";

import { ref, nextTick } from "vue";

export default class Areas extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const AdministrativeArea_km2 = ref(input_data.records[0]['AdministrativeArea']/100);
        const WDPAArea_km2 = ref(input_data.records[0]['WDPAArea']/100);
        const GISArea_km2 = ref(input_data.records[0]['GISArea']/100);

        function convertToKm(fieldName) {
            if(fieldName==='AdministrativeArea'){
                AdministrativeArea_km2.value = parseFloat(setup_obj.records[0][fieldName])/100;
            } else if(fieldName==='WDPAArea'){
                WDPAArea_km2.value = parseFloat(setup_obj.records[0][fieldName])/100;
            } else if(fieldName==='GISArea'){
                GISArea_km2.value = parseFloat(setup_obj.records[0][fieldName])/100;
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
                }
            });
        }

        function calculateShapeIndex() {
            let area = getArea();
            let boundary_length = parseFloat(setup_obj.records[0]['BoundaryLength']);

            if(isValidNumber(area) && isValidNumber(boundary_length)){
                let calc =  Math.sqrt(3.14)/(2*3.14)*boundary_length/Math.sqrt(area);
                // if(calc>=1){
                setup_obj.records[0]['Index'] = calc.toFixed(2).toString();
                // } else {
                //     setup_obj.records[0]['Index'] = null;
                //     // todo: warn error (Please check area and boundary_length: seems not to be consistent)
                //     // todo: legend x shape index value
                // }
            } else {
                setup_obj.records[0]['Index'] = null;
            }
        }

        function getArea(){
            let area = null;
            area = isValidNumber(AdministrativeArea_km2.value) ? AdministrativeArea_km2.value : area;
            area = isValidNumber(WDPAArea_km2.value) ? WDPAArea_km2.value : area;
            area = isValidNumber(GISArea_km2.value) ? GISArea_km2.value : area;
            return area;
        }

        function isValidNumber(num){
            if(num!==null){
                num = parseFloat(num);
                return num>0;
            }
            return false;
        }


        return {
            ...setup_obj,
            calculateShapeIndex,
            AdministrativeArea_km2,
            WDPAArea_km2,
            GISArea_km2,
            convertToKm,
            convertToHa,
            getArea
        };

    }

}
