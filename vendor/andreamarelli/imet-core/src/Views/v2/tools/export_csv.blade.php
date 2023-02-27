<?php
/** @var array $modules */
/** @var array $imet_keys */
/** @var array $imet_eval_keys */
/** @var array $countries */
/** @var array $years */
/** @var array $wdpa */
/** @var object $request */
/** @var string $method */
/** @var string $url */
/** @var string $results */

?>

@extends('layouts.admin')

@section('content')
    <div class="module-container" id="table_list">
        <div class="module-body">
            <form  method="{{ $method }}" action="{{ \Illuminate\Support\Facades\URL::route('imet-core::csv_list') }}">
                {{ csrf_field() }}
                <div >
                    <table class="table module-table">
                        <tr id="imet_details">
                            <td class="align-baseline text-center">
                                {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('country', trans('imet-core::common.country')) !!}
                                {!! \AndreaMarelli\ModularForms\Helpers\Input\DropDown::simple('country', $request->input('country'), $countries) !!}
                            </td>
                            <td class="align-baseline text-center">
                                {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('year', trans('imet-core::common.year')) !!}
                                {!! \AndreaMarelli\ModularForms\Helpers\Input\DropDown::simple('year', $request->input('year'), $years) !!}
                            </td>
                            <td  class="align-baseline text-center">
                                {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('wdpa', trans_choice('imet-core::common.protected_area.protected_area', 2)) !!}
                                {!! \AndreaMarelli\ModularForms\Helpers\Input\DropDown::simple('wdpa', $request->input('wdpa'), $wdpa) !!}
                            </td>
                            <td  class="align-baseline text-center">
                                <br/>
                                <button type="submit" class="btn-nav rounded mt-2">@uclang('modular-forms::common.apply_filters')</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </form>
        </div>
    </div>
    @if(\Illuminate\Support\Str::length($results) > 0)
        @foreach($modules as $step_key => $step)
            @if(count($step) > 0)
                <div class="module-container" >
                    <div class="module-body">
                        <table id="12" class="table module-table">
                            <thead>
                            <tr>
                                <th class="text-center">
                                <th class=" text-center">
                                    @if (in_array($step_key, $imet_keys))
                                        <strong>@lang('imet-core::v2_common.steps.'.$step_key)</strong>
                                    @else
                                        <strong>@lang('imet-core::common.steps_eval.'.$step_key)</strong>
                                    @endif
                                </th>
                                <th class="text-center">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="22">
                            @foreach($step as $module_key => $module)
                                <tr class="module-table-item" >
                                    @include('imet-core::v2.tools.components.module_export_csv', [
                                            'moduleClass' => new $module(),
                                    ])
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        @lang('modular-forms::common.no_record_found')
    @endif

@endsection
