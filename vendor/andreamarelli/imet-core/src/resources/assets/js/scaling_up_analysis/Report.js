import {createApp, ref, provide} from "vue";
import generalInfo from './components/general_info.vue';
import managementContext from './components/management_context.vue';
import imetBarChart from '../templates/imet_bar_chart.vue';
import grouping from './components/grouping.vue';
import textEditor from './components/text_editor.vue';
import mapView from './components/map_view.vue';
import previewTemplate from './components/preview_template.vue';
import container from './components/containers/container.vue';
import containerView from './components/containers/container_view.vue';
import containerAnalysisManagementCycle from './components/containers/container_analysis_management_cycle.vue';
import containerSection from './components/containers/container_section.vue';
import containerUpperLowerRadars from './components/containers/container_upper_lower_radars.vue';
import containerActions from './components/containers/container_actions.vue';
import datatableCustom from './components/datatables/datatable_custom.vue';
import datatableInteractWithRadar from './components/datatables/datatable_interact_with_radar.vue';
import datatableInteractWithScatter from './components/datatables/datatable_interact_with_scatter.vue';
import datatableScaling from './components/datatables/datatable_scaling.vue';
import barReverse from './components/bar_charts/bar_reverse.vue';
import barCategoryStack from './components/bar_charts/bar_category_stack.vue';
import imetBarError from './components/bar_charts/imet_bar_error.vue';
import scalingRadar from './components/various_charts/scaling_radar.vue';

import treemap from './components/various_charts/treemap.vue';
import scalingDopaChartBar from '../templates/dopa/chart_bar.vue';
import scalingDopaChartDoughnut from '../templates/dopa/chart_doughnut.vue';
import scatter from './components/various_charts/scatter.vue';
import radarThreats from './components/various_charts/radar_threats.vue';
import colorPicker from './tools/color_picker.vue';
import basket from './components/basket.vue';
import guidance from './components/guidance.vue';
import smallMenu from './components/menus/small_menu.vue';
import tooltip from 'modular-forms/src/resources/assets/js/templates/tooltip.vue';
import dopaIndicatorsTable from '../templates/dopa/indicators_table.vue';
import checkboxesList from './components/checkboxes_list.vue';
import application from './components/app.vue';

import mitt from 'mitt';

export default class Report {

    constructor(input_data = {}) {

        const options = {
            name: 'Report',
            setup() {
                const emitter = mitt();
                provide('emitter', emitter);

                function goTo(event) {
                    let element = event.target.value;
                    if(element === '#'){
                        return;
                    }
                    if (['process', 'process_PRA', 'process_PRB', 'process_PRC', 'process_PRD', 'process_PRE', 'process_PRF'].includes(element)) {
                        let event_element = 'analysis_per_element_of_them_management_cycle';
                        emitter.emit(event_element);
                        setTimeout(() => {
                            emitter.emit('sub_elem_4');
                        }, 500);
                        setTimeout(() => {
                            window.ModularForms.Helpers.Animation.scrollPageToAnchor(element);
                        }, 800);
                    } else {
                        emitter.emit(element);
                        setTimeout(() => {
                            window.ModularForms.Helpers.Animation.scrollPageToAnchor(element);
                        }, 500);
                    }

                }
                return {
                    goTo,
                    url:input_data.url
                }
            }

        }

        const app = createApp(
            options || {},
            input_data || {}
        );

        app.component('app',    application);
        // Register components
        app.component('general_info', generalInfo);
        app.component('management_context', managementContext);
        app.component('grouping', grouping);
        app.component('map_view',    mapView);
        app.component('preview_template',    previewTemplate);
        app.component('container', container);

        app.component('container_view', containerView);
        app.component('container_analysis_management_cycle', containerAnalysisManagementCycle);
        app.component('container_section',    containerSection);
        app.component('container_upper_lower_radars', containerUpperLowerRadars);
        app.component('container_actions', containerActions);
        app.component('datatable_custom', datatableCustom);
        app.component('datatable_interact_with_radar', datatableInteractWithRadar);
        app.component('datatable_interact_with_scatter', datatableInteractWithScatter);
        app.component('datatable_scaling', datatableScaling);
        app.component('bar_reverse', barReverse);
        app.component('bar_category_stack', barCategoryStack);
        app.component('imet_bar_error',    imetBarError);
        app.component('scaling_radar', scalingRadar);
        app.component('treemap', treemap);
        app.component('dopa_chart_bar',    scalingDopaChartBar);
        app.component('dopa_chart_doughnut',    scalingDopaChartDoughnut);
        app.component('scatter',    scatter);
        app.component('radar_threats', radarThreats);
        app.component('color_picker', colorPicker);
        app.component('basket', basket);
        app.component('guidance',    guidance);
        app.component('small_menu',    smallMenu);
        app.component('checkboxes_list', checkboxesList);
        app.component('tooltip', tooltip);
        app.component('imet_bar_chart', imetBarChart);
        app.component('dopa_indicators_table', dopaIndicatorsTable);
        app.component('text_editor', textEditor);

        return app;
    }
}
