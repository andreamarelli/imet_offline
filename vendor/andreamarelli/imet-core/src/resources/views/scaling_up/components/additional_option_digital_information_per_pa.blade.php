<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :info_label="'imet-core::analysis_report.guidance.additional_options.main'">
    <template v-slot:default="container">
        <container_view
            :loaded_at_once="true"
            :title="'{{trans('imet-core::analysis_report.additional_options.management_effectiveness_analysis')}}'"
            :info_label="'imet-core::analysis_report.guidance.additional_options.management_effectiveness'">
            <template v-slot:default="data">
                @include('imet-core::scaling_up.components.management_effectiveness_analysis', ['name' => $name])
            </template>
        </container_view>
        <container_view
            :loaded_at_once="true"
            :title="'{{trans('imet-core::analysis_report.additional_options.summary_key_elements_affecting_management_elements')}}'"
            :info_label="'imet-core::analysis_report.guidance.additional_options.specific_actions_mention'">
            <template v-slot:default="data">
                @include('imet-core::scaling_up.components.specific_actions_mention', ['name' => $name])
            </template>
        </container_view>
    </template>
</container_section>
