<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'getTotalCarbon'"
                    >
                        <template slot-scope="data">
                            <div v-if="data.props.values.diagram" :id="'sum_diagram'">
                                <container_actions :data="data.props.values.diagram" :name="'sum_diagram'"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="diagrams">
                                        <bar :fields="Object.keys(data.props.values.diagram.values)"
                                             :rotate="45" :zoom="false"
                                             :values='Object.values(data.props.values.diagram.values)'></bar>
                                    </template>
                                </container_actions>
                            </div>
                            <div v-for="(value, index) in data.props.values.data" :id="'{{$name}}-'+index"
                                 class="module-body bg-white border-0">
                                <container_actions :data="value" :name="'{{$name}}-'+index"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="data_elements">
                                        <div v-for="(area, idx) in data_elements.props">
                                            <div class="list-key-numbers horizontal">
                                                <div class="list-head" v-html="idx">
                                                </div>
                                            </div>
                                            <div class="module-body bg-white border-0">
                                                <dopa_indicators_table
                                                        :indicators=container.props.config.dopa_indicators.total_carbon.indicators
                                                        :api_data="Object.assign({}, ...area)"
                                                        :precision="2"
                                                ></dopa_indicators_table>
                                            </div>

                                        </div>
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