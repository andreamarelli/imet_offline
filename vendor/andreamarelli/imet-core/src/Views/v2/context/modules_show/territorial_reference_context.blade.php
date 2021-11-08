<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$definitions['label_width'] = 7;

?>

@foreach($definitions['fields'] as $i => $field)

    @if($i===1)

        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.FunctionalEcosystemArea')</h3>

        <div class="module-row">

            {{-- label  --}}
            <div class="module-row__label" style="width: {{ round(100/12*$definitions['label_width']) }}%;">
                <label for="FunctionalKm2">{!! ucfirst(trans('imet-core::v2_context.TerritorialReferenceContext.fields.FunctionalArea')) !!}</label>
            </div>

            {{-- input field --}}
            <div  class="module-row__input" style="display: flex; align-items: center;">
                @include('modular-forms::module.show.field', [
                    'type' => $definitions['fields'][$i]['type'],
                    'value' => $records[0][$definitions['fields'][$i]['name']]
               ])
                &nbsp;[km2]&nbsp;&nbsp;
                @include('modular-forms::module.show.field', [
                    'type' => $definitions['fields'][$i+1]['type'],
                    'value' => $records[0][$definitions['fields'][$i+1]['name']]
               ])
                &nbsp;[km]
            </div>

        </div>

    @elseif($i===4)

        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.BenefitsOfEcosystemServicesArea')</h3>

        <div class="module-row">

            {{-- label  --}}
            <div class="module-row__label" style="width: {{ round(100/12*$definitions['label_width']) }}%;">
                <label for="FunctionalKm2">{!! ucfirst(trans('imet-core::v2_context.TerritorialReferenceContext.fields.BenefitArea')) !!}</label>
            </div>

            {{-- input field --}}
            <div  class="module-row__input" style="display: flex; align-items: center;">
                @include('modular-forms::module.show.field', [
                    'type' => $definitions['fields'][$i]['type'],
                    'value' => $records[0][$definitions['fields'][$i]['name']]
               ])
                &nbsp;[km2]&nbsp;&nbsp;
                @include('modular-forms::module.show.field', [
                    'type' => $definitions['fields'][$i+1]['type'],
                    'value' => $records[0][$definitions['fields'][$i+1]['name']]
               ])
                &nbsp;[km]
            </div>

        </div>

    @elseif($i===8)

        <h3>@lang('imet-core::v2_context.TerritorialReferenceContext.categories.SpillOverArea')</h3>
        <div class="module-row">

            {{-- label  --}}
            <div class="module-row__label" style="width: {{ round(100/12*$definitions['label_width']) }}%;">
                <label for="FunctionalKm2">{!! ucfirst(trans('imet-core::v2_context.TerritorialReferenceContext.fields.SpillOverArea')) !!}</label>
            </div>

            {{-- input field --}}
            <div  class="module-row__input" style="display: flex; align-items: center;">
                @include('modular-forms::module.show.field', [
                    'type' => $definitions['fields'][$i]['type'],
                    'value' => $records[0][$definitions['fields'][$i]['name']]
               ])
                &nbsp;[km2]&nbsp;&nbsp;
                @include('modular-forms::module.show.field', [
                    'type' => $definitions['fields'][$i+1]['type'],
                    'value' => $records[0][$definitions['fields'][$i+1]['name']]
               ])
                &nbsp;[km]
            </div>

        </div>

    @elseif($i!==2 && $i!==5 && $i!==9)

        @component('modular-forms::module.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => $definitions['label_width']
            ])

            {{-- input field --}}
            @include('modular-forms::module.show.field', [
                'type' => $field['type'],
                'value' => $records[0][$field['name']]
           ])

        @endcomponent

    @endif

@endforeach
