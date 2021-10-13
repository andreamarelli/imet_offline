<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm" :id="'main-error-bar'">
                <container
                        :loaded_at_once="container.props.show_view"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_averages_of_each_indicator_of_six_elements'"
                >
                    <template slot-scope="data">
                        <div :id="'main-error-bar'">
                            <div class="text-center">
                                <strong>@lang('imet-core::analysis_report.average_contribution_management')</strong>
                            </div>
                            <div class="align-items-center">
                                <container_actions :data="data.props" :name="'main-error-bar'"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="v">
                                        <imet_bar_error
                                                :axis_dimensions_x="{max:100}"
                                                :event_id="'save_image_s'"
                                                :show_legends="true"
                                                :values="container.props.stores.BaseStore.add_color_to_value_rel(v.props.values, container.props.config.relative_performance_effectiveness_bar_average.color)"
                                                :indicators='container.props.config.relative_performance_effectiveness_bar_average.indicators'></imet_bar_error>
                                    </template>
                                </container_actions>
                            </div>
                        </div>
                    </template>
                </container>
            </div>
        </div>
        <div class="row">
            <div class="col-sm ml-5 mr-5">
                <div id="imet-effectiveness-intervals-rest" class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'get_average_contribution_by_six_indicators_to_value_and_importance'"
                    >
                        <template slot-scope="data">
                            <div v-for="(value, idx) in data.props.values" :id="'bar-errors'+idx">
                                <div class="text-center"><strong
                                            v-html="container.props.stores.BaseStore.localization('imet-core::analysis_report.relative_performance_effectiveness_bar_average.titles.'+idx)"></strong>
                                </div>
                                <container_actions :data="value" :name="'main-error-bar'"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="v">
                                        <imet_bar_error
                                                :axis_dimensions_x="{max:100}"
                                                :show_legends="true"
                                                :values="v.props.data"
                                                :height="v.props.options.height"
                                                :indicators='container.props.stores.BaseStore.parse_indicators(v.props.labels)'></imet_bar_error>
                                    </template>
                                </container_actions>
                            </div>
                        </template>
                    </container>
                </div>
            </div>
        </div>
    </template>
</container_section>