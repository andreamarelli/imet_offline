<?php
/** @var Mixed $definitions */
$definitions['label_width'] = 7;

?>

@foreach($definitions['fields'] as $i => $field)

    @if($i==0)
        <h3>@lang('form/imet/v2/context.TerritorialReferenceContext.categories.FunctionalEcosystemArea')</h3>
    @elseif($i==3)
        <h3>@lang('form/imet/v2/context.TerritorialReferenceContext.categories.BenefitsOfEcosystemServicesArea')</h3>
    @elseif($i==7)
        <h3>@lang('form/imet/v2/context.TerritorialReferenceContext.categories.SpillOverArea')</h3>
    @endif

    @component('admin.components.module.components.row', [
            'name' => $field['name'],
            'label' => isset($field['label']) ? $field['label'] : '',
            'label_width' => $definitions['label_width']
        ])

        {{-- input field --}}
        @include('admin.components.module.edit.field.auto_vue', [
            'definitions' => $definitions,
            'field' => $field,
            'vue_record_index' => '0'
        ])

    @endcomponent

@endforeach

@include('admin.components.module.edit.script', compact(['collection', 'vue_data', 'definitions']))