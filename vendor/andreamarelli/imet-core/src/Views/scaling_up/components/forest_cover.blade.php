<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <container
                        :loaded_at_once="container.props.show_view"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_pa_all_indicators'"
                >
                    <template slot-scope="data">
                        <div class="module-body bg-white border-0">
                            <div v-for="(value, index) in data.props.values" class="container" :id="'{{$name}}-'+index">

                                <container_actions :data="value" :name="'{{$name}}-'+index"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="data_elements">
                                        <div v-for="(value, idx) in data_elements.props">
                                            <div class="module-body bg-white border-0">
                                                <dopa_indicators_table
                                                        :title=idx
                                                        :indicators=container.props.config.dopa_indicators.forest_cover.indicators
                                                        :api_data="Object.assign({}, ...value)"
                                                        :precision="2"
                                                ></dopa_indicators_table>
                                                <dopa_chart_bar
                                                        :title=container.props.config.dopa_indicators.forest_cover.title_chart
                                                        :indicators=container.props.config.dopa_indicators.forest_cover.bar_indicators
                                                        :api_data="Object.assign({}, ...value)"
                                                ></dopa_chart_bar>
                                            </div>
                                        </div>
                                    </template>
                                </container_actions>
                            </div>
                        </div>
                    </template>
                </container>
            </div>
        </div>
    </template>
</container_section>
