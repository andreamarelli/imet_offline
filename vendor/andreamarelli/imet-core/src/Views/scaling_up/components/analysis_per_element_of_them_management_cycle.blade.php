<container_section :event_name="'{{$name}}'" :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'">
    <template slot-scope="container">
        <div class="row contailer">
            <div class="col-sm">
                <div class="align-items-center">
                    <guidance :text="'imet-core::analysis_report.guidance.analysis_per_element'"/>
                </div>
            </div>
        </div>
        <div class="row contailer">
            <div class="col-sm">
                <div class="align-items-center">

                    <container_analysis_management_cycle
                        id="sub_elem_1"
                        :items="{{json_encode($custom_names)}}"
                        :title="container.props.config.element_diagrams.context[0].menu.header"
                        :guidance="'imet-core::analysis_report.guidance.context.main'"
                        :url=url
                        :type="'context'"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false, 'sub_class' => 'sub-title-second'])
                            <div v-if="Object.keys(data.props.values).length">
                                <container
                                    :loaded_at_once="true"
                                    :url=url
                                    :title="container.props.config.element_diagrams.threats.menu.title"
                                    :parameters="data.props.parameters"
                                    :func="'get_threats_categories_per_protected_area'">
                                    <template slot-scope="data">

                                        @include('imet-core::scaling_up.components.analysis_element_threat', ['name' => $name, 'sub_class' => 'sub-title-second'])
                                    </template>
                                </container>
                            </div>
                        </template>
                    </container_analysis_management_cycle>
                    <container_analysis_management_cycle
                        id="sub_elem_2"
                        :loaded_at_once="container.props.show_view"
                        :guidance="'imet-core::analysis_report.guidance.planning.main'"
                        :title="container.props.config.element_diagrams.planning[0].menu.header"
                        :url=url
                        :type="'planning'"
                        :items="{{json_encode($custom_names)}}"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false])
                        </template>
                    </container_analysis_management_cycle>
                    <container_analysis_management_cycle
                        id="sub_elem_3"
                        :guidance="'imet-core::analysis_report.guidance.inputs.main'"
                        :title="container.props.config.element_diagrams.inputs[0].menu.header"
                        :url=url
                        :type="'inputs'"
                        :items="{{json_encode($custom_names)}}"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false])
                        </template>
                    </container_analysis_management_cycle>
                    <container_view
                        id="sub_elem_4"
                        :event_name="'sub_elem_4'"
                        :guidance="'imet-core::analysis_report.guidance.process.main'"
                        :loaded_at_once="false"
                        :loaded_at_once="container.props.show_view"
                        :title="container.props.config.element_diagrams.process[0].menu.header"
                        :url=url>
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_process_elements', ['name' => $name, 'sub_class' => 'sub-title-second'])
                        </template>
                    </container_view>
                    <container_analysis_management_cycle
                        id="sub_elem_5"
                        :guidance="'imet-core::analysis_report.guidance.outputs.main'"
                        :title="container.props.config.element_diagrams.outputs[0].menu.header"
                        :url=url
                        :type="'outputs'"
                        :items="{{json_encode($custom_names)}}"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false, 'sub_class' => 'sub-title-second'])
                        </template>
                    </container_analysis_management_cycle>
                    <container_analysis_management_cycle
                        id="sub_elem_6"
                        :guidance="'imet-core::analysis_report.guidance.outcomes.main'"
                        :title="container.props.config.element_diagrams.outcomes[0].menu.header"
                        :url=url
                        :type="'outcomes'"
                        :items="{{json_encode($custom_names)}}"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false, 'sub_class' => 'sub-title-second'])
                        </template>
                    </container_analysis_management_cycle>
                </div>

            </div>
        </div>
    </template>
</container_section>
