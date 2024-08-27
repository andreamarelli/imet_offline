<container_section :id="'{{$name}}'" :title="'{{$title}}'" :class="'upper_downa'" :code="'{{$code}}'"
                   :guidance="'imet-core::analysis_report.guidance.relative_performance'"
>
    <template slot-scope="container">

            <checkboxes_list :items="{{json_encode($custom_names)}}">
                <template slot-scope="pas">
                    <container
                        :loaded_at_once="pas.props.show_view"
                        :url=url
                        :parameters="pas.props.ids"
                        :func="'get_upper_lower_protected_areas_diagram_compare'"
                        :element="'{{$name}}'"
                        :show_menu="true"
                    >
                        <template slot-scope="data">
                            <div v-for="(radar, index) in data.props.values">
                                <small_menu v-if="index!=='form_ids'" :items="data.props.values.diagrams" :ids="'upper_lower_'"
                                            :exclude="'Average,upper limit,lower limit'"></small_menu>

                                <container_upper_lower_radars v-if="index!=='form_ids'" :width=1128 :height=750
                                                              :unselect_legends_on_load="true"
                                                              :single="false"
                                                              :show_legends="true"
                                                              :indicators='container.props.config.indicators'
                                                              :radar="radar"
                                ></container_upper_lower_radars>
                            </div>
                        </template>
                    </container>
                </template>
            </checkboxes_list>

    </template>
</container_section>
