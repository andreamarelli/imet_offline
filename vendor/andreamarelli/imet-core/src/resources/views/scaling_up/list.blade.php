<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/** @var Controller $controller */
/** @var Request $request */
/** @var Collection $list */

$num_records = count($list);
$form_class = Imet::class;

?>


@extends('modular-forms::page.list', [
    'controller' => $controller,
    'request'=> $request,
    'list'=> $list,
])


<!-- page-title -->
@section('page-title')
    <h1 class="pb-6">@lang('imet-core::analysis_report.scaling_up')</h1>
@endsection

<!-- filters -->
@section('filters')
    @include('imet-core::components.common_filters', [
            'request' => $request,
            'countries' => $countries,
            'years' => $years
        ])
@endsection

<!-- functional-selection-buttons -->
@section('functional-selection-buttons')

    <div id="cloud">
        <label-cloud
                :cookie-name="'analysis'"
                url="{{ route('imet-core::scaling_up_report', ['items' => "__items__"]) }}"
                :label-scaling-up="'Scaling up analysis'"
                :label-remove-all="'@lang('imet-core::analysis_report.remove_all')'"
                :source-of-data="'cookie'"
        ></label-cloud>
    </div>
    <action-button-cookie
            :class-name="'btn-nav'"
            :cookie-name="'analysis'"
            :event="'update_cloud_tags'"
            :label="'@lang('imet-core::analysis_report.add_choices')'"
    ></action-button-cookie>
    <button class="btn-nav" @click="add_all()">@lang('imet-core::analysis_report.add_all')</button>

@endsection

<!-- list header -->
@section('list-header')
    <th class="text-center">
        <input type='checkbox'
               class="ml-1 vue-checkboxes"
               @click="check_all()"
               v-model="are_checked_all">
    </th>
    <th class="text-center width60px">@lang('imet-core::common.id')</th>
    <th class="text-left width90px">@lang('imet-core::common.year')</th>
    <th class="text-left">@choice('imet-core::common.protected_area.protected_area', 1)</th>
    <th class="text-center">@lang('imet-core::common.encoders_responsible')</th>
    <th>{{-- radar --}}</th>
@endsection

<!-- list body -->
@section('list-body')
    @foreach ($list as $item)
        <tr>
            <td class="text-center">
                <input type="checkbox"
                       :checked="is_checked('{{ $item->FormID }}')"
                       :data-name='"{{ $item->name }}"'
                       @click="selectValueByIdAndValue({{ $item->FormID }}, '{!! str_replace("'", "\'", $item->name) !!}')"
                       class="vue-checkboxes"
                       :value="{{ $item->FormID }}">
            </td>
            <td class="align-baseline text-center">#{{ $item->FormID }}</td>
            <td class="align-baseline text-center"><strong>{{ $item->Year }}</strong></td>
            <td class="align-baseline">

                <div class="imet_name">
                    <div class="imet_pa_name">
                        {{-- name --}}
                        <strong style="font-size: 1.1em;">{{ $item->name }}</strong>
                        {{-- wdpa_id --}}
                        @if($item->wdpa_id !== null)
                            (<a target="_blank" class="text-primary-600"
                                href="{{ ProtectedPlanet::WEBSITE_URL . $item->wdpa_id }}">
                                {{ $item->wdpa_id }}
                            </a>)
                        @endif
                        <br/>
                        {{-- country --}}
                        <flag iso2="{{ $item->country->iso2 }}"></flag>&nbsp;&nbsp;<i>{{ $item->country->name }}</i>
                    </div>
                    <br/>
                    {{-- language --}}
                    <div>
                        {{ ucfirst(trans('imet-core::common.encoding_language')) }}:
                        <flag iso2="{{ $item->language }}"></flag>
                    </div>
                    {{-- version --}}
                    <div>
                        {{ ucfirst(trans('imet-core::common.version')) }}:
                        @if($item->version == $form_class::IMET_V2)
                            <span class="badge badge-success">v2</span>
                        @elseif($item->version == $form_class::IMET_V1)
                            <span class="badge badge-secondary">v1</span>
                        @elseif($item->version == $form_class::IMET_OECM)
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
                <imet_encoders_responsibles
                        :items='@json($item->encoders_responsibles)'
                ></imet_encoders_responsibles>
            </td>
            <td>
                @if(!empty(array_filter($item->assessment_radar, fn ($item) => !is_null($item))))
                    <imet_radar
                            style="margin: 0 auto;"
                            :width=150 :height=150
                            :values='@json($item->assessment_radar)'
                    ></imet_radar>
                @endif
            </td>
        </tr>
    @endforeach
@endsection

<!-- scripts -->
@section('scripts')
    <script>
        new Vue({
            el: '#page-container',

            data: {
                list: @json($list)
            },

            mixins: [
                window.ModularForms.MixinsVue.checkboxes
            ],

            methods: {
                
                add_all() {
                    this.list.forEach(function (item) {
                        this.selectValueByIdAndValue(item.FormID, item.name);
                    }, this);

                    this.$root.$emit('store_cookie_and_value', 'analysis', JSON.stringify(this.checkboxes));
                    this.$root.$emit('add_cloud_tags');
                }

            }

        });
    </script>
@endsection