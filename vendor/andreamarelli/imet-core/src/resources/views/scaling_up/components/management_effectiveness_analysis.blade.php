<container_actions :data="{}" :name="'management_effectiveness'"
                   :comment_title="'{{trans('imet-core::analysis_report.comment_entire_section')}}'"
                   :event_image="'save_entire_block_as_image'"
                   :exclude_elements="'{{$exclude_elements}}'">
    <template v-slot:default="data">
        <div class="grid gap-y-2" style="grid-template-columns: 20% 80%; ">

            <h5>@lang('imet-core::common.steps_eval.context')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::common.steps_eval.planning')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::common.steps_eval.inputs')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::common.steps_eval.process')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::common.steps_eval.outputs')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::common.steps_eval.outcomes')</h5>
            <text_editor></text_editor>

            <h5>@lang('imet-core::analysis_report.conclusions')</h5>
            <text_editor></text_editor>
        </div>

    </template>
</container_actions>


