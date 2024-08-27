<container_actions :data="{}" :name="'{{$name}}'"
                   :comment_title="container.props.stores.BaseStore.localization(`imet-core::analysis_report.comment_entire_section`)"
                   :event_image="'save_entire_block_as_image'"
                   :exclude_elements="'{{$exclude_elements}}'">
    <template slot-scope="data">
        <div class="grid gap-y-2" style="grid-template-columns: 20% 80%; ">

            <h5>@lang('imet-core::analysis_report.governance_management')</h5>
            <editor></editor>

            <h5>@lang('imet-core::analysis_report.key_conservation_elements')</h5>
            <editor></editor>

            <h5>@lang('imet-core::analysis_report.climate_change_ecosystem')</h5>
            <editor></editor>

            <h5>@lang('imet-core::v2_common.steps.threats')</h5>
            <editor></editor>

        </div>
    </template>
</container_actions>
