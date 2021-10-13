<?php
/** @var Mixed $definitions */
$definitions['label_width'] = 7;

?>

@foreach($definitions['fields'] as $i => $field)

    @if($i==0)
        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.FunctionalEcosystemArea')</h3>
    @elseif($i==3)
        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.BenefitsOfEcosystemServicesArea')</h3>
    @elseif($i==7)
        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.SpillOverArea')</h3>
    @endif

    @component('modular-forms::module.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])

        {{-- input field --}}
        @include('modular-forms::module.edit.field.module-to-vue', [
            'definitions' => $definitions,
            'field' => $field,
            'vue_record_index' => '0'
        ])

    @endcomponent

@endforeach

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
