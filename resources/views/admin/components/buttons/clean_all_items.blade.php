<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var String $label */

$label = $label ?? trans('common.delete');

?>

{{-- Delete modal anchor --}}
<div style="display: inline-block;"
     data-toggle="tooltip" data-placement="top" data-original-title="@lang('common.delete')">
    <a href="#"
            class="btn-nav rounded"
            data-toggle="modal" data-target="#delete_modal_all">
        {!! App\Library\Utils\Template::icon('trash', 'white') !!}
        @isset($label)
            {!! ucfirst($label) !!}
        @endisset
    </a>
</div>

{{-- Delete modal --}}
<div id="delete_modal_all" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <strong>@lang('common.confirm_deletion')</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ ucfirst(trans('common.close')) }}</button>
                <form style="display: inline-block" method="post" action="{{ action([$controller, 'destroy'], ['all']) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        {!! App\Library\Utils\Template::icon('trash', 'white') !!}
                        @lang('common.delete')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>