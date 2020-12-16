<?php

use \App\Models\Imet\v1;
use \App\Models\Imet\v2;

/** @var \App\Models\Imet\v1\Imet|\App\Models\Imet\v2\Imet $primary_form */
/** @var array $duplicated_forms */


if($primary_form->version==='v1'){
    $all_modules = \App\Library\Ofac\Module::getModulesList([
        v1\Imet::$modules,
        v1\Imet_Eval::$modules,
    ]);
    $imet_class = v1\Imet::class;
} elseif($primary_form->version==='v2'){
    $all_modules = \App\Library\Ofac\Module::getModulesList([
        v2\Imet::$modules,
        v2\Imet_Eval::$modules,
    ]);
    $imet_class = v2\Imet::class;
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
        action([\App\Http\Controllers\Imet\ImetController::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
    @section('admin_page_title')
        @lang('form/imet/common.imet')
    @endsection
@endif

@section('content')

    <h1>@lang('form/imet/common.merge_tool')</h1>

    <div class="entity-heading">
        <div class="name">{{ $primary_form->Name }}</div>
        <div class="location">{!! \App\Library\Ofac\Template::flag_and_name($primary_form->Country) !!}</div>
    </div>

    <table id="merge_table" class="striped">
        <thead>
            <tr>
                <th style="vertical-align: top;">
                    IMET #{{ $primary_form->getKey() }}
                    <div style="font-weight: normal; font-style: italic; font-size: 0.8em;">
                        <imet_encoders_responsibles
                            :items='@json(\App\Models\Imet\Imet::getResponsibles($primary_form->getKey(), $primary_form->version))'
                        ></imet_encoders_responsibles>
                    </div>
                </th>
                <th>
                    <i class="fas fa-arrow-alt-circle-left fa-2x"></i>
                </th>
                @foreach($duplicated_forms as $duplicated_form_id)
                    <th style="vertical-align: top;">
                        <div>IMET #{{ $duplicated_form_id }}</div>

                        <div style="font-weight: normal; font-style: italic; font-size: 0.8em;">
                            <imet_encoders_responsibles
                                    :items='@json(\App\Models\Imet\Imet::getResponsibles($duplicated_form_id, $primary_form->version))'
                            ></imet_encoders_responsibles>
                        </div>

                        {{-- Set as destination form --}}
                        <div style="margin-top: 10px"
                             data-toggle="tooltip"
                             data-placement="top"
                             data-original-title="{{ ucfirst(trans('form/imet/common.set_as_destination_form')) }}">
                            <a href="{{ action([\App\Http\Controllers\Imet\ImetController::class, 'merge_view'], [$duplicated_form_id]) }}"
                               class="btn btn-warning btn-sm"
                            >{!! App\Library\Utils\Template::icon('thumbtack', 'white') !!} {{ ucfirst(trans('form/imet/common.destination_form')) }}
                            </a>
                        </div>

                        {{-- Delete --}}
                        <div style="margin-top: 5px">
                            @include('admin.components.buttons.delete', [
                                'controller' => \App\Http\Controllers\Imet\ImetController::class,
                                'item' => $duplicated_form_id,
                                'label' => ucfirst(trans('common.delete'))
                            ])
                        </div>

                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($all_modules as $module_class)
                <tr>
                    <td class="text-center">
                        @php
                            $module_primary = $module_class::getModule($primary_form->getKey());
                            // following needed in order to keep upload field null in case of empty and correctly compare it in areIdentical()
                            $module_primary_orig = unserialize(serialize($module_primary))
                        @endphp
                        @if(!$module_primary->isEmpty())
                            @include('admin.imet.merge.view_module', ['module' => $module_primary, 'formID' => $primary_form->getKey(), 'module_class' => $module_class ])
                        @else
                            <small><i>@lang('common.no_data')</i></small>
                        @endif
                    </td>
                    <td style="max-width: 300px;">
                        <b>{{ (new $module_class())->module_code }}</b> - {{ (new $module_class())->module_title }}
                    </td>
                    @foreach($duplicated_forms as $duplicated_form_id)

                        <td class="text-center">
                            @php
                                $module = $module_class::getModule($duplicated_form_id);
                            @endphp
                            @if(!$module->isEmpty())
                                @if($module_class::areIdentical($module, $module_primary_orig))
                                     <b class="green">{!! App\Library\Utils\Template::icon('check-circle') !!}  @lang('common.no_differences')</b>
                                @else
                                    @include('admin.imet.merge.view_module', ['module' => $module, 'formID' => $duplicated_form_id, 'module_class' => $module_class ])
                                    @include('admin.imet.merge.confirm_merge', ['source' => $imet_class::find($duplicated_form_id), 'destination' => $primary_form, 'module' => $module_class ])
                                @endif
                            @else
                                <small><i>@lang('common.no_data')</i></small>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        new Vue({
            el: '#merge_table',
        });
    </script>

@endsection
