import ModuleImet from "../../../Module.js";

import { ref, computed } from "vue";

export default class FinancialAvailableResources extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const totals = computed(() => {
            let result = [];
            setup_obj.records.forEach(function (item, index) {
                result[index] = 0;
                result[index] += item['NationalBudget'] !== null ? parseFloat(item['NationalBudget']) : 0;
                result[index] += item['OwnRevenues'] !== null ? parseFloat(item['OwnRevenues']) : 0;
                result[index] += item['Disputes'] !== null ? parseFloat(item['Disputes']) : 0;
                result[index] += item['Partners'] !== null ? parseFloat(item['Partners']) : 0;
                result[index] = result[index]===0 ? null : result[index];
            });
            return result;
        });

        const percentages = computed(() => {
            let result = [];
            let totalPlannedBudget = parseFloat(getTotalBudget());
            setup_obj.records.forEach(function (item, index) {
                let total =  parseFloat(totals[index]);
                if(total>0 && totalPlannedBudget>0){
                    result[index] = (total/totalPlannedBudget*100).toFixed(1) + ' %';
                }
            });
            return result;
        });

        function getTotalBudget(){
            return window.imet__v1__context__financial_resources.records[0]['TotalBudget'];
        }

    return {
        ...setup_obj,
        totals,
        percentages
    };

    }

}