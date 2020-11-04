<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

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
        @include('admin.components.module.preview.field', [
            'type' => $field['type'],
            'value' => $records[0][$field['name']]
       ])

    @endcomponent

@endforeach
