<container_actions :data="{}" :name="'specific_actions_mention'"
                   :comment_title="'{{trans('imet-core::analysis_report.comment_entire_section')}}'"
                   :event_image="'save_entire_block_as_image'"
                   :exclude_elements="'{{$exclude_elements}}'">
    <template v-slot:default="data">
        <div class="grid gap-y-2" style="grid-template-columns: 20% 80%; ">

            <h5>@lang('imet-core::analysis_report.governance_management')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::analysis_report.key_conservation_elements')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::analysis_report.climate_change_ecosystem')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::v2_common.steps.threats')</h5>
            <text_editor></text_editor>

        </div>
    </template>
</container_actions>
