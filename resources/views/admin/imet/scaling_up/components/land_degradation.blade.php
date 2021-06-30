<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'get_dopa_country_indicators'"
                    >
                        <template slot-scope="data">
                            <div v-for="(value, index) in data.props.values" :id="'{{$name}}-'+index"
                                 class="module-body">
                                <container_actions :data="value" :name="'{{$name}}-'+index"
                                                    :event_image="'save_entire_block_as_image'"
                                                    :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="data_elements">
                                        <div class="list-key-numbers horizontal">
                                            <div class="list-head" v-html="index">
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <dopa_indicators_table
                                                                :indicators=container.props.config.dopa_indicators.land_degradation.indicators
                                                                :api_data="Object.assign({}, ...data_elements.props)"
                                                                :precision="2"
                                                        ></dopa_indicators_table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <scaling_dopa_chart_doughnut
                                                                :title=container.props.config.dopa_indicators.land_degradation.title_chart
                                                                :indicators=container.props.config.dopa_indicators.land_degradation.bar_indicators
                                                                :api_data="Object.assign({}, ...data_elements.props)"
                                                        ></scaling_dopa_chart_doughnut>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </template>
                                </container_actions>
                            </div>
                        </template>
                    </container>
                </div>
                <container_actions :name="'{{$name}}'" :event_image="'save_entire_block_as_image'"></container_actions>
            </div>

        </div>
    </template>
</container_section>