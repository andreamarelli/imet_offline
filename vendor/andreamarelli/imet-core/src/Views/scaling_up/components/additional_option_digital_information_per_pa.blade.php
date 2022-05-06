<container_section :id="'{{$name}}'" :title="'{{$title}}'" :code="'{{$code}}'"
                   :guidance="'imet-core::analysis_report.guidance.additional_options.main'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container_view
                        :loaded_at_once="true"
                        :title="'{{trans('imet-core::analysis_report.additional_options.management_effectiveness_analysis')}}'"
                        :guidance="'imet-core::analysis_report.guidance.additional_options.management_effectiveness'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.management_effectiveness_analysis', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="true"
                        :title="'{{trans('imet-core::analysis_report.additional_options.summary_key_elements_affecting_management_elements')}}'"
                        :guidance="'imet-core::analysis_report.guidance.additional_options.specific_actions_mention'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.specific_actions_mention', ['name' => $name])
                        </template>
                    </container_view>
                </div>
            </div>
        </div>
    </template>
</container_section>
