import { createApp, ref, reactive, watch, onMounted } from "vue";
import dopa_indicators_table from './../../../templates/dopa/indicators_table.vue';
import dopa_chart_bar from './../../../templates/dopa/chart_bar.vue';
import dopa_radar from './../../../templates/dopa/chart_radar.vue';
import editor from '@modular-forms/js/inputs/text-editor.vue';
import report_editor from './../../../inputs/editor.vue';
import BiopamaWDPA from './../../../helpers/biopamaWDPA';
import imet_radar from './../../../templates/imet_radar.vue';

export default class Analysis {

    constructor(input_data = {}, custom_props = {}) {
        let _this = this;

        const options = {
            name: 'Analysis',
            props: {
                report: Object,
                scores: Object,
                labels: Object,
                version: [String, Number],
                api_data: Object,
                connection: Boolean,
                wdpa_id: [String, Number],
                status: String,
                dopa_indicators: Object,
                url: String
            },
            setup(props) {
                return _this.setupApp(props);
            }
        }

        return this.createApp(options, input_data);
    }

    setupApp(input_data) {
        const status = ref(input_data.status);
        const report = reactive(input_data.report);
        const scores = input_data.scores;
        const labels = input_data.labels;

        watch(report, () => {
            status.value = 'changed';
        }, {
            deep: true
        });

        onMounted(() => {
            if (input_data.connection) {
                loadMap();
            }
        });

        function saveReport() {

            status.value = 'loading';

            fetch(input_data.url, {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": window.Laravel.csrfToken,
                },
                body: JSON.stringify({
                    _method: 'PATCH',
                    report: report
                })
            })
                .then((response) => response.json())
                .then(function (data) {
                    if (!(data.hasOwnProperty('status') && data.status === 'success')) {
                        status.value = 'error';
                    }
                    status.value = 'saved';
                })
                .catch(function (error) {
                    status.value = 'error';
                })
        }

        function printReport() {
            window.print();
        }

        let radar_values = {};
        ['context', 'planning', 'inputs', 'process', 'outputs', 'outcomes'].forEach(function (value, index) {
            let label = labels[value];
            radar_values[label] = scores[value].avg_indicator || null;
        });

        function loadMap() {

            const report_map = new window.mapboxgl.Map({
                container: 'map',
                style: BiopamaWDPA.base_layer,
                center: [30, 0],
                zoom: 4,
                minZoom: 2,
                maxZoom: 12,
                attributionControl: false
            });

            report_map.on('load', function () {
                BiopamaWDPA.addWdpaLayer(report_map, input_data.wdpa_id);
            });
        }
        return {
            status,
            report,
            scores,
            radar_values,
            saveReport,
            printReport,
            dopa_indicators: input_data.dopa_indicators,
            api_data: input_data.api_data,
            connection: input_data.connection
        }
    }

    createApp(options, input_data) {

        return createApp(options, input_data)
            .component('dopa_indicators_table', dopa_indicators_table)
            .component('editor', editor)
            .component('report-editor', report_editor)
            .component('dopa_radar', dopa_radar)
            .component('dopa_chart_bar', dopa_chart_bar)
            .component('imet_radar', imet_radar);
    }
}
