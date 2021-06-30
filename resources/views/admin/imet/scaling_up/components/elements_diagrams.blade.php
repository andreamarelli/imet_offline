<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container
                            :loaded_at_once="container.props.show_view"
                            :url=url
                            :parameters="'{{$pa_ids}}'"
                            :func="'analysis_diagram_protected_areas'"
                    >
                        <template slot-scope="data" class="col-24">
                            <div class="row">
                                <div class="col-12 mb-5" v-for="(value, index) in data.props.values"
                                     :id="'{{$name}}-'+index">
                                    <container_actions :data="value" :name="'{{$name}}-'+index"
                                                       :event_image="'save_entire_block_as_image'">
                                        <template slot-scope="data_elements">
                                            <div class="align-items-center ">
                                                {{--                            <div v-html="color[0][index]"></div>--}}
                                                <bar :fields="Object.keys(data_elements.props)" :title="container.props.stores.BaseStore.localization('form/imet/v2/common.steps_eval.'+index)" :rotate="90"
                                                     :values='container.props.stores.BaseStore.add_color_to_value(data_elements.props, index, container.props.config.element_diagrams.color)'></bar>
                                            </div>
                                        </template>
                                    </container_actions>
                                </div>
                            </div>
                        </template>
                    </container>
                </div>
                <container_actions :name="'{{$name}}'" :event_image="'save_entire_block_as_image'"></container_actions>
            </div>
        </div>
    </template>
</container_section>
