<?php
/** @var \App\Http\Controllers\Imet\ImetController $controller */
/** @var \Illuminate\Database\Eloquent\Collection $list */
/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var boolean $show_filters */
/** @var boolean $no_filter_selected */

$can_encode = \App\Models\User::isAdmin(Auth::user()) || \App\Models\Role\RoleImet::isEncoder(Auth::user());

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
        action([\App\Http\Controllers\Imet\ImetController::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@if(!App::environment('imetoffline'))
    @section('admin_page_title')
        @lang('form/imet/common.imet')
    @endsection
@endif

@section('content')

    @if($can_encode)

        @component('admin.components.functional_buttons')
            @slot('buttons')
                {{-- Import json IMETs --}}
                <a class="btn-nav rounded" href="{{ action([\App\Http\Controllers\Imet\ImetController::class, 'import']) }}">
                    {!! App\Library\Utils\Template::icon('file-import', 'white') !!}
                    {{ ucfirst(trans('common.import')) }}
                </a>
                {{-- Create new IMET --}}
                @include('admin.components.buttons.create', ['controller' => \App\Http\Controllers\Imet\ImetControllerV2::class, 'label' => trans('form/imet/common.create')])
            @endslot
        @endcomponent

    @endif

    @if($show_filters)
        @component('admin.components.filters', ['url'=>'admin/imet', 'request'=>$request, 'method'=>'POST', 'expanded'=>$no_filter_selected])
            @slot('filter_content')

                {!! \App\Library\Ofac\Input\Input::label('search', trans('common.search')) !!}
                {!! \App\Library\Ofac\Input\Input::text('search', $request->input('search')) !!}

                {!! \App\Library\Ofac\Input\Input::label('country', trans('entities.common.country')) !!}
                {!! \App\Library\Ofac\Input\DropDown::simple('country', $request->input('country'), $countries) !!}

                {!! \App\Library\Ofac\Input\Input::label('year', trans('entities.common.year')) !!}
                {!! \App\Library\Ofac\Input\DropDown::simple('year', $request->input('year'), $years) !!}

            @endslot
        @endcomponent
    @endif

    <br />
    <div id="sortable_list">

        @if(!$show_filters || !$no_filter_selected)

            @include('admin.components.table.sort_on_client.num_records')

            <table class="striped">
                <thead>
                <tr>
                    <th class="text-center width60px">@lang('entities.common.id')</th>
                    @include('admin.components.table.sort_on_client.th', ['column' => 'Year', 'label' => trans('entities.common.year'), 'class' => 'width90px'])
                    @include('admin.components.table.sort_on_client.th', ['column' => 'name', 'label' => trans_choice('entities.protected_area.protected_area', 1)])
                    <th class="text-center">@lang('form/imet/common.encoders_responsible')</th>
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
                                {{-- name --}}
                                <div class="imet_pa_name">
                                    <strong style="font-size: 1.1em;">@{{ item.name }}</strong>
                                    (<a target="_blank" :href="'{{ \App\Library\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL }}'+ item.wdpa_id">@{{ item.wdpa_id }}</a>)
                                    <br />
                                    <flag :iso2=item.iso2></flag>&nbsp;&nbsp;<i>@{{ item.country_name }}</i>
                                </div>
                                <br />
                                {{-- language --}}
                                <div>
                                    {{ ucfirst(trans('form/imet/common.encoding_language')) }}:
                                    <flag :iso2=item.language></flag>
                                </div>
                                {{-- version --}}
                                <div>
                                    {{ ucfirst(trans('common.version')) }}:
                                    <span v-if="item.version==='v2'" class="badge badge-success">v2</span>
                                    <span v-else-if="item.version==='v1'" class="badge badge-secondary">v1</span>
                                </div>
                            </div>
                        </td>
                        <td class="align-baseline">
                            <imet_encoders_responsibles
                                :items=item.encoders_responsibles
                            ></imet_encoders_responsibles>
                        </td>
                        <td>
                            <imet_radar :width=150 :height=150 :values=item.assessment ></imet_radar>
                        </td>
                        <td class="align-baseline text-center" style="white-space: nowrap;">

                            {{-- Show --}}
                            <span v-if="item.version==='v2'">
                                @include('admin.imet.components.button_show', ['version' => 'v2'])
                            </span>

                            @if($can_encode)

                                {{-- Edit --}}
                                <span v-if="item.version==='v1'">
                                    {{-- Edit --}}
                                    @include('admin.imet.components.button_edit', ['version' => 'v1'])
                                </span>
                                <span v-else-if="item.version==='v2'">
                                    {{-- Edit --}}
                                    @include('admin.imet.components.button_edit', ['version' => 'v2'])
                                </span>

                                {{-- Upgrade --}}
                                <span v-if="item.version==='v1'">
                                    @include('admin.imet.components.button_upgrade', [
                                        'controller' => \App\Http\Controllers\Imet\ImetController::class,
                                        'item' => 'item.FormID'
                                    ])
                                </span>

                                {{-- Merge tool --}}
                                <span v-if="item.has_duplicates">
                                    @include('admin.components.buttons._generic', [
                                        'controller' => \App\Http\Controllers\Imet\ImetController::class,
                                        'action' =>'merge_view',
                                        'item' => 'item.FormID',
                                        'tooltip' => ucfirst(trans('common.merge')),
                                        'icon' => 'clone',
                                        'class' => 'btn-primary'
                                    ])
                                </span>

                            @endif

                            {{-- Export --}}
                            @include('admin.components.buttons._generic', [
                                'controller' => \App\Http\Controllers\Imet\ImetController::class,
                                'action' =>'export',
                                'item' => 'item.FormID',
                                'tooltip' => ucfirst(trans('common.export')),
                                'icon' => 'cloud-download-alt',
                                'class' => 'btn-primary'
                            ])

                            {{-- Print --}}
                            <span v-if="item.version==='v2'">
                                @include('admin.components.buttons._generic', [
                                    'controller' => \App\Http\Controllers\Imet\ImetControllerV2::class,
                                    'action' =>'print',
                                    'item' => 'item.FormID',
                                    'tooltip' => ucfirst(trans('common.print')),
                                    'icon' => 'print',
                                    'class' => 'btn-primary'
                                ])
                            </span>

                            @if($can_encode)

                                {{-- Delete --}}
                                @include('admin.components.buttons.delete', [
                                    'controller' => \App\Http\Controllers\Imet\ImetController::class,
                                    'item' => 'item.FormID'
                                ])

                            @endif

                        </td>
                    </tr>
                </tbody>

            </table>

        @endif

    </div>

    @push('scripts')

        <script>

            new SortedTable({
                el: '#sortable_list',
                data: {
                    list: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($list) !!}'),
                    pageSize: 10
                },

                mounted: function () {
                    this.sort('{{ App\Models\Imet\Imet::$sortBy }}', '{{\App\Models\Imet\Imet::$sortDirection }}');
                }

            });
        </script>
    @endpush

@endsection