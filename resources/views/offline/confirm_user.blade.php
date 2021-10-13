<?php
/** @var \App\Models\User $item */
/** @var array $fields */


?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection

@section('content')


    <div id="module_person__confirm_offline" class="module-container">
        <div class="module-header">
            <div class="module-title">
                @lang('imet-core::common.staff.confirm_user_info')
            </div>
        </div>

        <div class="module-body">
            <form method="post" id="confirm_form" action="{{ action([\App\Http\Controllers\StaffController::class, 'update_offline'], [$item->getKey()]) }}">
                @method('PATCH')
                @csrf

                <div class="module_body">

                    @foreach($fields as $field)

                        @component('modular-forms::module.field_container', [
                            'name' => $field['name'],
                            'label' => $field['label'] ?? '',
                            'label_width' => 3
                        ])

                            {{-- input field --}}
                            {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::text($field['name'], $item->{$field['name']}) !!}

                        @endcomponent

                    @endforeach


                </div>

            </form>
        </div>

        <div class="module-bar save-bar">
            <div class="message"></div>
            <div class="buttons">
                <button type="button" class="btn-nav small" onclick="document.getElementById('confirm_form').submit()">Save</button>
            </div>
        </div>
    </div>

@endsection


