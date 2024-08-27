<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$definitions['label_width'] = 7;

use \AndreaMarelli\ImetCore\Helpers\Template;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;

?>

@foreach($definitions['fields'] as $i => $field)

    @if($field['name']==='FunctionalKm2')

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

    @elseif($field['name']==='BenefitKm2')

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

    @elseif($field['name']==='SpillOverKm2')

        <h3>{!!  Template::module_scope(ImetModule::MARINE) !!} @lang('imet-core::v2_context.TerritorialReferenceContext.categories.SpillOverArea')</h3>
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

    @elseif($field['name'] === 'BenefitSocioEconomicAspects')

        <div class="font-weight-bold">{{ $field['label'] }}</div>
        <div class="BenefitSocioEconomicAspects">
            @include('modular-forms::module.show.field', [
               'type' => $field['type'],
               'value' => $records[0][$field['name']]
          ])
        </div>

    @elseif($field['name'] === 'SpillOverEvalPredatory0_500')

        <div class="SpillOver">{!! trans('imet-core::v2_context.TerritorialReferenceContext.info.spillover_eval') !!}</div>

        <table class="SpillOverEval">
            <thead>
            <tr>
                <th></th>
                <th colspan="3" class="text-center">
                    {!! trans('imet-core::v2_context.TerritorialReferenceContext.info.variation') !!}
                </th>
            </tr>
            <tr>
                <th></th>
                <th>{!! trans('imet-core::v2_context.TerritorialReferenceContext.info.0_500') !!}</th>
                <th>{!! trans('imet-core::v2_context.TerritorialReferenceContext.info.500_1000') !!}</th>
                <th>{!! trans('imet-core::v2_context.TerritorialReferenceContext.info.2000_3000') !!}</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{!! trans('imet-core::v2_context.TerritorialReferenceContext.info.predatory') !!}</td>
                    <td>
                        @include('modular-forms::module.show.field', [
                            'type' => $definitions['fields'][$i]['type'],
                            'value' => $records[0][$definitions['fields'][$i]['name']]
                       ])
                    </td>
                    <td>
                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+1]['type'],
                              'value' => $records[0][$definitions['fields'][$i+1]['name']]
                         ])
                    </td>
                    <td>
                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+2]['type'],
                              'value' => $records[0][$definitions['fields'][$i+2]['name']]
                         ])
                    </td>
                </tr>
                <tr>
                    <td>{!! trans('imet-core::v2_context.TerritorialReferenceContext.info.composition') !!}</td>
                    <td>
                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+3]['type'],
                              'value' => $records[0][$definitions['fields'][$i+3]['name']]
                         ])
                    </td>
                    <td>
                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+4]['type'],
                              'value' => $records[0][$definitions['fields'][$i+4]['name']]
                         ])
                    </td>
                    <td>
                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+5]['type'],
                              'value' => $records[0][$definitions['fields'][$i+5]['name']]
                         ])
                    </td>
                </tr>
                <tr>
                    <td>{!! trans('imet-core::v2_context.TerritorialReferenceContext.info.distance') !!}</td>
                    <td>

                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+6]['type'],
                              'value' => $records[0][$definitions['fields'][$i+6]['name']]
                         ])
                    </td>
                    <td>

                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+7]['type'],
                              'value' => $records[0][$definitions['fields'][$i+7]['name']]
                         ])
                    </td>
                    <td>

                        @include('modular-forms::module.show.field', [
                              'type' => $definitions['fields'][$i+8]['type'],
                              'value' => $records[0][$definitions['fields'][$i+8]['name']]
                         ])
                    </td>
                </tr>
            </tbody>
        </table>

    @elseif($field['name']!=='FunctionalKm'
            and $field['name']!=='BenefitKm'
            and $field['name']!=='SpillOverKm'
            and !\Illuminate\Support\Str::contains($field['name'], 'SpillOverEval'))

        @component('modular-forms::module.components.field_container', [
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

@push('scripts')
    <style>
        .BenefitSocioEconomicAspects{
            padding: 10px 10px 40px 10px;
        }
        .BenefitSocioEconomicAspects div{
            max-width: 100%;
        }
        .SpillOver ul {
            margin-left: 30px;
        }
        table.SpillOverEval{
            max-width: 750px;
        }
        table.SpillOverEval td,
        table.SpillOverEval th{
            padding: 10px;
        }
    </style>
@endpush
