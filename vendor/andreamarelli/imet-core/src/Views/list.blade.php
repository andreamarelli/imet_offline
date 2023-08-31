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
} else {
    $form_class = Imet\Imet::class;
    $route_prefix = Controllers\Imet\v2\Controller::ROUTE_PREFIX;
    $scaling_up_enable = true;
}

?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    <div class="functional_buttons">

        @can('edit', $form_class)
            {{-- Create new IMET --}}
            <a class="btn-nav rounded"
               href="{{ route($route_prefix.'create') }}">
                {!! Template::icon('plus-circle', 'white') !!}
                {{ ucfirst(trans('imet-core::common.Create.title')) }}
            </a>
            <a class="btn-nav rounded"
               href="{{ route($route_prefix.'create_non_wdpa') }}">
                {!! Template::icon('plus-circle', 'white') !!}
                {{ ucfirst(trans('imet-core::common.CreateNonWdpa.title')) }}
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
                {{ ucfirst(trans('modular-forms::common.export')) }}
            </a>
        @endcan

    </div>


    @include('imet-core::components.common_filters', [
        'request' => $request,
        'url' => $index_url,
        'filter_selected' => $filter_selected,
        'countries' => $countries,
        'years' => $years
    ])

    <br/>
    <div id="sortable_list">

        @include('modular-forms::tables.sort_on_client.num_records')

        <table class="striped">
            <thead>
            <tr>
                <th class="text-center width60px">@lang('imet-core::common.id')</th>
                @include('modular-forms::tables.sort_on_client.th', ['column' => 'Year', 'label' => trans('imet-core::common.year'), 'class' => 'width90px'])
                @include('modular-forms::tables.sort_on_client.th', ['column' => 'name', 'label' => trans_choice('imet-core::common.protected_area.protected_area', 1)])
                <th class="text-center">@lang('imet-core::common.encoders_responsible')</th>
                <th>{{-- radar --}}</th>
                <th class="width200px">{{-- actions --}}</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="item of items">
                <td class="align-baseline text-center">#@{{ item.FormID }}</td>
                <td class="align-baseline text-center"><strong>@{{ item.Year }}</strong></td>
                <td class="align-baseline">

                    <div class="imet_name">
                        <div class="imet_pa_name">
                            {{-- name --}}
                            <strong style="font-size: 1.1em;">@{{ item.name }}</strong>
                            {{-- wdpa_id --}}
                            <span v-if="item.wdpa_id!==null">
                                (<a target="_blank"
                                    :href="'{{ ProtectedPlanet::WEBSITE_URL }}'+ item.wdpa_id">@{{ item.wdpa_id }}</a>)
                            </span>
                            <br/>
                            {{-- country --}}
                            <flag :iso2=item.country.iso2></flag>&nbsp;&nbsp;<i>@{{ item.country.name }}</i>
                        </div>
                        <br/>
                        {{-- language --}}
                        <div>
                            {{ ucfirst(trans('imet-core::common.encoding_language')) }}:
                            <flag :iso2=item.language></flag>
                        </div>
                        {{-- version --}}
                        <div>
                            {{ ucfirst(trans('imet-core::common.version')) }}:
                            <span v-if="item.version==='{{ $form_class::IMET_V2 }}'"
                                  class="badge badge-success">v2</span>
                            <span v-else-if="item.version==='{{ $form_class::IMET_V1 }}'" class="badge badge-secondary">v1</span>
                            <span v-else-if="item.version==='{{ $form_class::IMET_OECM }}'" class="badge badge-info">OECM</span>
                        </div>
                        {{-- last update --}}
                        <div>
                            @uclang('modular-forms::entities.common.last_update'):&nbsp;
                            <b><i>@{{ item.last_update.date }}</i></b>
                        </div>
                    </div>
                </td>
                <td class="align-baseline">
                    <imet_encoders_responsibles
                            :items=item.encoders_responsibles
                    ></imet_encoders_responsibles>
                </td>
                <td>
                    <imet_radar
                            style="margin: 0 auto;"
                            :width=150 :height=150
                            :values=item.assessment_radar
                            v-if="!Object.values(item.assessment_radar).every(elem => elem === null)"
                    ></imet_radar>
                </td>
                <td class="align-baseline text-center" style="white-space: nowrap;">

                    {{-- Show --}}
                    <span v-if="item.version==='{{ $form_class::IMET_V1 }}'">
                        @include('imet-core::components.buttons.show', ['version' => $form_class::IMET_V1])
                    </span>
                    <span v-else-if="item.version==='{{ $form_class::IMET_V2 }}'">
                        @include('imet-core::components.buttons.show', ['version' => $form_class::IMET_V2])
                    </span>
                    <span v-else-if="item.version==='{{ $form_class::IMET_OECM }}'">
                        @include('imet-core::components.buttons.show', ['version' => $form_class::IMET_OECM])
                    </span>

                    @can('edit', $form_class)

                        {{-- Edit --}}
                        <span v-if="item.version==='{{ $form_class::IMET_V1 }}'">
                            @include('imet-core::components.buttons.edit', ['version' => $form_class::IMET_V1])
                        </span>
                        <span v-else-if="item.version==='{{ $form_class::IMET_V2 }}'">
                            @include('imet-core::components.buttons.edit', ['version' => $form_class::IMET_V2])
                        </span>
                        <span v-else-if="item.version==='{{ $form_class::IMET_OECM }}'">
                            @include('imet-core::components.buttons.edit', ['version' => $form_class::IMET_OECM])
                        </span>

                        {{-- Merge tool --}}
                        <span v-if="item.has_duplicates">
                            @include('imet-core::components.buttons.merge', ['form_class' => $form_class])
                        </span>

                        {{-- Export --}}
                        @can('export_button', $form_class)
                            @include('imet-core::components.buttons.export', ['form_class' => $form_class])
                        @endcan

                    @endcan

                    {{-- Print --}}
                    @include('imet-core::components.buttons.print', ['form_class' => $form_class])

                    {{-- Delete --}}
                    @can('edit', $form_class)
                        @include('imet-core::components.buttons.delete', [
                            'form_class' => $form_class
                        ])
                    @endcan

                </td>
            </tr>
            </tbody>

        </table>

    </div>

    @push('scripts')

        <script>

            new window.ModularForms.SortableTable({
                el: '#sortable_list',
                data: {
                    list: @json($list),
                    pageSize: 10
                },

                mounted: function () {
                    this.sort('{{ $form_class::$sortBy }}', '{{ $form_class::$sortDirection }}');
                }

            });
        </script>
    @endpush

@endsection
