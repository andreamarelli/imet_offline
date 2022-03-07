<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'{{trans('imet-core::analysis_report.guidance.map')}}'"
>
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                        :loaded_at_once="container.props.show_view"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_maps_stats'"
                    >
                        <template slot-scope="data">
                            <div id="map-view">
                                <container_actions :data="data.props" :name="'map-view'"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="data_elements">
                                        <map_view v-if="container.props.show_view" pa="{{$pa_ids}}" :url=url></map_view>
                                        <dopa_coverage_table
                                            :title=container.props.config.map.dopa_indicators.terrestial_area.title_table
                                            :indicators=container.props.config.map.dopa_indicators.terrestial_area.indicators
                                            :api_data="Object.assign({}, data_elements.props.values[1])"
                                            :precision="2"></dopa_coverage_table>
                                        <dopa_coverage_table
                                            :title=container.props.config.map.dopa_indicators.marine_area.title_table
                                            :indicators=container.props.config.map.dopa_indicators.marine_area.indicators
                                            :api_data="Object.assign({}, data_elements.props.values[1])"
                                            :precision="2"></dopa_coverage_table>
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
