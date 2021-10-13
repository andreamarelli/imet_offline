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
                                <div class="col-12 mb-5" v-for="(value, index) in data.props.values.bars"
                                     :id="'{{$name}}-'+index">
                                    <container_actions :data="value" :name="'{{$name}}-'+index"
                                                       :event_image="'save_entire_block_as_image'">
                                        <template slot-scope="data_elements">
                                            <div class="align-items-center ">
                                                <bar :axis_dimensions_y="{min: 0, max: 100}" :fields="Object.keys(data_elements.props)" :title="container.props.stores.BaseStore.localization('imet-core::v2_common.steps_eval.'+index)" :rotate="90"
                                                     :values='container.props.stores.BaseStore.add_color_to_value(data_elements.props, index, container.props.config.element_diagrams.color)'></bar>

                                                <datatable_scaling v-if="data.props.values.sub[index].length"
                                                                   :columns="container.props.config.element_diagrams[index].columns"
                                                                   :values="data.props.values.sub[index]">
                                                </datatable_scaling>
                                            </div>

                                        </template>
                                    </container_actions>
                                </div>
                            </div>
                        </template>
                    </container>
                </div>
            </div>
        </div>
    </template>
</container_section>
