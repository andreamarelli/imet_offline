<?php
/** @var array $assessment */

?>

<table id="detailed_scores">

    <!-- context -->
    <tr>
        <th rowspan="2">@lang('imet-core::v1_common.steps_eval.context')</th>
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c1'], 'assessment_label' => trans('imet-core::v1_common.assessment.c1')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c2'], 'assessment_label' => trans('imet-core::v1_common.assessment.c2')[1]])
        @include('imet-core::v1.report.components.row_evaluation', [
            'assessment_value' => $assessment['context']['c3'],
            'assessment_label' => trans('imet-core::v1_common.assessment.c3')[1],
            'threats' => true
        ])
        @include('imet-core::v1.report.components.row_evaluation', [
            'assessment_value' => $assessment['context']['avg_indicator'],
            'assessment_label' => trans('imet-core::v1_common.indexes.context')[1],
            'additional_classes' => 'avg_index'
        ])
        <td colspan="4"></td>
    </tr>
    <tr>
        <td class="bordered">{{  trans('imet-core::v1_common.assessment.c1')[1] }}</td>
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c11'], 'assessment_label' => trans('imet-core::v1_common.assessment.c11')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c12'], 'assessment_label' => trans('imet-core::v1_common.assessment.c12')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c13'], 'assessment_label' => trans('imet-core::v1_common.assessment.c13')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c14'], 'assessment_label' => trans('imet-core::v1_common.assessment.c14')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c15'], 'assessment_label' => trans('imet-core::v1_common.assessment.c15')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['context']['c16'] ?? null, 'assessment_label' => trans('imet-core::v1_common.assessment.c16')[1]])
        @include('imet-core::v1.report.components.row_evaluation', [
            'assessment_value' => $assessment['context']['c1'],
            'assessment_label' => trans('imet-core::v1_common.assessment.c1')[1],
            'additional_classes' => 'avg_sub_index'
        ])

    </tr>

    <!-- planning -->
    <tr>
        <th>@lang('imet-core::v1_common.steps_eval.planning')</th>
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p1'], 'assessment_label' => trans('imet-core::v1_common.assessment.p1')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p2'], 'assessment_label' => trans('imet-core::v1_common.assessment.p2')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p3'], 'assessment_label' => trans('imet-core::v1_common.assessment.p3')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p4'], 'assessment_label' => trans('imet-core::v1_common.assessment.p4')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p5'], 'assessment_label' => trans('imet-core::v1_common.assessment.p5')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['planning']['p6'], 'assessment_label' => trans('imet-core::v1_common.assessment.p6')[1]])
        @include('imet-core::v1.report.components.row_evaluation', [
            'assessment_value' => $assessment['planning']['avg_indicator'],
            'assessment_label' => trans('imet-core::v1_common.indexes.planning')[1],
            'additional_classes' => 'avg_index'
        ])
        <td></td>
    </tr>

    <!-- inputs -->
    <tr>
        <th>@lang('imet-core::v1_common.steps_eval.inputs')</th>
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i1'], 'assessment_label' => trans('imet-core::v1_common.assessment.i1')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i2'], 'assessment_label' => trans('imet-core::v1_common.assessment.i2')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i3'], 'assessment_label' => trans('imet-core::v1_common.assessment.i3')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i4'], 'assessment_label' => trans('imet-core::v1_common.assessment.i4')[1]])
        @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['inputs']['i5'], 'assessment_label' => trans('imet-core::v1_common.assessment.i5')[1]])
        @include('imet-core::v1.report.components.row_evaluation', [
            'assessment_value' => $assessment['inputs']['avg_indicator'],
            'assessment_label' => trans('imet-core::v1_common.indexes.inputs')[1],
            'additional_classes' => 'avg_index'
        ])
        <td colspan="2"></td>
    </tr>

       <!-- process -->
       <tr>
           <th rowspan="7">@lang('imet-core::v1_common.steps_eval.process')</th>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr1_6'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr1_6')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr7_10'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr7_10')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr11_13'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr11_13')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr14_15'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr14_15')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr16_17'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr16_17')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr18_19'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr18_19')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['process']['avg_indicator'],
               'assessment_label' => trans('imet-core::v1_common.indexes.process')[1],
               'additional_classes' => 'avg_index'
           ])
           <td></td>
       </tr>
       <tr>
           <td class="bordered">{{  trans('imet-core::v1_common.assessment.pr1_6')[1] }}</td>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr1'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr1')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr2'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr2')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr3'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr3')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr4'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr4')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr5'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr5')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr6'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr6')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['process']['pr1_6'],
               'assessment_label' => trans('imet-core::v1_common.assessment.pr1_6')[1],
               'additional_classes' => 'avg_sub_index'
           ])
       </tr>
       <tr>
           <td class="bordered">{{  trans('imet-core::v1_common.assessment.pr7_10')[1] }}</td>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr7'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr7')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr8'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr8')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr9'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr9')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr10'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr10')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['process']['pr7_10'],
               'assessment_label' => trans('imet-core::v1_common.assessment.pr7_10')[1],
               'additional_classes' => 'avg_sub_index'
           ])
           <td colspan="2"></td>
       </tr>
       <tr>
           <td class="bordered">{{  trans('imet-core::v1_common.assessment.pr11_13')[1] }}</td>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr11'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr11')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr12'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr12')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr13'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr13')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['process']['pr11_13'],
               'assessment_label' => trans('imet-core::v1_common.assessment.pr11_13')[1],
               'additional_classes' => 'avg_sub_index'
           ])
           <td colspan="3"></td>
       </tr>
       <tr>
           <td class="bordered">{{  trans('imet-core::v1_common.assessment.pr14_15')[1] }}</td>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr14'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr14')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr15'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr15')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['process']['pr14_15'],
               'assessment_label' => trans('imet-core::v1_common.assessment.pr14_15')[1],
               'additional_classes' => 'avg_sub_index'
           ])
           <td colspan="4"></td>
       </tr>
        <tr>
            <td class="bordered">{{  trans('imet-core::v1_common.assessment.pr16_17')[1] }}</td>
            @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr16'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr16')[1]])
            @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr17'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr17')[1]])
            @include('imet-core::v1.report.components.row_evaluation', [
                'assessment_value' => $assessment['process']['pr16_17'],
                'assessment_label' => trans('imet-core::v1_common.assessment.pr16_17')[1],
                'additional_classes' => 'avg_sub_index'
            ])
            <td colspan="4"></td>
        </tr>
       <tr>
           <td class="bordered">{{  trans('imet-core::v1_common.assessment.pr18_19')[1] }}</td>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr18'], 'assessment_label' => trans('imet-core::v1_common.assessment.pr18')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['process']['pr19'] ?? null, 'assessment_label' => trans('imet-core::v1_common.assessment.pr19')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['process']['pr18_19'],
               'assessment_label' => trans('imet-core::v1_common.assessment.pr18_19')[1],
               'additional_classes' => 'avg_sub_index'
           ])
           <td colspan="4"></td>
       </tr>

       <!-- outputs -->
       <tr>
           <th>@lang('imet-core::v1_common.steps_eval.outputs')</th>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outputs']['r1'], 'assessment_label' => trans('imet-core::v1_common.assessment.r1')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outputs']['r2'], 'assessment_label' => trans('imet-core::v1_common.assessment.r2')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['outputs']['avg_indicator'],
               'assessment_label' => trans('imet-core::v1_common.indexes.outputs')[1],
               'additional_classes' => 'avg_index'
           ])
           <td colspan="5"></td>
       </tr>

       <!-- outcomes -->
       <tr>
           <th>@lang('imet-core::v1_common.steps_eval.outcomes')</th>
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['ei1'], 'assessment_label' => trans('imet-core::v1_common.assessment.ei1')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['ei2'], 'assessment_label' => trans('imet-core::v1_common.assessment.ei2')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['ei3'], 'assessment_label' => trans('imet-core::v1_common.assessment.ei3')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['ei4'] ?? null, 'assessment_label' => trans('imet-core::v1_common.assessment.ei4')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['ei5'] ?? null, 'assessment_label' => trans('imet-core::v1_common.assessment.ei5')[1]])
           @include('imet-core::v1.report.components.row_evaluation', ['assessment_value' => $assessment['outcomes']['ei6'] ?? null, 'assessment_label' => trans('imet-core::v1_common.assessment.ei6')[1]])
           @include('imet-core::v1.report.components.row_evaluation', [
               'assessment_value' => $assessment['outcomes']['avg_indicator'],
               'assessment_label' => trans('imet-core::v1_common.indexes.outcomes')[1],
               'additional_classes' => 'avg_index'
           ])
           <td></td>
       </tr>

</table>
