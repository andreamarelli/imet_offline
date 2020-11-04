<?php
/** @var Mixed $definitions */

?>

@if(array_key_exists('enable_preload', $definitions) && $definitions['enable_preload']===true)

    {{-- Preload modal anchor --}}
    <div style="display: inline-block;"
         data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst(trans('common.form.previous_years')) }}">
        <button type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal" data-target="#preload_modal__{!! $definitions['module_key'] !!}">
            {{ ucfirst(trans('common.form.previous_years')) }}
        </button>
    </div>

    {{-- Preload modal --}}
    <div id="preload_modal__{!! $definitions['module_key'] !!}" class="modal fade module-preload_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        {{ ucfirst(trans('common.form.preload')) }}
                        <br />
                        <b>{{ $definitions['module_code'] }} - {{ $definitions['module_title'] }}</b>
                    </div>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times black"></i></button>
                </div>
                <div class="modal-body text-center">
                    <div class="preload_container"></div>
                </div>
            </div>
        </div>
    </div>

@endif