<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Model|String $item */
/** @var String $label */

if($item instanceof \Illuminate\Database\Eloquent\Model){
    $modal_id = 'id="delete_modal_'. $item->getKey().'"';
    $modal_target = 'data-target="#delete_modal_'. $item->getKey().'"';
    $action = 'action="'.action([$controller, 'destroy'], [$item->getKey()]).'"';
} else {
    $vue_item = $item ?? 'item.id';
    $modal_id = ':id="\'delete_modal_\' + ' . $vue_item . '"';
    $modal_target = ':data-target="\'#delete_modal_\' + ' . $vue_item . '"';
    $action = ':action="\'' . vueAction($controller, 'destroy', $vue_item) . '\'"';
}
$label = $label ?? null;
?>

{{-- Delete modal anchor --}}
<div style="display: inline-block;"
     data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst(trans('common.delete')) }}">
    <button type="submit"
            class="btn btn-danger btn-sm"
            data-toggle="modal" {!! $modal_target !!}>
        {!! App\Library\Utils\Template::icon('trash', 'white') !!}
        {{ $label }}
    </button>
</div>

{{-- Delete modal --}}
<div {!! $modal_id !!} class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <strong>@lang('common.confirm_deletion')</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ ucfirst(trans('common.close')) }}</button>
                <form style="display: inline-block" method="post" {!! $action !!}>
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        {!! App\Library\Utils\Template::icon('trash', 'white') !!}
                        {{ ucfirst(trans('common.delete')) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>