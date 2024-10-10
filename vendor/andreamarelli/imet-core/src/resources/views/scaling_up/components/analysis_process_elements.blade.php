
<container_analysis_management_cycle
    id="process"
    :title="container.props.config.element_diagrams.process[0].menu.title"
    :url=url
    :type="'process'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{json_encode($custom_names)}}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
    </template>
</container_analysis_management_cycle>

<container_analysis_management_cycle
    id="process_PRA"
    :title="container.props.config.element_diagrams.process_PRA[0].menu.title"
    :url=url
    :type="'process_PRA'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{json_encode($custom_names)}}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
    </template>
</container_analysis_management_cycle>

<container_analysis_management_cycle
    id="process_PRB"
    :title="container.props.config.element_diagrams.process_PRB[0].menu.title"
    :url=url
    :type="'process_PRB'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{json_encode($custom_names)}}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
    </template>
</container_analysis_management_cycle>

<container_analysis_management_cycle
    id="process_PRC"
    :title="container.props.config.element_diagrams.process_PRC[0].menu.title"
    :url=url
    :type="'process_PRC'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{json_encode($custom_names)}}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
    </template>
</container_analysis_management_cycle>

<container_analysis_management_cycle
    id="process_PRD"
    :title="container.props.config.element_diagrams.process_PRD[0].menu.title"
    :url=url
    :type="'process_PRD'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{json_encode($custom_names)}}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
    </template>
</container_analysis_management_cycle>

<container_analysis_management_cycle
    id="process_PRE"
    :title="container.props.config.element_diagrams.process_PRE[0].menu.title"
    :url=url
    :type="'process_PRE'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{json_encode($custom_names)}}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
    </template>
</container_analysis_management_cycle>

<container_analysis_management_cycle
    id="process_PRF"
    :title="container.props.config.element_diagrams.process_PRF[0].menu.title"
    :url=url
    :type="'process_PRF'"
    :class_name="'sub-title'"
    :parent_class_name="''"
    :items="{{json_encode($custom_names)}}"
    :func="'analysis_per_element_of_the_management_cycle'">
    <template v-slot:default="data">
        @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
    </template>
</container_analysis_management_cycle>
