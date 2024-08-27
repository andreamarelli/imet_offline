<?php
/** @var \AndreaMarelli\ImetCore\Controllers\Imet\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Collection $list */
/** @var \Illuminate\Http\Request $request */
/** @var string $route_prefix */
/** @var array $countries */
/** @var array $years */

use \AndreaMarelli\ImetCore\Models\Imet\Imet;

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{-- Filters --}}
    @component('modular-forms::page.components.filters', [
        'controller' => $controller,
        'request' => $request,
        'action' => 'export_view'
    ])
        @slot('content')
            @include('imet-core::components.common_filters', [
                'request' => $request,
                'countries' => $countries,
                'years' => $years
            ])
        @endslot
    @endcomponent

    <br/>

    <div id="export_list">

        <div class="flex">
            <form target="_blank" ref="filterForm" method="POST"
                  action="{{ route($route_prefix . 'export_batch') }}">
                <button type="submit" class="btn-nav rounded" :disabled="exportDisabled">Export
                </button>
                {{ csrf_field() }}
                <input type='hidden' name="selection" v-model="checkboxes">
            </form>
            <span class="float-right mt-3">
                <b>@{{ totalCount }}</b> {{ totalCount==1 ? "<?php echo trans_choice('modular-forms::common.record_found', 1); ?>" :  "<?php echo trans_choice('modular-forms::common.record_found', 2); ?>" }}.
            </span>
        </div>

        <table class="striped">
            <thead>
            <tr>
                <th class="text-center width60px"><input type='checkbox' class="ml-1" @click="checkAll"
                                                         v-model="isCheckAll"></th>
                <th class="text-center width90px">@lang('imet-core::common.year')</th>
                <th class="text-center fit-width">@choice('imet-core::common.protected_area.protected_area',1)</th>
                <th class="text-center fit-width">@lang('imet-core::common.country')</th>
                <th class="text-center fit-width">@lang('imet-core::common.version')</th>
                <th class="text-center fit-width">@lang('imet-core::common.language')</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item of items">
                <td class="align-baseline text-center"><input type="checkbox" @change="exportToggle"
                                                              v-model="checkboxes"
                                                              v-bind:value="item.FormID"></td>
                <td class="align-baseline text-center"><strong>@{{ item.Year }}</strong></td>
                <td class="align-baseline">
                    <div class="imet_name">
                        <div class="imet_pa_name">
                            <strong style="font-size: 1.1em;">@{{ item.name }}</strong>
                            (<a target="_blank"
                                :href="'{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL }}'+ item.wdpa_id">@{{
                                item.wdpa_id }}</a>)
                            <br/>
                        </div>
                        <br/>
                    </div>
                </td>
                <td class="align-baseline">
                    <flag :iso2=item.country.iso2></flag>&nbsp;&nbsp;<i>@{{ item.country.name }}</i>
                </td>
                <td class="align-baseline text-center">
                    <div>
                        <span v-if="item.version==='{{ Imet::IMET_V2 }}'" class="badge badge-success">v2</span>
                        <span v-else-if="item.version==='{{ Imet::IMET_V1 }}'" class="badge badge-secondary">v1</span>
                    </div>
                </td>
                <td>
                    <div class="align-baseline text-center">
                        <flag :iso2=item.language></flag>
                    </div>

                </td>

            </tr>
            </tbody>

        </table>
    </div>

@endsection

@push('scripts')

    <script>

        new Vue({
            el: '#export_list',

            data: {
                checkboxes: [],
                list: @json($list),
                status: 'idle',
                error_message: null,
                isCheckAll: false,
                exportDisabled: true,
            },
            computed: {
                items() {
                    return this.list;
                },
                totalCount() {
                    return this.list.length;
                }
            },
            methods: {
                exportToggle: function () {
                    this.exportDisabled = this.checkboxes.length === 0;
                },
                checkAll: function () {
                    if (!this.isCheckAll) {
                        for (const item in this.list) {
                            this.checkboxes.push(this.list[item].FormID);
                        }
                    } else {
                        this.checkboxes = [];
                    }
                    this.exportDisabled = this.checkboxes.length === 0;
                }
            }
        })
    </script>
@endpush
