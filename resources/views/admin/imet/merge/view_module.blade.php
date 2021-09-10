<?php
/** @var integer $formID */
/** @var \App\Models\Imet\v1\Modules\Component\ImetModule|\App\Models\Imet\v2\Modules\Component\ImetModule $module */
/** @var \App\Models\Imet\v1\Modules\Component\ImetModule|\App\Models\Imet\v2\Modules\Component\ImetModule $module_class as String */

$modal_id = 'imet_'.$formID.'_'.$module_class::getShortClassName();
?>

<div style="display: inline-block;"
     data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst(trans('common.show')) }}">
    <button type="button"
            class="btn btn-primary btn-sm"
            data-toggle="modal" data-target="#{{ $modal_id }}">
        {!! App\Library\Utils\Template::icon('eye', 'white') !!}
    </button>
</div>

<div id="{{ $modal_id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title" style="font-size: 1.2em;">IMET #{{ $formID }}</b>
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times black"></i></button>
                <b style="font-size: 1.2em;">IMET #{{ $formID }}</b>
            </div>
            <div class="modal-body">
                @include('admin.components.module.preview.container', [
                   'module_class' => $module_class,
                   'collection' => $module,
                   'form_id' => $formID])
            </div>
        </div>
    </div>
</div>
