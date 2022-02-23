<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row contailer">
            <div class="col-sm">
                <div class="align-items-center">
                    <container_view
                        :loaded_at_once="false"
                        :title="container.props.config.element_diagrams.context[0].menu.header"
                        :url=url
                        :parameters="'{{$pa_ids}},context'"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false])
                            <container
                                :loaded_at_once="true"
                                :url=url
                                :title="container.props.config.element_diagrams.threats.menu.title"
                                :parameters="'{{$pa_ids}}'"
                                :func="'get_threats_categories_per_protected_area'">
                                <template slot-scope="data">
                                    @include('imet-core::scaling_up.components.analysis_element_threat', ['name' => $name])
                                </template>
                            </container>
                        </template>
                    </container_view>

                    <container_view
                        :loaded_at_once="false"
                        :loaded_at_once="container.props.show_view"
                        :title="container.props.config.element_diagrams.planning[0].menu.header"
                        :url=url
                        :parameters="'{{$pa_ids}},planning'"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :loaded_at_once="container.props.show_view"
                        :title="container.props.config.element_diagrams.inputs[0].menu.header"
                        :url=url
                        :parameters="'{{$pa_ids}},inputs'"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :loaded_at_once="container.props.show_view"
                        :title="container.props.config.element_diagrams.process[0].menu.header"
                        :url=url
                        >
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_process_elements', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="container.props.config.element_diagrams.outputs[0].menu.header"
                        :url=url
                        :parameters="'{{$pa_ids}},outputs'"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="container.props.config.element_diagrams.outcomes[0].menu.header"
                        :url=url
                        :parameters="'{{$pa_ids}},outcomes'"
                        :func="'analysis_per_element_of_the_management_cycle'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => false])
                        </template>
                    </container_view>
                </div>

            </div>
        </div>
    </template>
</container_section>
