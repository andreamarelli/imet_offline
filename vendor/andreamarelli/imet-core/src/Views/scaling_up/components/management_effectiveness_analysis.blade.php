<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <container_actions :data="{}" :name="'{{$name}}'"
                           :comment_title="container.props.stores.BaseStore.localization(`imet-core::analysis_report.comment_entire_section`)"
                           :event_image="'save_entire_block_as_image'"
                           :exclude_elements="'{{$exclude_elements}}'">
            <template slot-scope="data">
                <div class="row">
                    <div class="col-sm">
                        <div class="align-items-center">
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::v2_common.steps_eval.context')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::v2_common.steps_eval.planning')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::v2_common.steps_eval.inputs')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::v2_common.steps_eval.process')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::v2_common.steps_eval.outputs')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::v2_common.steps_eval.outcomes')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::analysis_report.conclusions')</h5>
                                    <editor></editor>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </template>
        </container_actions>
    </template>
</container_section>

