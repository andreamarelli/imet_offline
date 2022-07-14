<?php
/** @var \App\Models\User $item */

?>
@extends('layouts.admin')

@section('content')

<form method="post" id="confirm_form" action="{{ route('update_offline_user') }}">
    @method('PATCH')
    @csrf

    <div id="module_person__confirm_offline" class="module-container">
        <div class="module-header">
            <div class="module-title">
                @lang('imet-core::common.staff.confirm_user_info')
            </div>
        </div>

        <div class="module-body">

            {{-- fisrt name --}}
            @component('modular-forms::module.field_container', [
                    'name' => 'first_name',
                    'label' => ucfirst(trans('auth.user.first_name')),
                    'label_width' => 3
                ])
                <input id="first_name" type="text" class="field-edit" name="first_name" value="{{ $item->first_name }}" required autofocus>
            @endcomponent

            {{-- last name --}}
            @component('modular-forms::module.field_container', [
                    'name' => 'last_name',
                    'label' => ucfirst(trans('auth.user.last_name')),
                    'label_width' => 3
                ])
                <input id="last_name" type="text" class="field-edit" name="last_name" value="{{ $item->last_name }}" required autofocus>
            @endcomponent

            {{-- organisation --}}
            @component('modular-forms::module.field_container', [
                    'name' => 'organisation',
                    'label' => ucfirst(trans('auth.user.organisation')),
                    'label_width' => 3
                ])
                <input id="organisation" type="text" class="field-edit" name="organisation" value="{{ $item->organisation }}" required autofocus>
            @endcomponent

            {{-- function --}}
            @component('modular-forms::module.field_container', [
                    'name' => 'function',
                    'label' => ucfirst(trans('auth.user.function')),
                    'label_width' => 3
                ])
                <input id="function" type="text" class="field-edit" name="function" value="{{ $item->function }}" required autofocus>
            @endcomponent

            {{-- country --}}
            @component('modular-forms::module.field_container', [
                    'name' => 'function',
                    'label' => ucfirst(trans('auth.user.country')),
                    'label_width' => 3
                ])
                {!! \AndreaMarelli\ModularForms\Helpers\Input\DropDown::simple('country', $item->country, 'Country', 'required') !!}
            @endcomponent

        </div>

        <div class="module-bar save-bar">
            <div class="message"></div>
            <div class="buttons">
                <button type="submit" class="btn-nav small">Save</button>
            </div>
        </div>
    </div>

</form>

@endsection


