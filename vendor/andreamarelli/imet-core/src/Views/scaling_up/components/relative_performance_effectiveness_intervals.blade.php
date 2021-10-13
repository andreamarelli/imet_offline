<container_section :id="'{{$name}}'" :title="'{{$title}}'" :class="'upper_downa'">
    <template slot-scope="container">

        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'get_upper_lower_protected_areas_diagram_compare'"
                            :element="'{{$name}}'"
                            :show_menu="true"
                    >
                        <template slot-scope="data">
                            <div class="contailer" v-for="(radar, index) in data.props.values">
                                <small_menu :items="data.props.values.diagrams" :ids="'upper_lower_'" :exclude="'Average,upper limit,lower limit'"></small_menu>
                                <container_upper_lower_radars :width=480 :height=600
                                                              :unselect_legends_on_load="true"
                                                              :single="false"
                                                              :show_legends="true"
                                                              :indicators='container.props.config.indicators'
                                                              :radar="radar"
                                ></container_upper_lower_radars>
                            </div>
                        </template>
                    </container>
                </div>
            </div>
        </div>
    </template>
</container_section>
