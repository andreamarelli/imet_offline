<div class="row">
    <div class="col-12 ml-2">
        <container_view
            :loaded_at_once="false"
            :loaded_at_once="container.props.show_view"
            :title="container.props.config.element_diagrams.process[0].menu.title"
            :url=url
            :parameters="'{{$pa_ids}},process'"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_view>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_view
            :loaded_at_once="false"
            :loaded_at_once="container.props.show_view"
            :title="container.props.config.element_diagrams.process_pr1_pr6[0].menu.title"
            :url=url
            :parameters="'{{$pa_ids}},process_pr1_pr6'"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_view>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_view
            :loaded_at_once="false"
            :loaded_at_once="container.props.show_view"
            :title="container.props.config.element_diagrams.process_pr7_pr9[0].menu.title"
            :url=url
            :parameters="'{{$pa_ids}},process_pr7_pr9'"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_view>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_view
            :loaded_at_once="false"
            :loaded_at_once="container.props.show_view"
            :title="container.props.config.element_diagrams.process_pr10_pr12[0].menu.title"
            :url=url
            :parameters="'{{$pa_ids}},process_pr10_pr12'"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_view>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_view
            :loaded_at_once="false"
            :loaded_at_once="container.props.show_view"
            :title="container.props.config.element_diagrams.process_pr13_pr14[0].menu.title"
            :url=url
            :parameters="'{{$pa_ids}},process_pr13_pr14'"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_view>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_view
            :loaded_at_once="false"
            :loaded_at_once="container.props.show_view"
            :title="container.props.config.element_diagrams.process_pr15_pr16[0].menu.title"
            :url=url
            :parameters="'{{$pa_ids}},process_pr15_pr16'"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_view>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_view
            :loaded_at_once="false"
            :loaded_at_once="container.props.show_view"
            :title="container.props.config.element_diagrams.process_pr17_pr18[0].menu.title"
            :url=url
            :parameters="'{{$pa_ids}},process_pr17_pr18'"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_view>
    </div>
</div>
