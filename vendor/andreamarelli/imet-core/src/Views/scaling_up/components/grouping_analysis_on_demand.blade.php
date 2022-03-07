<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'{{trans('imet-core::analysis_report.guidance.grouping')}}'">
    <template slot-scope="container">
        <div class="align-items-center">
            <div class="list-key-numbers horizontal">
                <div class="list-head">@lang('imet-core::analysis_report.grouping.title')</div>
            </div>
            <div class="row">

                <div class="col-sm">
                    <container
                        :loaded_at_once="container.props.show_view"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_assessments'">
                        <template slot-scope="data">
                            <div class="module-body bg-white border-0">
                                <div v-for="(value, index) in data.props.values" class="container"
                                     :id="'{{$name}}-'+index">
                                    <div class="row">
                                        <div class="col-sm">
                                            <datatable_scaling
                                                :columns="container.props.config.evaluation_of_protected_area_management_cycle.columns"
                                                :values="value">
                                            </datatable_scaling>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </container>
                </div>
            </div>
            <container
                :loaded_at_once="container.props.show_view"
                :url=url
                :parameters="'{{$pa_ids}}'"
                :func="'get_protected_area_with_countries'">
                <template slot-scope="data">
                    <div class="module-body bg-white border-0" id="groups"
                         v-if="Object.entries(data.props.values).length > 0">
                        <grouping id="exclude" :values="data.props.values" :number_of_drop_zones="3">
                            <template>
                                <container
                                    :url=url
                                    :event-parameters="true"
                                    :lazy_load_parameters=true
                                    :func="'get_grouping_analysis'"
                                    :on_load="false">
                                    <template slot-scope="values">
                                        <container_actions :data="values.props" :name="'render_image'"
                                                           :event_image="'save_entire_block_as_image'"
                                                           :exclude_elements="'{{$exclude_elements}}'">
                                            <template slot-scope="data_elements">
                                                <div>
                                                    <div>
                                                        <div class="row"
                                                             v-if="container.props.stores.BaseStore.is_visible(data_elements.props.values.radar)"
                                                             :name="'grouping'">
                                                            <div class="col-sm">
                                                                <scaling_radar :width=1128 :height=700
                                                                               :event_key="'grouping'"
                                                                               :single="false"
                                                                               :unselect_legends_on_load="false"
                                                                               :show_legends="true"
                                                                               :values='data_elements.props.values.radar'
                                                                               :indicators='container.props.config.indicators'></scaling_radar>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row"
                                                         v-if="container.props.stores.BaseStore.is_visible(data_elements.props.values.scatter)"
                                                         :name="'grouping'">
                                                        <div class="col-sm">
                                                            <scatter
                                                                :label_axis_y="'@lang('imet-core::v2_common.steps_eval.context') , @lang('imet-core::v2_common.steps_eval.planning'), @lang('imet-core::v2_common.steps_eval.inputs')'"
                                                                :label_axis_x="'@lang('imet-core::v2_common.steps_eval.process')'"
                                                                :label_axis_y2="''"
                                                                :values='data_elements.props.values.scatter'
                                                            ></scatter>
                                                        </div>
                                                    </div>
                                                    <div class="row"
                                                         v-if="container.props.stores.BaseStore.is_visible(data_elements.props.values.radar)">
                                                        <div class="col-sm">
                                                            <datatable_interact_with_radar
                                                                :event_key="'grouping'"
                                                                :values_with_indicators_keys="true"
                                                                :values="data_elements.props.values.radar"
                                                                :columns="container.props.config.group_analysis_on_demand.columns"></datatable_interact_with_radar>
                                                        </div>
                                                    </div>
                                                    <div class="row"
                                                         v-if="container.props.stores.BaseStore.is_visible(data_elements.props.values.scatter)">
                                                        <div class="col-sm">
                                                            <datatable_interact_with_scatter
                                                                :values="data_elements.props.values.scatter"
                                                                :columns="container.props.config.group_analysis_on_demand.scatter_columns"></datatable_interact_with_scatter>
                                                        </div>
                                                    </div>
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
        </div>
    </template>
</container_section>
