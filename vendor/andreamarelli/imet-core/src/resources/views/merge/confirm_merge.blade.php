<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet|\AndreaMarelli\ImetCore\Models\Imet\v2\Imet $source */
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet|\AndreaMarelli\ImetCore\Models\Imet\v2\Imet $destination */
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Component\ImetModule|\AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule $module */
/** @var string $route */

$modal_id = 'imet_merge_'.$source->FormID.'_to_'.$destination->FormID.'_'.$module::getShortClassName();

?>


<floating_dialog>

    <!-- anchor -->
    <template slot="dialog-anchor">
        <button type="button" class="btn-nav small yellow">
            {!! AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-alt-circle-left', 'white', '', 'fa-flip-vertical') !!}
            @uclang('modular-forms::common.apply')
        </button>
        <tooltip>@uclang('modular-forms::common.apply')</tooltip>
    </template>

    <!-- dialog -->
    <template slot="dialog-content">
        <div class="with_header_and_footer">

            <!-- dialog body -->
            <div class="body text-center">
                <div style="padding: 5px 5px 15px 5px;">
                    <div style="text-align: center">
                        <i>{{ (new $module())->module_code }}</i>
                        <br />
                        <b style="font-size: 1.2em;">
                            {{ (new $module())->module_title }}
                        </b>
                    </div>
                    <div style="display: flex; justify-content: space-evenly; font-size: 1.2em;">
                        <div style="padding: 30px; text-align: center">
                            IMET #{{ $source->FormID }}
                        </div>
                        <div style="padding: 20px; text-align: center">
                            <i class="fas fa-arrow-alt-circle-right primary-800 fa-3x"></i>
                        </div>
                        <div style="padding: 30px; text-align: center">
                            IMET #{{ $destination->FormID }}
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger" role="alert" style="padding: 10px;">Any existing data will be overwritten!</div>
            </div>

            <!-- dialog footer -->
            <div class="footer">
                <div class="text-right font-bold">@lang('imet-core::common.confirm_merge')?</div>
                <button type="button"
                        data-dismiss="modal"
                        class="btn-nav small red btn-sm">
                    {!! AndreaMarelli\ModularForms\Helpers\Template::icon('times-circle', 'white') !!} @uclang('modular-forms::common.cancel')
                </button>
                <form action="{{ route($route) }}" method="POST" style="display: inline;">
                    {{ csrf_field() }}
                    <input type="hidden" name="module" value="{{ $module }}">
                    <input type="hidden" name="source_form" value="{{ $source->FormID }}">
                    <input type="hidden" name="destination_form" value="{{ $destination->FormID }}">
                    <button type="button"
                            class="btn-nav small" onclick="this.form.submit();">
                        {!! AndreaMarelli\ModularForms\Helpers\Template::icon('check-circle', 'white') !!} @uclang('modular-forms::common.confirm')
                    </button>
                </form>
            </div>

        </div>
    </template>

</floating_dialog>



