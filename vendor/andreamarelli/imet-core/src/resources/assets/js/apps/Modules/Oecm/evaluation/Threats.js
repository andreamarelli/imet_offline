import ModuleImet from "../../../Module.js";

import { computed } from "vue";

export default class Threats extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            threats: {
                type: Object,
                default: () => input_data.threats
            },
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const threat_stats = computed(() => {

            let stats = {};

            Object.entries(props.threats).forEach(([key, value]) => {
                let stat = null;

                setup_obj.records.forEach(function(record){
                    if(record['__threat_key'] === key){
                        let prod = 1
                            * (record['Impact']!==null ? 4-parseInt(record['Impact']) : 1)
                            * (record['Extension']!==null ? 4-parseInt(record['Extension']) : 1)
                            * (record['Duration']!==null ? 4-parseInt(record['Duration']) : 1)
                            * (record['Trend']!==null ?(5/2 - parseInt(record['Trend'])*3/4) : 1)
                            * (record['Probability']!==null ? 4-parseInt(record['Probability']) : 1);
                        let count =
                            (record['Impact']!==null ? 1 : 0)
                            + (record['Extension']!==null ? 1 : 0)
                            + (record['Duration']!==null ? 1 : 0)
                            + (record['Trend']!==null ? 1 : 0)
                            + (record['Probability']!==null ? 1 : 0);

                        let score = count>0
                            ? (4 - Math.pow(prod, (1/count)))
                            : null;

                        score = score!==null
                            ? ((0 - score) * 100 / 3).toFixed(1)
                            : null;

                        stats[key] = score;
                    }
                })

            });


            return stats;

        });

        return {
            ...setup_obj,
            threat_stats
        };

    }

}
