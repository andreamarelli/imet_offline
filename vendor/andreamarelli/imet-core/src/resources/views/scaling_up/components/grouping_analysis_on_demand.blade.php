<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :info_label="'imet-core::analysis_report.guidance.grouping'">
    <template v-slot:default="container">

        <container
            :loaded_at_once="container.props.show_view"
            :url=url
            :parameters="'{{$pa_ids}}'"
            :func="'get_assessments'">
            <template v-slot:default="data">
                <div v-for="(value, index) in data.props" :id="'{{$name}}-'+index">
                    <datatable_scaling
                        :columns="container.props.config.evaluation_of_protected_area_management_cycle.columns"
                        :values="Object.values(value)"
                        :default_order="'name'">
                    </datatable_scaling>
                </div>
            </template>
        </container>

        <container
            :loaded_at_once="container.props.show_view"
            :url=url
            :parameters="'{{$pa_ids}}'"
            :func="'get_protected_area_with_countries'">
            <template v-slot:default="data">
                <div v-if="Object.entries(data.props).length > 0">
                    <grouping id="exclude" :values="data.props" :number_of_drop_zones="3">
                        <template v-slot:default="params">
                            <container
                                :url=url
                                :event-parameters="true"
                                :lazy_load_parameters=true
                                :func="'get_grouping_analysis'"
                                :on_load="false"
                                :trigger_incoming_data="params.trigger_incoming_data"
                            >
                                <template v-slot:default="values">
                                    <container_actions :data="values.props" :name="'render_image'"
                                                       :event_image="'save_entire_block_as_image'"
                                                       :exclude_elements="'{{$exclude_elements}}'">
                                        <template v-slot:default="data_elements">
                                            <div
                                                v-if="container.props.stores.BaseStore.is_visible(data_elements.props.radar)"
                                                :name="'grouping'" class="mb-3">
                                                <scaling_radar :width="1128" :height="700"
                                                               :event_key="'grouping'"
                                                               :single="false"
                                                               :unselect_legends_on_load="false"
                                                               :show_legends="true"
                                                               :values='data_elements.props.radar'
                                                               :indicators='container.props.config.indicators'></scaling_radar>
                                                <datatable_interact_with_radar
                                                    :default_order="'name'"
                                                    :event_key="'grouping'"
                                                    :values_with_indicators_keys="true"
                                                    :values="data_elements.props.radar"
                                                    :columns="container.props.config.group_analysis_on_demand.columns"></datatable_interact_with_radar>
                                            </div>
                                            <div
                                                v-if="container.props.stores.BaseStore.is_visible(data_elements.props.scatter)"
                                                :name="'grouping'" class="mb-3">
                                                <scatter
                                                    :label_axis_y="'@lang('imet-core::common.steps_eval.context') , @lang('imet-core::common.steps_eval.planning'), @lang('imet-core::common.steps_eval.inputs')'"
                                                    :label_axis_x="'@lang('imet-core::common.steps_eval.process')'"
                                                    :label_axis_y2="'@lang('imet-core::common.steps_eval.outcomes'), @lang('imet-core::common.steps_eval.outputs')'"
                                                    :label_axis_y2_show="false"
                                                    :values='data_elements.props.scatter'
                                                ></scatter>
                                            </div>

                                            <div
                                                v-if="container.props.stores.BaseStore.is_visible(data_elements.props.scatter)">
                                                <datatable_interact_with_scatter
                                                    :default_order="'name'"
                                                    :values="data_elements.props.scatter"
                                                    :columns="container.props.config.group_analysis_on_demand.scatter_columns"></datatable_interact_with_scatter>
                                            </div>
                                        </template>
                                    </container_actions>
                                </template>
                            </container>
                        </template>
                    </grouping>
                </div>
            </template>
        </container>

    </template>
</container_section>
