import ModuleImet from "../../../Module.js";

import { ref, computed } from "vue";

export default class MenacesPressions extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            marine_predefined: {
                type: Array,
                default: () => input_data.marine_predefined
            },
            groupsByCategory: {
                type: Object,
                default: () => input_data.groupsByCategory
            }
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        /**
         * Calculate stats for each record
         */
        const recordStats = computed(() => {
            let stats = [];
            let fields = ['Impact', 'Extension', 'Duration', 'Trend', 'Probability'];
            setup_obj.records.forEach(function(record){
                let record_values = [];
                fields.forEach(function (field) {
                    record_values.push(record[field]);
                });
                stats.push(calculateStats(record_values, true));
            });
            return stats;
        });

        /**
         * Calculate stats for each group
         */
        const groupStats = computed(() => {
            let stats = {};
            Object.keys(props.groups).forEach(function(group){
                let group_stats = [];
                setup_obj.records.forEach(function(record, index){
                    if(record[props.group_key_field] === group) {
                        group_stats.push(recordStats.value[index]);
                    }
                });
                stats[group] = calculateStats(group_stats);
            });
            return stats;
        });

        /**
         * Calculate stats for each category
         */
        const categoryStats = computed(() => {
            let stats = [];
            props.groupsByCategory.forEach(function (groups_by_category) {
                let category_stats = [];
                Object.entries(groupStats.value).forEach(([group_key, group_stats]) => {
                    if(groups_by_category.includes(group_key)){
                        category_stats.push(group_stats);
                    }

                });
                if(category_stats.every(function(v) { return v === null; })){
                    stats.push(null);
                } else {
                    stats.push(
                        (calculateStats(category_stats) * 100 / 3.0).toFixed(2)
                    );
                }
            });
            return stats;
        });

        function is_marine(value){
            return props.marine_predefined.includes(value);
        }

        function calculateStats(values, rows=false){

            let numCategories = 4;
            let prod = 1;
            let count = 0;

            values.forEach(function(value, index){
                if(value!==null){
                    if(index===3 && rows===true){
                        prod *= (numCategories+1)/2 - parseFloat(value)*(numCategories-1)/4;
                    } else {
                        prod *= numCategories - parseFloat(value);
                    }

                    count++;
                }
            });

            return count>0 ? (4 - Math.pow(prod, 1/(count))).toFixed(2) : null;
        }

        return {
            ...setup_obj,
            recordStats,
            groupStats,
            categoryStats,
            is_marine
        };

    }

}