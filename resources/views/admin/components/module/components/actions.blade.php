<?php
/** @var Mixed $definitions */

?>
<div class="text-right" style="margin: 0 0 10px;">

    @if($definitions['enable_not_applicable'])

        {{-- #### Not applicable #### --}}
        <div id="applicable-{{ $definitions['module_key'] }}"
             v-if=!not_available
             style="display: inline-block; margin-right: 30px;" >
            <label for="not_applicable">@lang('common.form.applicable')</label>
            <input type="checkbox"
               :checked=not_applicable
               v-on:change="toggleNotApplicable()"
               data-toggle="tooltip"  data-original-title="{{ ucfirst(trans('common.form.applicable_tooltip')) }}"/>
        </div>

        {{-- #### Not avalibale #### --}}
        <div id="available-{{ $definitions['module_key'] }}"
             v-if=!not_applicable
             style="display: inline-block; margin-right: 30px;" >
            <label for="not_available">@lang('common.form.not_available')</label>
            <input type="checkbox"
               :checked=not_available
               v-on:change="toggleNotAvailable()"
               data-toggle="tooltip"  data-original-title="{{ ucfirst(trans('common.form.available_tooltip')) }}"/>
        </div>

    @endif

    {{-- #### Preload data from previous years #### --}}
    <span v-if="!not_applicable && !not_available">
        @include('admin.components.module.components.preload', compact('definitions'))
    </span>

</div>

<div v-if=not_applicable class="no-data">
    @lang('common.form.not_applicable')
</div>

<div v-if=not_available class="no-data">
    @lang('common.form.not_available')
</div>

