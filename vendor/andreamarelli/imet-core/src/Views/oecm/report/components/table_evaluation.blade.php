<?php
/** @var array $assessment */

?>

<table id="detailed_scores">

    <!-- context -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h4>@lang('imet-core::common.steps_eval.context')</h4>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['context']['avg_indicator'], '') !!}>{{ $assessment['context']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>

    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.c1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c3'], 'assessment_label' => trans('imet-core::oecm_common.assessment.c3')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c4'], 'assessment_label' => trans('imet-core::oecm_common.assessment.c4')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c2'], 'assessment_label' => trans('imet-core::oecm_common.assessment.c2')[1]])
        <td colspan="8"></td>
    </tr>
    <tr>

    </tr>

    <!-- planning -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h4>@lang('imet-core::common.steps_eval.planning')</h4>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['planning']['avg_indicator'], '') !!}>{{ $assessment['planning']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.p1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p2'], 'assessment_label' => trans('imet-core::oecm_common.assessment.p2')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p3'], 'assessment_label' => trans('imet-core::oecm_common.assessment.p3')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p4'], 'assessment_label' => trans('imet-core::oecm_common.assessment.p4')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p5'], 'assessment_label' => trans('imet-core::oecm_common.assessment.p5')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p6'], 'assessment_label' => trans('imet-core::oecm_common.assessment.p6')[1]])
        <td colspan="6"></td>
    </tr>

    <!-- inputs -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h4>@lang('imet-core::common.steps_eval.inputs')</h4>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['inputs']['avg_indicator'], '') !!}>{{ $assessment['inputs']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i2'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i2')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i3'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i3')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i4'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i4')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i5'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i5')[1]])
        <td colspan="7"></td>
    </tr>


    <!-- process -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h4>@lang('imet-core::common.steps_eval.process')</h4>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['process']['avg_indicator'], '') !!}>{{ $assessment['process']['avg_indicator'] ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        <td colspan="5"  style="background-color: #e5e5e5">{{  trans('imet-core::oecm_report.pr1_5') }}
            <div>{{ $assessment['process']['pr1_5'] ?? ' - ' }}</div>
        </td>
        <td colspan="2"  style="background-color: #e5e5e5">{{  trans('imet-core::oecm_report.pr6_7') }}
            <div>{{ $assessment['process']['pr6_7'] ?? ' - ' }}</div>
        </td>
        <td colspan="3"  style="background-color: #e5e5e5">{{  trans('imet-core::oecm_report.pr8_10') }}
            <div>{{ $assessment['process']['pr8_10'] ?? ' - ' }}</div>
        </td>
        <td colspan="2"  style="background-color: #e5e5e5">{{  trans('imet-core::oecm_report.pr11_12') }}
            <div>{{ $assessment['process']['pr11_12'] ?? ' - ' }}</div>
        </td>

    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr2'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr2')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr3'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr3')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr4'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr4')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr5'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr5')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr6'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr6')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr7'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr7')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr8'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr8')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr9'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr9')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr10'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr10')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr11'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr11')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr12'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr12')[1]])
    </tr>
    <!-- outputs -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h4>@lang('imet-core::common.steps_eval.outputs')</h4>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['outputs']['avg_indicator'], '') !!}>{{ $assessment['outputs']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outputs']['op1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.op1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outputs']['op1'], 'assessment_label' => trans('imet-core::v2_common.assessment.op2')[1]])
        <td colspan="10"></td>
    </tr>


    <!-- outcomes -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h4>@lang('imet-core::common.steps_eval.outcomes')</h4>
        </td>
    </tr>
    <tr >
        <td colspan="12">
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['outcomes']['avg_indicator'], '') !!}>{{ $assessment['outcomes']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['oc1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.oc1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['oc2'], 'assessment_label' => trans('imet-core::v2_common.assessment.oc2')[1]])
        <td colspan="10"></td>
    </tr>

</table>
