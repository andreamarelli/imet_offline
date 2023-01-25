<?php
/** @var Mixed $definitions */

// Retrieve the "Observation" field (if exists)
$has_observations = false;
$observation_field = null;
if($definitions['module_type']==='TABLE' || $definitions['module_type']==='ACCORDION'){
    foreach($definitions['common_fields'] as $common_field){
        if($common_field['name'] === 'observations'){
            $has_observations = true;
            $observation_field = $common_field;
        }
    }
} else {
    foreach($definitions['fields'] as $fields){
        if($fields['name'] === 'observations'){
            $has_observations = true;
            $observation_field = $fields;
        }
    }
}

?>
<div class="text-right" style="margin: 0 0 10px;">

    @if($definitions['enable_not_applicable'])

        {{-- #### Not applicable #### --}}
        <div id="applicable-{{ $definitions['module_key'] }}"
             v-if=!not_available
             style="display: inline-block; margin-right: 30px;" >
            <label for="not_applicable">@lang('modular-forms::common.form.applicable')</label>
            <input type="checkbox"
               :checked=not_applicable
               v-on:change="toggleNotApplicable()"
               data-toggle="tooltip"  data-original-title="@uclang('modular-forms::common.form.applicable_tooltip')"/>
        </div>

        {{-- #### Not avalibale #### --}}
        <div id="available-{{ $definitions['module_key'] }}"
             v-if=!not_applicable
             style="display: inline-block; margin-right: 30px;" >
            <label for="not_available">@lang('modular-forms::common.form.not_available')</label>
            <input type="checkbox"
               :checked=not_available
               v-on:change="toggleNotAvailable()"
               data-toggle="tooltip"  data-original-title="@uclang('modular-forms::common.form.available_tooltip')"/>
        </div>

    @endif

    {{-- #### Preload data from previous years #### --}}
    <span v-if="!not_applicable && !not_available">
        @include('modular-forms::module.preload.container', compact('definitions'))
    </span>

</div>

{{-- "No data" label --}}
<div v-if=not_applicable class="no-data">
    @lang('modular-forms::common.form.not_applicable')
</div>
<div v-if=not_available class="no-data">
    @lang('modular-forms::common.form.not_available')
</div>

{{-- Keep "observation" field--}}
@if($has_observations)
    <div class="module_body" v-if="not_applicable || not_available">

        @component('modular-forms::module.field_container', [
                'name' => $observation_field['name'],
                'label' => $observation_field['label'] ?? '',
                'label_width' => $definitions['label_width']
            ])

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $observation_field,
                'vue_record_index' => '0'
            ])

        @endcomponent

    </div>
@endif

