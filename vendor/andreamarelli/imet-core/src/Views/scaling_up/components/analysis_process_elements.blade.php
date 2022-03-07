<div class="row">
    <div class="col-12 ml-2">
        <container_analysis_management_cycle
            :title="container.props.config.element_diagrams.process[0].menu.title"
            :url=url
            :guidance="'{{trans('imet-core::analysis_report.guidance.process.overall')}}'"
            :type="'process'"
            :items="{{json_encode($custom_names)}}"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_analysis_management_cycle>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_analysis_management_cycle
            :guidance="'{{trans('imet-core::analysis_report.guidance.process.pr1_pr6')}}'"
            :title="container.props.config.element_diagrams.process_pr1_pr6[0].menu.title"
            :url=url
            :type="'process_pr1_pr6'"
            :items="{{json_encode($custom_names)}}"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_analysis_management_cycle>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_analysis_management_cycle
            :guidance="'{{trans('imet-core::analysis_report.guidance.process.pr7_pr9')}}'"
            :title="container.props.config.element_diagrams.process_pr7_pr9[0].menu.title"
            :url=url
            :type="'process_pr7_pr9'"
            :items="{{json_encode($custom_names)}}"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_analysis_management_cycle>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_analysis_management_cycle
            :guidance="'{{trans('imet-core::analysis_report.guidance.process.pr10_pr12')}}'"
            :title="container.props.config.element_diagrams.process_pr10_pr12[0].menu.title"
            :url=url
            :type="'process_pr10_pr12'"
            :items="{{json_encode($custom_names)}}"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_analysis_management_cycle>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_analysis_management_cycle
            :guidance="'{{trans('imet-core::analysis_report.guidance.process.pr13_pr14')}}'"
            :title="container.props.config.element_diagrams.process_pr13_pr14[0].menu.title"
            :url=url
            :type="'process_pr13_pr14'"
            :items="{{json_encode($custom_names)}}"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_analysis_management_cycle>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_analysis_management_cycle
            :guidance="'{{trans('imet-core::analysis_report.guidance.process.pr15_pr16')}}'"
            :title="container.props.config.element_diagrams.process_pr15_pr16[0].menu.title"
            :url=url
            :type="'process_pr15_pr16'"
            :items="{{json_encode($custom_names)}}"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_analysis_management_cycle>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-2">
        <container_analysis_management_cycle
            :guidance="'{{trans('imet-core::analysis_report.guidance.process.pr17_pr18')}}'"
            :title="container.props.config.element_diagrams.process_pr17_pr18[0].menu.title"
            :url=url
            :type="'process_pr17_pr18'"
            :items="{{json_encode($custom_names)}}"
            :func="'analysis_per_element_of_the_management_cycle'">
            <template slot-scope="data" class="col-24">
                @include('imet-core::scaling_up.components.analysis_element', ['name' => $name, 'dontShowTitle' => true])
            </template>
        </container_analysis_management_cycle>
    </div>
</div>
