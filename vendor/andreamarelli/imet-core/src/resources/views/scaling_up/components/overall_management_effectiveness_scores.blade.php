<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'imet-core::analysis_report.guidance.overall'"
>
    <template slot-scope="container">


        <checkboxes_list :items="{{json_encode($custom_names)}}">
            <template  slot-scope="pas">

                <container
                    :loaded_at_once="pas.props.show_view"
                    :url=url
                    :parameters="pas.props.ids"
                    :func="'get_overall_management_effectiveness_scores'">
                    <template slot-scope="data">

                        <div v-for="(value, index) in data.props.values" :id="'{{$name}}-'+index">

                            <div v-if="index=='ranking'" class="mt-3">
                                <div class="list-head mt-5">
                                    4.1 @lang('imet-core::analysis_report.overall.imet_indicator_ranking')
                                    <button class="btn-nav small blue">
                                        <span class="fas fa-fw fa-info-circle"></span>
                                    </button>
                                    <tooltip>{{trans('imet-core::analysis_report.guidance.info.ranking')}}</tooltip>
                                </div>
                                <div :id="'{{$name}}-ranking-'+index">
                                    <container_actions :data="value" :name="'{{$name}}-ranking-'+index"
                                                       :event_image="'save_entire_block_as_image'"
                                                       :exclude_elements="'{{$exclude_elements}}'">
                                        <template slot-scope="data_elements">
                                            <bar_category_stack
                                                :title="'4.1 @lang('imet-core::analysis_report.overall.imet_indicator_ranking')'"
                                                :axis_dimensions_y="{max:100}"
                                                :x_axis_data="data_elements.props.xAxis"
                                                :legends="data_elements.props.legends"
                                                :colors="container.props.config.color_correct_order"
                                                :percent_values="data_elements.props.percent_values"
                                                :raw_values="data_elements.props.raw_values"
                                                :values='data_elements.props.values'></bar_category_stack>
                                        </template>
                                    </container_actions>
                                </div>
                            </div>


                            <div v-if="index=='averages_six_elements'" class="mt-3" :name="'grouping'">
                                <div class="list-head">
                                    4.2 @lang('imet-core::analysis_report.overall.average_contribution')
                                    <button class="btn-nav small blue">
                                        <span class="fas fa-fw fa-info-circle"></span>
                                    </button>
                                    <tooltip>{{trans('imet-core::analysis_report.guidance.info.average_contribution')}}</tooltip>
                                </div>
                                <div :id="'{{$name}}-averages_six_elements-'+index">
                                    <container_actions :data="value"
                                                       :name="'{{$name}}-averages_six_elements-'+index"
                                                       :event_image="'save_entire_block_as_image'"
                                                       :exclude_elements="'{{$exclude_elements}}'">
                                        <template slot-scope="data_elements">
                                            <imet_bar_error
                                                :title="'4.2 @lang('imet-core::analysis_report.overall.average_contribution')'"
                                                :axis_dimensions_x="{max:100}"
                                                :event_id="'save_image_s'"
                                                :show_legends="true"
                                                :values="data_elements.props"
                                                :legends="data_elements.props.legends"
                                                :indicators='container.props.config.relative_performance_effectiveness_bar_average.indicators'></imet_bar_error>
                                        </template>
                                    </container_actions>
                                </div>
                            </div>


                            <div v-if="index=='radar'">
                                <div class="list-head">
                                    4.3 @lang('imet-core::analysis_report.overall.radar_visualization')
                                    <button class="btn-nav small blue">
                                        <span class="fas fa-fw fa-info-circle"></span>
                                    </button>
                                    <tooltip>{{trans('imet-core::analysis_report.guidance.info.radar')}}</tooltip>
                                </div>
                                <div :id="'{{$name}}-radar-'+index">
                                    <container_actions :data="value" :name="'{{$name}}-radar-'+index"
                                                       :event_image="'save_entire_block_as_image'"
                                                       :exclude_elements="'{{$exclude_elements}}'">
                                        <template slot-scope="data_elements">
                                            <scaling_radar class="sm" :height=850
                                                           :title="'4.3 @lang('imet-core::analysis_report.overall.radar_visualization')'"
                                                           :single="false"
                                                           :event_key="'overall'"
                                                           :unselect_legends_on_load="true"
                                                           :show_legends="true"
                                                           :values='data_elements.props'
                                                           :indicators='container.props.config.performance_diagram.indicators'
                                                           :data_table="'test'"></scaling_radar>
                                            <div style="font-size: 12px" class=align-center">
                                                {{ trans("imet-core::analysis_report.average_protected_areas") }}
                                            </div>
                                        </template>
                                    </container_actions>
                                </div>
                                <div :id="'{{$name}}-radar-datatable-'+index">
                                    <container_actions :data="value" :name="'{{$name}}-radar-datatable-'+index"
                                                       :event_image="'save_entire_block_as_image'"
                                                       :exclude_elements="'{{$exclude_elements}}'">
                                        <template slot-scope="data_elements">
                                            <datatable_interact_with_radar :default_order="'imet_index'"
                                                                           :event_key="'overall'"
                                                                           class="col-sm"
                                                                           :values_with_indicators_keys="true"
                                                                           :values="data_elements.props"
                                                                           :columns="container.props.config.performance_diagram.columns"></datatable_interact_with_radar>


                                        </template>
                                    </container_actions>
                                </div>
                            </div>


                            <div v-if="index=='scatter'" class="mt-3" :name="'grouping'">
                                <div class="list-head">
                                    4.4 @lang('imet-core::analysis_report.overall.scatter_visualization')
                                    <button class="btn-nav small blue">
                                        <span class="fas fa-fw fa-info-circle"></span>
                                    </button>
                                    <tooltip>{{trans('imet-core::analysis_report.guidance.info.scatter_plt')}}</tooltip>
                                </div>
                                <div :id="'{{$name}}-scatter-'+index">
                                    <container_actions :data="value" :name="'{{$name}}-scatter-'+index"
                                                       :event_image="'save_entire_block_as_image'"
                                                       :exclude_elements="'{{$exclude_elements}}'">
                                        <template slot-scope="data_elements">
                                            <scatter
                                                :title="'4.4 @lang('imet-core::analysis_report.overall.scatter_visualization')'"
                                                :label_axis_y="'@lang('imet-core::common.steps_eval.context') , @lang('imet-core::common.steps_eval.planning'), @lang('imet-core::common.steps_eval.inputs')'"
                                                :label_axis_x="'@lang('imet-core::common.steps_eval.process')'"
                                                :label_axis_y2="'@lang('imet-core::common.steps_eval.outcomes'), @lang('imet-core::common.steps_eval.outputs')'"
                                                :label_axis_y2_show="false"
                                                :values='data_elements.props'
                                            ></scatter>
                                            <div style="font-size: 12px" class=align-center">
                                                {{ trans("imet-core::analysis_report.ranking_info_indicators") }}
                                            </div>
                                            <div style="font-size: 12px" class=align-center">
                                                * {{ trans("imet-core::analysis_report.size_of_square") }}
                                            </div>
                                        </template>
                                    </container_actions>
                                </div>
                            </div>

                            <div v-if="index=='assessments'" class="mt-3">
                                <div class="list-head">
                                    4.5 @lang('imet-core::analysis_report.overall.synthetic_indicators')
                                    <button class="btn-nav small blue">
                                        <span class="fas fa-fw fa-info-circle"></span>
                                    </button>
                                    <tooltip>{{trans('imet-core::analysis_report.guidance.info.datatable')}}</tooltip>
                                </div>
                                <div :id="'{{$name}}-assessments-'+index">
                                    <container_actions :data="value" :name="'{{$name}}-assessments-'+index"
                                                       :event_image="'save_entire_block_as_image'"
                                                       :exclude_elements="'{{$exclude_elements}}'">
                                        <template slot-scope="data_elements">
                                            <datatable_scaling :default_order="'imet_index'"

                                                               :default_order_dir="'desc'"
                                                               :columns="container.props.config.evaluation_of_protected_area_management_cycle.columns"
                                                               :values="data_elements.props">
                                            </datatable_scaling>
                                        </template>
                                    </container_actions>
                                </div>
                            </div>
                        </div>

                    </template>
                </container>

            </template>

        </checkboxes_list>

    </template>
</container_section>
