<?php
/** @var \App\Models\Imet\v1\Imet|\App\Models\Imet\v2\Imet $source */
/** @var \App\Models\Imet\v1\Imet|\App\Models\Imet\v2\Imet $destination */
/** @var \App\Models\Imet\v1\Modules\Component\ImetModule|\App\Models\Imet\v2\Modules\Component\ImetModule $module */

$modal_id = 'imet_merge_'.$source->FormID.'_to_'.$destination->FormID.'_'.$module::getShortClassName();

?>
<div style="display: inline-block;"
     data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst(trans('common.apply')) }}">
    <button type="button"
            class="btn btn-warning btn-sm"
            data-toggle="modal" data-target="#{{ $modal_id }}">
        {!! App\Library\Utils\Template::icon('arrow-alt-circle-left', 'white', '', 'fa-flip-vertical') !!} {{ ucfirst(trans('common.apply')) }}
    </button>
</div>


<div id="{{ $modal_id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
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
                            <i class="fas fa-arrow-alt-circle-right green_dark fa-3x"></i>
                        </div>
                        <div style="padding: 30px; text-align: center">
                            IMET #{{ $destination->FormID }}
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger" role="alert" style="padding: 10px;">Any existing data will be overwritten!</div>
                <div style="text-align: right">
                    <b>@lang('form/imet/common.confirm_merge')?</b>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        data-dismiss="modal"
                        class="btn btn-danger btn-sm">
                    {!! App\Library\Utils\Template::icon('times-circle', 'white') !!} {{ ucfirst(trans('common.cancel')) }}
                </button>
                <form action="{{ action([\App\Http\Controllers\Imet\ImetController::class, 'merge']) }}" method="POST" style="display: inline;">
                    {{ csrf_field() }}
                    <input type="hidden" name="module" value="{{ $module }}">
                    <input type="hidden" name="source_form" value="{{ $source->FormID }}">
                    <input type="hidden" name="destination_form" value="{{ $destination->FormID }}">
                    <button type="button"
                            class="btn btn-success btn-sm" onclick="this.form.submit();">
                        {!! App\Library\Utils\Template::icon('check-circle', 'white') !!} {{ ucfirst(trans('common.confirm')) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>