<?php

use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;

/** @var Imet $item */
/** @var String $stakeholder */
/** @var Array $categories */
/** @var Array $definitions */

$categories = $categories !== null ? json_decode($categories) : [];

?>

@push('scripts')
    <style>
        .rating-container {
            justify-content: start;
        }
    </style>
@endpush


@if($categories === [])
    @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 6])

@else

    {{-- groups --}}
    @foreach($definitions['groups'] as $group_key => $group_label)

        @if(
            in_array('provisioning', $categories) && in_array($group_key, ['group0', 'group1', 'group2', 'group3']) ||
            in_array('cultural', $categories) && in_array($group_key, ['group4', 'group5', 'group6' ]) ||
            in_array('regulating', $categories) && in_array($group_key, ['group7', 'group8']) ||
            in_array('supporting', $categories) && in_array($group_key, ['group9', 'group10'])
        )

            {{-- titles --}}
            @if($group_key === 'group0')
                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title0')</h4>
            @elseif($group_key === 'group4')
                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title1')</h4>
            @elseif($group_key === 'group7')
                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title2')</h4>
            @elseif($group_key === 'group9')
                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title3')</h4>
            @elseif($group_key === 'group11')
                <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title4')</h4>
            @endif


            <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>
            @lang('imet-core::oecm_context.AnalysisStakeholders.groups_descriptions.' . $group_key)

            @for ($i = 0; $i < 5; $i++)
                <div class="card">
                    <div>
                        <div class="card-body">

                            @foreach($definitions['fields'] as $field)

                                <div class="module-row">

                                    {{-- label  --}}
                                    @if(isset($field['label']) && $field['label']!='')
                                        <div class="module-row__label" style="width: 20%;">
                                            <label for="{{ $field['name'] }}">{!! ucfirst($field['label']) !!}</label>
                                        </div>
                                    @endif

                                    {{-- input --}}
                                    <div class="module-row__input">


                                        @if($field['name'] === 'Comments')
                                            <div class="field-preview" style="max-width: none; height: 120px;"></div>
                                        @elseif($field['name'] === 'Access')
                                            @include('modular-forms::module.show.field', [
                                                'type' => 'checkbox-ImetOECM_Access',
                                                'value' => []
                                             ])
                                        @elseif($field['name'] === 'Threats')
                                            @include('modular-forms::module.show.field', [
                                                'type' => 'checkbox-ImetOECM_Threats',
                                                'value' => []
                                             ])
                                        @elseif($field['name'] === 'Guidelines')
                                            @include('modular-forms::module.show.field', [
                                                'type' => 'checkbox-ImetOECM_Guidelines',
                                                'value' => []
                                             ])
                                        @else
                                            @include('modular-forms::module.show.field', [
                                                'type' => $field['type'],
                                                'value' => null
                                           ])
                                        @endif

                                        @if($field['name'] === 'Element')
                                            <div style="margin-top: 5px;">Accepted Values: <i>{{ implode(', ', trans('imet-core::oecm_context.AnalysisStakeholders.lists.'.$group_key)) }}</i></div>
                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            @endfor

        @endif
    @endforeach

@endif



