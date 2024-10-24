import { ref, watch, onMounted, computed } from "vue";
import Analysis from './../ImetV1/Analysis.js';
import checkbox_boolean from '../../../inputs/checkbox-boolean.vue';
import objectives from './../../../report/oecm/objectives.vue';
import roadmap from './../../../report/oecm/roadmap.vue';
import table_input from './../../../report/oecm/table_input.vue';
import imet_score_bar from './../../../templates/imet_score_bar.vue';


export default class OECMAnalysis extends Analysis {
    constructor(input_data = {}, custom_props = {}) {


        return super(input_data, custom_props)
            .component('objectives', objectives)
            .component('roadmap', roadmap)
            .component('table_input', table_input)
            .component('checkbox-boolean', checkbox_boolean)
            .component('imet_score_bar', imet_score_bar);
    }

    setupApp(input_data) {
        let setup_obj = super.setupApp(input_data);

        let table_input_elems = ref(input_data.table_input_elems);
        let short_long_objectives = input_data.short_long_objectives;
        let loading_objectives = input_data.loading_objectives;
        let error_objectives = input_data.error_objectives;
        const default_schema = input_data.default_schema;
        const objectives_url = input_data.objectives_url;

        onMounted(() => {
            if (setup_obj.report.length > 0) {
                for (const items in setup_obj.report) {
                    for (const item in setup_obj.report[items]) {
                        if (setup_obj.report[items][item] === null) {
                            setup_obj.report[items][item] = "";
                        }
                    }
                }
                table_input_elems.value = setup_obj.report.map((elem, index) => index);
            }

            getObjectives();
        });

        const reportLength = computed(() => {
            return setup_obj.report.length;
        });

        watch(setup_obj.status, (value) => {
            if (value === 'saved') {
                setTimeout(() => {
                    setup_obj.status = 'idle';
                }, 4000);
            }
        });

        watch(setup_obj.report, () => {
            setup_obj.status = 'changed';
        }, { deep: true });

        function addItem() {
            if (table_input_elems.value.length < 10) {
                const id = table_input_elems.value.length;
                table_input_elems.value.push(id);

                const new_schema = JSON.parse(JSON.stringify(default_schema));

                for (const item in new_schema) {
                    if (new_schema[item] === null) {
                        new_schema[item] = "";
                    }
                }
                setup_obj.report.push(new_schema);
            }
        }

        function deleteItem(index) {
            const key = table_input_elems.value.pop();
            setup_obj.report.splice(key, 1);
        }

        function getObjectives() {
            loading_objectives = true;

            fetch(objectives_url, {
                method: 'get',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": window.Laravel.csrfToken,
                }
            })
                .then((response) => response.json())
                .then(function (data) {
                    error_objectives = false;
                    short_long_objectives = data;
                    loading_objectives = false;
                })
                .catch((error) => {
                    error_objectives = true;
                    loading_objectives = false;
                })
        }
        return {
            ...setup_obj,
            addItem,
            deleteItem,
            getObjectives,
            reportLength,
            table_input_elems,
            short_long_objectives,
            loading_objectives,
            error_objectives
        }
    }

    createApp(options, input_data) {

        return super.createApp(options, input_data)
    }
}
