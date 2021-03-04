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
        <form  method="{{ $method }}" action="{{URL::route('csv_list')}}">
            {{ csrf_field() }}
            <div >
                <table class="table module-table">
                    <tr id="imet_details">
                        <td class="align-baseline text-center">
                            {!! \App\Library\Ofac\Input\Input::label('country', trans('entities.common.country')) !!}
                            {!! \App\Library\Ofac\Input\DropDown::simple('country', $request->input('country'), $countries) !!}
                        </td>
                        <td class="align-baseline text-center">
                            {!! \App\Library\Ofac\Input\Input::label('year', trans('entities.common.year')) !!}
                            {!! \App\Library\Ofac\Input\DropDown::simple('year', $request->input('year'), $years) !!}
                        </td>
                        <td  class="align-baseline text-center">
                            {!! \App\Library\Ofac\Input\Input::label('year', trans('entities.common.protected_area')) !!}
                            {!! \App\Library\Ofac\Input\DropDown::simple('wdpa', $request->input('wdpa'), $wdpa) !!}
                        </td>
                        <td  class="align-baseline text-center">
                           <br/>
                            <button type="submit" class="btn btn-nav rounded mt-2">{{ ucfirst(trans('common.apply_filters')) }}</button>
                        </td>
                    </tr>
                </table>
            </div>

        </form>
    </div>
</div>
    @if(Str::length($results) > 0)
        @foreach($modules as $key => $module)
            @if(count($module) > 0)
                <div class="module-container" >
                    <div class="module-body">
                        <table id="12" class="table module-table">
                            <thead>
                                <tr>
                                    <th class=" text-center">
                                        @if (in_array($key, $imet_keys))
                                        <strong>@lang('form/imet/v2/common.steps.'.$key)</strong>
                                        @else
                                            <strong>@lang('form/imet/v2/common.steps_eval.'.$key)</strong>
                                        @endif
                                    </th>
                                    <th class="text-center">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="22">
                                @foreach($module as $ind_key => $indicator)
                                <tr class="module-table-item" >
                                    @include('admin.imet.v2.module', [
                                            'module' => new $indicator(),
                                            'module_key' => $ind_key,
                                            'step' => $key
                                    ])
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot >
                                <tr>
                                    <td >
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        @lang('common.no_record_found')
    @endif

@endsection