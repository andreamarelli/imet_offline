<?php

use \AndreaMarelli\ImetCore\Controllers;
use \AndreaMarelli\ImetCore\Models\Imet;
use \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet;
use \AndreaMarelli\ModularForms\Helpers\Template;
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Http\Request;

/** @var Controllers\Imet\Controller|Controllers\Imet\oecm\Controller $controller */
/** @var Collection $list */
/** @var Request $request */
/** @var array $countries */
/** @var array $years */
/** @var boolean $filter_selected */

if($controller === Controllers\Imet\oecm\Controller::class){
    $form_class = Imet\oecm\Imet::class;
    $route_prefix = Controllers\Imet\oecm\Controller::ROUTE_PREFIX;
    $scaling_up_enable = false;
    $create_title_prefix = 'imet-core::oecm_context.';
} else {
    $form_class = Imet\Imet::class;
    $route_prefix = Controllers\Imet\v2\Controller::ROUTE_PREFIX;
    $scaling_up_enable = true;
    $create_title_prefix = 'imet-core::common.';
}

?>

@extends('modular-forms::page.list', [
    'controller' => $controller,
    'request'=> $request,
    'list'=> $list,
])


<!-- functional-buttons -->
@section('functional-buttons')

    @can('edit', $form_class)
        {{-- Create new IMET --}}
        <a class="btn-nav rounded"
           href="{{ route($route_prefix.'create') }}">
            {!! Template::icon('plus-circle', 'white') !!}
            {{ ucfirst(trans($create_title_prefix.'Create.title')) }}
        </a>
        <a class="btn-nav rounded"
           href="{{ route($route_prefix.'create_non_wdpa') }}">
            {!! Template::icon('plus-circle', 'white') !!}
            {{ ucfirst(trans($create_title_prefix.'CreateNonWdpa.title')) }}
        </a>
        {{-- Import json IMETs --}}
        <a class="btn-nav rounded"
           href="{{ route($route_prefix.'import') }}">
            {!! Template::icon('file-import', 'white') !!}
            {{ ucfirst(trans('modular-forms::common.import')) }}
        </a>
        @if($scaling_up_enable)
            &nbsp;&nbsp;
            &nbsp;&nbsp;
            {{-- Scaling Up --}}
            <a class="btn-nav rounded"
               href="{{ route('imet-core::scaling_up_index') }}">
                {!! Template::icon('chart-bar', 'white') !!}
                {{ ucfirst(trans('imet-core::analysis_report.scaling_up')) }}
            </a>
        @endif

    @endcan

    @can('exportAll', $form_class)
        &nbsp;&nbsp;
        &nbsp;&nbsp;
        {{-- Export json IMETs --}}
        <a class="btn-nav rounded"
           href="{{ route($route_prefix.'export_view') }}">
            {!! Template::icon('file-export', 'white') !!}
{{--            {{ ucfirst(trans('modular-forms::common.export')) }}--}}
        </a>
    @endcan

@endsection

<!-- filters -->
@section('filters')
    @include('imet-core::components.common_filters', [
        'request' => $request,
        'countries' => $countries,
        'years' => $years
    ])
@endsection

<!-- list header -->
@section('list-header')
    <th class="text-center width60px">@lang('imet-core::common.id')</th>
    <th class="text-left width90px">@lang('imet-core::common.year')</th>
    <th class="text-left">@choice('imet-core::common.protected_area.protected_area', 1)</th>
    <th class="text-center">@lang('imet-core::common.encoders_responsible')</th>
    <th>{{-- radar --}}</th>
    <th class="width200px">{{-- actions --}}</th>
@endsection


<!-- list body -->
@section('list-body')
    @foreach ($list as $item)
        <tr>
            <td class="align-baseline text-center">#{{ $item->FormID }}</td>
            <td class="align-baseline text-center"><strong>{{ $item->Year }}</strong></td>
            <td class="align-baseline">

                    <div class="imet_name">
                        <div class="imet_pa_name">
                            {{-- name --}}
                            <strong style="font-size: 1.1em;">{{ $item->name }}</strong>
                            {{-- wdpa_id --}}
                            @if($item->wdpa_id!==null)
                                (<a target="_blank" href="{{ ProtectedPlanet::WEBSITE_URL }}{{ $item->wdpa_id }}">{{ $item->wdpa_id }}</a>)
                            @endif
                            <br/>
                            {{-- country --}}
                            <flag iso2=>{{ $item->country->iso2 }}></flag>&nbsp;&nbsp;<i>{{ $item->country->name }}</i>
                        </div>
                        <br/>
                        {{-- language --}}
                        <div>
                            {{ ucfirst(trans('imet-core::common.encoding_language')) }}:
                            <flag iso2=>{{ $item->language }}></flag>
                        </div>
                        {{-- version --}}
                        <div>
                            {{ ucfirst(trans('imet-core::common.version')) }}:
                            @if($item->version===Imet\Imet::IMET_V2)
                                <span class="badge badge-success">v2</span>
                            @elseif($item->version===Imet\Imet::IMET_V1)
                                <span class="badge badge-secondary">v1</span>
                            @elseif($item->version===Imet\Imet::IMET_OECM)
                                <span class="badge badge-info">OECM</span>
                            @endif
                        </div>
                        {{-- last update --}}
                        <div>
                            @uclang('modular-forms::entities.common.last_update'):&nbsp;
                            <b><i>{{ $item->last_update['date'] }}</i></b>
                        </div>
                    </div>
                </td>
                <td class="align-baseline">
                    <imet_encoders_responsibles :items='@json($item->encoders_responsibles)'></imet_encoders_responsibles>
                </td>
                <td>
                    <imet_radar
                            style="margin: 0 auto;"
                            :width=150 :height=150
                            :values='@json($item->assessment_radar)'
                    ></imet_radar>
            </td>
            <td class="text-center">

                {{-- Show --}}
                @include('imet-core::components.buttons.show', ['version' => $item->version])

                @can('edit', $form_class)

                    {{-- Edit --}}
                    @include('imet-core::components.buttons.edit', ['version' => $item->version])

                    {{-- Merge tool --}}
                    @if($item->has_duplicates)
                        @include('imet-core::components.buttons.merge', ['version' => $item->version])
                    @endif

                @endcan

                {{-- Export --}}
                @can('export_button', $form_class)
                    @include('imet-core::components.buttons.export', ['version' => $item->version])
                @endcan

                {{-- Print --}}
                @include('imet-core::components.buttons.print', ['version' => $item->version])

                {{-- Delete --}}
                @can('edit', $form_class)
                    @include('imet-core::components.buttons.delete', [
                       'item' => $item,
                       'version' => $item->version
                    ])
                @endcan

            </td>
        </tr>
    @endforeach
@endsection

<!-- scripts -->
@section('scripts')
    <script type="module">
        (new window.ImetCore.Apps.FormList())
            .mount('#page-container');
    </script>
@endsection