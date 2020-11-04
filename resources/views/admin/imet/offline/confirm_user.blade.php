<?php
$item = \App\Models\Person\Person::find(0);
$fields = \App\Models\Person\Modules\GeneralInfo::getDefinitions()['fields'];
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
        action([\App\Http\Controllers\Imet\ImetController::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@section('content')


    <div id="module_person__confirm_offline" class="module-container">
        <div class="module-header">
            <div class="module-title">
                @lang('entities.staff.confirm_user_info')
            </div>
        </div>

        <div class="module-body">
            <form method="post" id="confirm_form" action="{{ action([\App\Http\Controllers\StaffController::class, 'update_offline'], [$item->getKey()]) }}">
                @method('PATCH')
                @csrf

                <div class="module_body">

                    @foreach($fields as $field)

                        @component('admin.components.module.components.row', [
                            'name' => $field['name'],
                            'label' => isset($field['label']) ? $field['label'] : '',
                            'label_width' => 3
                        ])

                            {{-- input field --}}
                            {!! \App\Library\Ofac\Input\Input::text($field['name'], $item->{$field['name']}) !!}

                        @endcomponent

                    @endforeach


                </div>

            </form>
        </div>

        <div class="module-bar save-bar">
            <div class="message"></div>
            <div class="buttons">
                <button type="button" class="btn btn-success btn-sm" onclick="document.getElementById('confirm_form').submit()">Save</button>
            </div>
        </div>
    </div>

@endsection


