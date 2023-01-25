<?php
/** @var \AndreaMarelli\ImetCore\Controllers\Imet\Controller $controller */

/** @var \Illuminate\Database\Eloquent\Collection $list */
/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var array $years */

/** @var boolean $filter_selected */

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use Illuminate\Support\Facades\URL;

$url = URL::route('imet-core::index');
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['links' => [
        route('imet-core::index') => trans('imet-core::common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
    @section('admin_page_title')
        @lang('imet-core::common.imet')
    @endsection
@endif

@section('content')

    <div class="functional_buttons">

        @can('edit', Imet::class)
            {{-- Create new IMET --}}
            @include('modular-forms::buttons.create', [
                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller::class,
                'label' => trans('imet-core::v2_context.Create.title')
            ])
            <a class="btn-nav rounded"
               href="{{ route('imet-core::create_non_wdpa') }}">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('plus-circle', 'white') !!}
                {{ ucfirst(trans('imet-core::v2_context.CreateNonWdpa.title')) }}
            </a>
            {{-- Import json IMETs --}}
            <a class="btn-nav rounded"
               href="{{ route('imet-core::import') }}">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('file-import', 'white') !!}
                {{ ucfirst(trans('modular-forms::common.import')) }}
            </a>
            &nbsp;&nbsp;
            &nbsp;&nbsp;
            {{-- Scaling Up --}}
            <a class="btn-nav rounded"
               href="{{ route('imet-core::scaling_up_index') }}">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('chart-bar', 'white') !!}
                {{ ucfirst(trans('imet-core::analysis_report.scaling_up')) }}
            </a>

        @endcan

        @can('exportAll', Imet::class)
            &nbsp;&nbsp;
            &nbsp;&nbsp;
            {{-- Export json IMETs --}}
            <a class="btn-nav rounded"
               href="{{ route('imet-core::export_view') }}">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('file-export', 'white') !!}
                {{ ucfirst(trans('modular-forms::common.export')) }}
            </a>
        @endcan

        </div>


    @include('imet-core::components.common_filters', [
        'request'=>$request,
        'url' => $url,
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
                                    :href="'{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL }}'+ item.wdpa_id">@{{ item.wdpa_id }}</a>)
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
                            <span v-if="item.version==='{{ Imet::IMET_V2 }}'" class="badge badge-success">v2</span>
                            <span v-else-if="item.version==='{{ Imet::IMET_V1 }}'" class="badge badge-secondary">v1</span>
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
                    <span v-if="item.version==='{{ Imet::IMET_V1 }}'">
                        @include('imet-core::components.button_show', ['version' => Imet::IMET_V1])
                    </span>
                    <span v-else-if="item.version==='{{ Imet::IMET_V2 }}'">
                        @include('imet-core::components.button_show', ['version' => Imet::IMET_V2])
                    </span>

                    @can('edit', Imet::class)

                        {{-- Edit --}}
                        <span v-if="item.version==='{{ Imet::IMET_V1 }}'">
                            @include('imet-core::components.button_edit', ['version' => Imet::IMET_V1])
                        </span>
                        <span v-else-if="item.version==='{{ Imet::IMET_V2 }}'">
                            @include('imet-core::components.button_edit', ['version' => Imet::IMET_V2])
                        </span>

                        {{-- Merge tool --}}
                        <span v-if="item.has_duplicates">
                            @include('modular-forms::buttons._generic', [
                                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                                'action' =>'merge_view',
                                'item' => 'item.FormID',
                                'tooltip' => ucfirst(trans('modular-forms::common.merge')),
                                'icon' => 'clone',
                                'class' => 'btn-primary'
                            ])
                        </span>

                    @endcan

                    {{-- Export --}}
                    @can('export_button', Imet::class)
                        @include('modular-forms::buttons._generic', [
                            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                            'action' =>'export',
                            'item' => 'item.FormID',
                            'tooltip' => ucfirst(trans('modular-forms::common.export')),
                            'icon' => 'cloud-download-alt',
                            'class' => 'btn-primary'
                        ])
                    @endcan

                    {{-- Print --}}

                    <span v-if="item.version==='{{ Imet::IMET_V1 }}'">
                        @include('modular-forms::buttons._generic', [
                            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::class,
                            'action' =>'print',
                            'item' => 'item.FormID',
                            'tooltip' => ucfirst(trans('modular-forms::common.print')),
                            'icon' => 'print',
                            'class' => 'btn-primary'
                        ])
                    </span>
                    <span v-else-if="item.version==='{{ Imet::IMET_V2 }}'">
                        @include('modular-forms::buttons._generic', [
                            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller::class,
                            'action' =>'print',
                            'item' => 'item.FormID',
                            'tooltip' => ucfirst(trans('modular-forms::common.print')),
                            'icon' => 'print',
                            'class' => 'btn-primary'
                        ])
                    </span>

                    @can('edit', Imet::class)

                        {{-- Delete --}}
                        @include('modular-forms::buttons.delete', [
                            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                            'item' => 'item.FormID'
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
                    this.sort('{{ \AndreaMarelli\ImetCore\Models\Imet\Imet::$sortBy }}', '{{ \AndreaMarelli\ImetCore\Models\Imet\Imet::$sortDirection }}');
                }

            });
        </script>
    @endpush

@endsection
