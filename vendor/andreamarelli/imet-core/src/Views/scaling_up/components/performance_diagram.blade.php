<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'get_protected_areas_diagram_compare'"
                    >
                        <template slot-scope="data">
                            <div v-for="(radar, index) in data.props.values" class="container">
                                <container_actions :data="radar" :name="'{{$name}}'"
                                                   :event_image="'save_entire_block_as_image'"
                                                   :exclude_elements="'{{$exclude_elements}}'">
                                    <template slot-scope="data_elements">
                                        <div class="row">
                                            <scaling_radar class="sm" :height=700
                                                           :single="false"
                                                           :unselect_legends_on_load="true"
                                                           :show_legends="true"
                                                           :values='data_elements.props'
                                                           :indicators='container.props.config.performance_diagram.indicators'
                                                           :data_table="'test'"></scaling_radar>

                                        </div>
                                        <div class="row">

                                            <datatable_interact_with_radar class="col-sm" :values="data_elements.props"
                                                                           :columns="container.props.config.performance_diagram.columns"></datatable_interact_with_radar>

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