<?php
use AndreaMarelli\ImetCore\Controllers\Imet\ApiController;
/** @var array $scores */
/** @var array $labels */

?>

<table id="detailed_scores">

    <!-- context -->
    <tr>
        <th rowspan="2">
            <div>@lang('imet-core::common.steps_eval.context')</div>
            <div class="badge {!! ApiController::score_class($scores['context']['avg_indicator']) !!}">{{ $scores['context']['avg_indicator'] }}</div>
        </th>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['context']['C1'], 'assessment_label' => $labels['C1']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['context']['C2'], 'assessment_label' => $labels['C2']])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $scores['context']['C3'],
            'assessment_label' => $labels['C3'],
            'threats' => true
        ])
        <td colspan="5"></td>
    </tr>
    <tr>
        <td class="bordered">{{  $labels['C1'] }}</td>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['context']['C11'], 'assessment_label' => $labels['C11']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['context']['C12'], 'assessment_label' => $labels['C12']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['context']['C13'], 'assessment_label' => $labels['C13']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['context']['C14'], 'assessment_label' => $labels['C14']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['context']['C15'], 'assessment_label' => $labels['C15']])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $scores['context']['C1'],
            'assessment_label' => $labels['C1'],
            'additional_classes' => 'avg_sub_index'
        ])
        <td></td>
    </tr>

    <!-- planning -->
    <tr>
        <th>
            <div>@lang('imet-core::common.steps_eval.planning')</div>
            <div class="badge {!! ApiController::score_class($scores['planning']['avg_indicator']) !!}">{{ $scores['planning']['avg_indicator'] }}</div>
        </th>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P1'], 'assessment_label' => $labels['P1']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P2'], 'assessment_label' => $labels['P2']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P3'], 'assessment_label' => $labels['P3']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P4'], 'assessment_label' => $labels['P4']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P5'], 'assessment_label' => $labels['P5']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P6'], 'assessment_label' => $labels['P6']])
        <td colspan="2"></td>
    </tr>

    <!-- inputs -->
    <tr>
        <th>
            <div>@lang('imet-core::common.steps_eval.inputs')</div>
            <div class="badge {!! ApiController::score_class($scores['inputs']['avg_indicator']) !!}">{{ $scores['inputs']['avg_indicator'] }}</div>
        </th>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I1'], 'assessment_label' => $labels['I1']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I2'], 'assessment_label' => $labels['I2']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I3'], 'assessment_label' => $labels['I3']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I4'], 'assessment_label' => $labels['I4']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I5'], 'assessment_label' => $labels['I5']])
        <td colspan="3"></td>
    </tr>


    <!-- process -->
    <tr>
        <th rowspan="7">
            <div>@lang('imet-core::common.steps_eval.process')</div>
            <div class="badge {!! ApiController::score_class($scores['process']['avg_indicator']) !!}">{{ $scores['process']['avg_indicator'] }}</div>
        </th>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PRA'], 'assessment_label' => $labels['PRA']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PRB'], 'assessment_label' => $labels['PRB']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PRC'], 'assessment_label' => $labels['PRC']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PRD'], 'assessment_label' => $labels['PRD']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PRE'], 'assessment_label' => $labels['PRE']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PRF'], 'assessment_label' => $labels['PRF']])
        <td colspan="2"></td>
    </tr>
    <tr>
        <td class="bordered">{{  $labels['PRA'] }}</td>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR1'], 'assessment_label' => $labels['PR1']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR2'], 'assessment_label' => $labels['PR2']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR3'], 'assessment_label' => $labels['PR3']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR4'], 'assessment_label' => $labels['PR4']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR5'], 'assessment_label' => $labels['PR5']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR6'], 'assessment_label' => $labels['PR6']])
        @include('imet-core::v2.report.components.row_evaluation', [
               'assessment_value' => $scores['process']['PRA'],
               'assessment_label' => $labels['PRA'],
               'additional_classes' => 'avg_sub_index'
           ])
    </tr>
    <tr>
        <td class="bordered">{{  $labels['PRB'] }}</td>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR7'], 'assessment_label' => $labels['PR7']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR8'], 'assessment_label' => $labels['PR8']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR9'], 'assessment_label' => $labels['PR9']])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $scores['process']['PRB'],
            'assessment_label' => $labels['PRB'],
            'additional_classes' => 'avg_sub_index'
        ])
        <td colspan="3"></td>
    </tr>
    <tr>
        <td class="bordered">{{  $labels['PRC'] }}</td>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR10'], 'assessment_label' => $labels['PR10']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR11'], 'assessment_label' => $labels['PR11']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR12'], 'assessment_label' => $labels['PR12']])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $scores['process']['PRC'],
            'assessment_label' => $labels['PRC'],
            'additional_classes' => 'avg_sub_index'
        ])
        <td colspan="3"></td>
    </tr>
    <tr>
        <td class="bordered">{{  $labels['PRD'] }}</td>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR13'], 'assessment_label' => $labels['PR13']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR14'], 'assessment_label' => $labels['PR14']])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $scores['process']['PRD'],
            'assessment_label' => $labels['PRD'],
            'additional_classes' => 'avg_sub_index'
        ])
        <td colspan="4"></td>
    </tr>
    <tr>
        <td class="bordered">{{  $labels['PRE'] }}</td>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR15'], 'assessment_label' => $labels['PR15']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR16'], 'assessment_label' => $labels['PR16']])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $scores['process']['PRE'],
            'assessment_label' => $labels['PRE'],
            'additional_classes' => 'avg_sub_index'
        ])
        <td colspan="4"></td>
    </tr>
    <tr>
        <td class="bordered">{{  $labels['PRF'] }}</td>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR17'], 'assessment_label' => $labels['PR17']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR18'], 'assessment_label' => $labels['PR18']])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $scores['process']['PRF'],
            'assessment_label' => $labels['PRF'],
            'additional_classes' => 'avg_sub_index'
        ])
        <td colspan="4"></td>
    </tr>


    <!-- outputs -->
    <tr>
        <th>
            <div>@lang('imet-core::common.steps_eval.outputs')</div>
            <div class="badge {!! ApiController::score_class($scores['outputs']['avg_indicator']) !!}">{{ $scores['outputs']['avg_indicator'] }}</div>
        </th>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['outputs']['OP1'], 'assessment_label' => $labels['OP1']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['outputs']['OP1'], 'assessment_label' => $labels['OP2']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['outputs']['OP3'], 'assessment_label' => $labels['OP3']])
        <td colspan="5"></td>
    </tr>


    <!-- outcomes -->
    <tr>
        <th>
            <div>@lang('imet-core::common.steps_eval.outcomes')</div>
            <div class="badge {!! ApiController::score_class($scores['outcomes']['avg_indicator']) !!}">{{ $scores['outcomes']['avg_indicator'] }}</div>
        </th>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['outcomes']['OC1'], 'assessment_label' => $labels['OC1']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['outcomes']['OC2'], 'assessment_label' => $labels['OC2']])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $scores['outcomes']['OC3'], 'assessment_label' => $labels['OC3']])
        <td colspan="5"></td>
    </tr>

</table>
