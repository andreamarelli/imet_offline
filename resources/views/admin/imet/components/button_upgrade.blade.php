<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Model|String $item */
/** @var String $label */

$vue_item = $item;
$modal_id = ':id="\'upgrade_modal_\' + ' . $vue_item . '"';
$modal_target = ':data-target="\'#upgrade_modal_\' + ' . $vue_item . '"';
$action = ':action="\'' . vueAction($controller, 'upgrade', $vue_item) . '\'"';

$label = $label ?? null;
?>

{{-- Delete modal anchor --}}
<div style="display: inline-block;"
     data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst(trans('form/imet/common.upgrade')) }}">
    <button type="submit"
            class="btn btn-primary btn-sm"
            data-toggle="modal" {!! $modal_target !!}>
        {!! App\Library\Utils\Template::icon('arrow-alt-circle-up', 'white') !!}
        {{ $label }}
    </button>
</div>

{{-- Delete modal --}}
<div {!! $modal_id !!} class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <strong>{!! ucfirst(trans('form/imet/common.upgrade_confirm')) !!}</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ ucfirst(trans('common.close')) }}</button>
                <form style="display: inline-block" method="post" {!! $action !!}>
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {!! App\Library\Utils\Template::icon('arrow-alt-circle-up', 'white') !!}
                        {{ ucfirst(trans('form/imet/common.upgrade')) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>