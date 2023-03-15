<?php
/** @var array $assessment */

?>

<table id="detailed_scores">

    <!-- context -->
    <tr>
        <th rowspan="2">
            @lang('imet-core::common.steps_eval.context')
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['context']['avg_indicator'], 'badge') !!}>{{ $assessment['context']['avg_indicator'] }}</div>
            </h4>
        </th>

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
        <th>
            @lang('imet-core::common.steps_eval.planning')
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['planning']['avg_indicator'], 'badge') !!}>{{ $assessment['planning']['avg_indicator'] }}</div>
            </h4>
        </th>
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
        <th>
            @lang('imet-core::common.steps_eval.inputs')
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['inputs']['avg_indicator'], 'badge') !!}>{{ $assessment['inputs']['avg_indicator'] }}</div>
            </h4>
        </th>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i2'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i2')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i3'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i3')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i4'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i4')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i5'], 'assessment_label' => trans('imet-core::oecm_common.assessment.i5')[1]])
        <td colspan="7"></td>
    </tr>


    <!-- process -->
    <tr>
        <th rowspan="4">
            @lang('imet-core::common.steps_eval.process')
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['process']['avg_indicator'], 'badge') !!}>{{ $assessment['process']['avg_indicator'] }}</div>
            </h4>
        </th>
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr1_6'], 'assessment_label' => trans('imet-core::v2_common.assessment.pr1_6')[1]])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr7_9'], 'assessment_label' => trans('imet-core::v2_common.assessment.pr7_9')[1]])
        @include('imet-core::v2.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr10_12'], 'assessment_label' => trans('imet-core::v2_common.assessment.pr10_12')[1]])
        <td colspan="9"></td>
    </tr>
    <tr>
        <td class="bordered">{{  trans('imet-core::v2_common.assessment.pr1_6')[1] }}</td>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr2'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr2')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr3'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr3')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr4'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr4')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr5'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr5')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr6'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr6')[1]])
        @include('imet-core::v2.report.components.row_evaluation', [
              'assessment_value' => $assessment['process']['pr1_6'],
              'assessment_label' => trans('imet-core::v2_common.assessment.pr1_6')[1],
              'additional_classes' => 'avg_sub_index'
          ])
        <td colspan="4"></td>
    </tr>
    <tr>
        <td class="bordered">{{  trans('imet-core::v2_common.assessment.pr7_9')[1] }}</td>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr7'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr7')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr8'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr8')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr9'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr9')[1]])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $assessment['process']['pr7_9'],
            'assessment_label' => trans('imet-core::v2_common.assessment.pr7_9')[1],
            'additional_classes' => 'avg_sub_index'
        ])
        <td colspan="7"></td>
    </tr>
    <tr>
        <td class="bordered">{{  trans('imet-core::v2_common.assessment.pr10_12')[1] }}</td>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr10'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr10')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr11'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr11')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr12'], 'assessment_label' => trans('imet-core::oecm_common.assessment.pr12')[1]])
        @include('imet-core::v2.report.components.row_evaluation', [
            'assessment_value' => $assessment['process']['pr10_12'],
            'assessment_label' => trans('imet-core::v2_common.assessment.pr10_12')[1],
            'additional_classes' => 'avg_sub_index'
        ])
        <td colspan="7"></td>
    </tr>

    <!-- outputs -->
    <tr>
        <th>
            @lang('imet-core::common.steps_eval.outputs')
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['outputs']['avg_indicator'], 'badge') !!}>{{ $assessment['outputs']['avg_indicator'] }}</div>
            </h4>
        </th>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outputs']['op1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.op1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outputs']['op1'], 'assessment_label' => trans('imet-core::v2_common.assessment.op2')[1]])
        <td colspan="10"></td>
    </tr>


    <!-- outcomes -->
    <tr>
        <th>
            @lang('imet-core::common.steps_eval.outcomes')
            <h4>
                <div {!! \AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment::score_class($assessment['outcomes']['avg_indicator'], 'badge') !!}>{{ $assessment['outcomes']['avg_indicator'] }}</div>
            </h4>
        </th>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['oc1'], 'assessment_label' => trans('imet-core::oecm_common.assessment.oc1')[1]])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['oc2'], 'assessment_label' => trans('imet-core::v2_common.assessment.oc2')[1]])
        <td colspan="10"></td>
    </tr>

</table>
