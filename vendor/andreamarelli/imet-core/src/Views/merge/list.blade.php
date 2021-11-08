<?php

use \AndreaMarelli\ImetCore\Models\Imet\v1;
use \AndreaMarelli\ImetCore\Models\Imet\v2;

/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet|\AndreaMarelli\ImetCore\Models\Imet\v2\Imet $primary_form */
/** @var array $duplicated_forms */


if($primary_form->version==='v1'){
    $all_modules = \AndreaMarelli\ModularForms\Helpers\Module::getModulesList([
        v1\Imet::$modules,
        v1\Imet_Eval::$modules,
    ]);
    $imet_class = v1\Imet::class;
} elseif($primary_form->version==='v2'){
    $all_modules = \AndreaMarelli\ModularForms\Helpers\Module::getModulesList([
        v2\Imet::$modules,
        v2\Imet_Eval::$modules,
    ]);
    $imet_class = v2\Imet::class;
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')

    <h1>@lang('imet-core::common.merge_tool')</h1>

    <div class="entity-heading">
        <div class="name">{{ $primary_form->Name }}</div>
        <div class="location">{!! \AndreaMarelli\ImetCore\Helpers\Template::flag_and_name($primary_form->Country) !!}</div>
    </div>

    <table id="merge_table" class="striped">
        <thead>
            <tr>
                <th style="vertical-align: top;">
                    IMET #{{ $primary_form->getKey() }}
                    <div style="font-weight: normal; font-style: italic; font-size: 0.8em;">
                        <imet_encoders_responsibles
                            :items='@json(\AndreaMarelli\ImetCore\Models\Imet\Imet::getResponsibles($primary_form->getKey(), $primary_form->version))'
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
                                    :items='@json(\AndreaMarelli\ImetCore\Models\Imet\Imet::getResponsibles($duplicated_form_id, $primary_form->version))'
                            ></imet_encoders_responsibles>
                        </div>

                        {{-- Set as destination form --}}
                        <div style="margin-top: 10px"
                             data-toggle="tooltip"
                             data-placement="top"
                             data-original-title="@lang_u('imet-core::common.set_as_destination_form')">
                            <a href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'merge_view'], [$duplicated_form_id]) }}"
                               class="btn-nav small yellow"
                            >{!! AndreaMarelli\ModularForms\Helpers\Template::icon('thumbtack', 'white') !!} @lang_u('imet-core::common.destination_form')
                            </a>
                        </div>

                        {{-- Delete --}}
                        <div style="margin-top: 5px">
                            @include('modular-forms::buttons.delete', [
                                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                                'item' => $duplicated_form_id,
                                'label' => ucfirst(trans('modular-forms::common.delete'))
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
                            $module_primary_orig = unserialize(serialize($module_primary));
                        @endphp
                        @if(!$module_primary->isEmpty())
                            @include('imet-core::merge.view_module', ['module' => $module_primary, 'formID' => $primary_form->getKey(), 'module_class' => $module_class ])
                        @else
                            <small><i>@lang('modular-forms::common.no_data')</i></small>
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
                                     <b class="highlight">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('check-circle') !!}  @lang('modular-forms::common.no_differences')</b>
                                @else
                                    @include('imet-core::merge.view_module', ['module' => $module, 'formID' => $duplicated_form_id, 'module_class' => $module_class ])
                                    @include('imet-core::merge.confirm_merge', ['source' => $imet_class::find($duplicated_form_id), 'destination' => $primary_form, 'module' => $module_class ])
                                @endif
                            @else
                                <small><i>@lang('modular-forms::common.no_data')</i></small>
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
