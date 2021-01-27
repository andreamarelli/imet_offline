<?php
/** @var array $assessment */


$context_sub_avg = round(
    ($assessment['context']['c11'] +
        $assessment['context']['c12'] +
        $assessment['context']['c13'] +
        $assessment['context']['c14'] +
        $assessment['context']['c15'] +
        $assessment['context']['c16']
    ) / 5, 2);

$process_sub_avg_1 = round(
    ($assessment['process']['pr1'] +
        $assessment['process']['pr2'] +
        $assessment['process']['pr3'] +
        $assessment['process']['pr4'] +
        $assessment['process']['pr5'] +
        $assessment['process']['pr6']
    ) /6 , 2);

$process_sub_avg_2 = round(
    ($assessment['process']['pr7'] +
        $assessment['process']['pr8'] +
        $assessment['process']['pr9'] +
        $assessment['process']['pr10']
    ) /3 , 2);

$process_sub_avg_3 = round(
    ($assessment['process']['pr11'] +
        $assessment['process']['pr12'] +
        $assessment['process']['pr13']
    ) /3 , 2);

$process_sub_avg_4 = round(
    ($assessment['process']['pr14'] +
        $assessment['process']['pr15']
    ) /2 , 2);

$process_sub_avg_5 = round(
    ($assessment['process']['pr16'] +
        $assessment['process']['pr17']
    ) /2 , 2);

$process_sub_avg_6 = round(
    ($assessment['process']['pr18'] +
        $assessment['process']['pr19']
    ) /2 , 2);

?>

<table id="detailed_scores">

    <!-- context -->
    <tr>
        <th rowspan="2">@lang('form/imet/v1/common.steps_eval.context')</th>
        <td {!! score_class($assessment['context']['c1']) !!}>{{  trans('form/imet/v1/common.assessment.c1')[1] }}
            <div>{{ $assessment['context']['c1'] }}</div>
        </td>
        <td {!! score_class($assessment['context']['c2']) !!}>{{  trans('form/imet/v1/common.assessment.c2')[1] }}
            <div>{{ $assessment['context']['c2'] }}</div>
        </td>
        <td {!! score_class_threats($assessment['context']['c3']) !!}>{{  trans('form/imet/v1/common.assessment.c3')[1] }}
            <div>{{ $assessment['context']['c3'] }}</div>
        </td>
        <td {!! score_class($assessment['context']['avg_indicator'], 'avg_index') !!}>{{  trans('form/imet/v1/common.indexes.context') }}
            <div>{{ $assessment['context']['avg_indicator'] }}</div>
        </td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td class="bordered">{{  trans('form/imet/v1/common.assessment.c1')[1] }}</td>
        <td {!! score_class($assessment['context']['c11']) !!}>{{  trans('form/imet/v1/common.assessment.c11')[1] }}
            <div>{{ $assessment['context']['c11'] }}</div>
        </td>
        <td {!! score_class($assessment['context']['c12']) !!}>{{  trans('form/imet/v1/common.assessment.c12')[1] }}
            <div>{{ $assessment['context']['c12'] }}</div>
        </td>
        <td {!! score_class($assessment['context']['c13']) !!}>{{  trans('form/imet/v1/common.assessment.c13')[1] }}
            <div>{{ $assessment['context']['c13'] }}</div>
        </td>
        <td {!! score_class($assessment['context']['c14']) !!}>{{  trans('form/imet/v1/common.assessment.c14')[1] }}
            <div>{{ $assessment['context']['c14'] }}</div>
        </td>
        <td {!! score_class($assessment['context']['c15']) !!}>{{  trans('form/imet/v1/common.assessment.c15')[1] }}
            <div>{{ $assessment['context']['c15'] }}</div>
        </td>
        <td {!! score_class($assessment['context']['c16']) !!}>{{  trans('form/imet/v1/common.assessment.c16')[1] }}
            <div>{{ $assessment['context']['c16'] }}</div>
        </td>
        <td {!! score_class($context_sub_avg, 'avg_sub_index') !!}>{{ trans('form/imet/v1/common.assessment.c1')[1] }}
            <div>{{ $context_sub_avg }}</div>
        </td>
    </tr>

    <!-- planning -->
    <tr>
        <th>@lang('form/imet/v1/common.steps_eval.planning')</th>
        <td {!! score_class($assessment['planning']['p1']) !!}>{{  trans('form/imet/v1/common.assessment.p1')[1] }}
            <div>{{ $assessment['planning']['p1'] }}</div>
        </td>
        <td {!! score_class($assessment['planning']['p2']) !!}>{{  trans('form/imet/v1/common.assessment.p2')[1] }}
            <div>{{ $assessment['planning']['p2'] }}</div>
        </td>
        <td {!! score_class($assessment['planning']['p3']) !!}>{{  trans('form/imet/v1/common.assessment.p3')[1] }}
            <div>{{ $assessment['planning']['p3'] }}</div>
        </td>
        <td {!! score_class($assessment['planning']['p4']) !!}>{{  trans('form/imet/v1/common.assessment.p4')[1] }}
            <div>{{ $assessment['planning']['p4'] }}</div>
        </td>
        <td {!! score_class($assessment['planning']['p5']) !!}>{{  trans('form/imet/v1/common.assessment.p5')[1] }}
            <div>{{ $assessment['planning']['p5'] }}</div>
        </td>
        <td {!! score_class($assessment['planning']['p6']) !!}>{{  trans('form/imet/v1/common.assessment.p6')[1] }}
            <div>{{ $assessment['planning']['p6'] }}</div>
        </td>
        <td {!! score_class($assessment['planning']['avg_indicator'], 'avg_index') !!}>{{  trans('form/imet/v1/common.indexes.planning') }}
            <div>{{ $assessment['planning']['avg_indicator'] }}</div>
        </td>
        <td></td>
    </tr>

    <!-- inputs -->
    <tr>
        <th>@lang('form/imet/v1/common.steps_eval.inputs')</th>
        <td {!! score_class($assessment['inputs']['i1']) !!}>{{  trans('form/imet/v1/common.assessment.i1')[1] }}
            <div>{{ $assessment['inputs']['i1'] }}</div>
        </td>
        <td {!! score_class($assessment['inputs']['i2']) !!}>{{  trans('form/imet/v1/common.assessment.i2')[1] }}
            <div>{{ $assessment['inputs']['i2'] }}</div>
        </td>
        <td {!! score_class($assessment['inputs']['i3']) !!}>{{  trans('form/imet/v1/common.assessment.i3')[1] }}
            <div>{{ $assessment['inputs']['i3'] }}</div>
        </td>
        <td {!! score_class($assessment['inputs']['i4']) !!}>{{  trans('form/imet/v1/common.assessment.i4')[1] }}
            <div>{{ $assessment['inputs']['i4'] }}</div>
        </td>
        <td {!! score_class($assessment['inputs']['i5']) !!}>{{  trans('form/imet/v1/common.assessment.i5')[1] }}
            <div>{{ $assessment['inputs']['i5'] }}</div>
        </td>
        <td {!! score_class($assessment['inputs']['avg_indicator'], 'avg_index') !!}>{{  trans('form/imet/v1/common.indexes.inputs') }}
            <div>{{ $assessment['inputs']['avg_indicator'] }}</div>
        </td>
        <td colspan="2"></td>
    </tr>

       <!-- process -->
       <tr>
           <th rowspan="7">@lang('form/imet/v1/common.steps_eval.process')</th>
           <td {!! score_class($assessment['process']['pr1_6']) !!}>{{  trans('form/imet/v1/common.assessment.pr1_6')[1] }}
               <div>{{ $assessment['process']['pr1_6'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr7_10']) !!}>{{  trans('form/imet/v1/common.assessment.pr7_10')[1] }}
               <div>{{ $assessment['process']['pr7_10'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr11_13']) !!}>{{  trans('form/imet/v1/common.assessment.pr11_13')[1] }}
               <div>{{ $assessment['process']['pr11_13'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr14_15']) !!}>{{  trans('form/imet/v1/common.assessment.pr14_15')[1] }}
               <div>{{ $assessment['process']['pr14_15'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr16_17']) !!}>{{  trans('form/imet/v1/common.assessment.pr16_17')[1] }}
               <div>{{ $assessment['process']['pr16_17'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr18_19']) !!}>{{  trans('form/imet/v1/common.assessment.pr18_19')[1] }}
               <div>{{ $assessment['process']['pr18_19'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['avg_indicator'], 'avg_index') !!}>{{  trans('form/imet/v1/common.indexes.process') }}
               <div>{{ $assessment['process']['avg_indicator'] }}</div>
           </td>
           <td></td>
       </tr>
       <tr>
           <td class="bordered">{{  trans('form/imet/v1/common.assessment.pr1_6')[1] }}</td>
           <td {!! score_class($assessment['process']['pr1']) !!}>{{  trans('form/imet/v1/common.assessment.pr1')[1] }}
               <div>{{ $assessment['process']['pr1'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr2']) !!}>{{  trans('form/imet/v1/common.assessment.pr2')[1] }}
               <div>{{ $assessment['process']['pr2'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr3']) !!}>{{  trans('form/imet/v1/common.assessment.pr3')[1] }}
               <div>{{ $assessment['process']['pr3'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr4']) !!}>{{  trans('form/imet/v1/common.assessment.pr4')[1] }}
               <div>{{ $assessment['process']['pr4'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr5']) !!}>{{  trans('form/imet/v1/common.assessment.pr5')[1] }}
               <div>{{ $assessment['process']['pr5'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr6']) !!}>{{  trans('form/imet/v1/common.assessment.pr6')[1] }}
               <div>{{ $assessment['process']['pr6'] }}</div>
           </td>
           <td {!! score_class($process_sub_avg_1, 'avg_sub_index') !!}>{{ trans('form/imet/v1/common.assessment.pr1_6')[1] }}
               <div>{{ $process_sub_avg_1 }}</div>
           </td>
       </tr>
       <tr>
           <td class="bordered">{{  trans('form/imet/v1/common.assessment.pr7_10')[1] }}</td>
           <td {!! score_class($assessment['process']['pr7']) !!}>{{  trans('form/imet/v1/common.assessment.pr7')[1] }}
               <div>{{ $assessment['process']['pr7'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr8']) !!}>{{  trans('form/imet/v1/common.assessment.pr8')[1] }}
               <div>{{ $assessment['process']['pr8'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr9']) !!}>{{  trans('form/imet/v1/common.assessment.pr9')[1] }}
               <div>{{ $assessment['process']['pr9'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr10']) !!}>{{  trans('form/imet/v1/common.assessment.pr10')[1] }}
               <div>{{ $assessment['process']['pr10'] }}</div>
           </td>
           <td {!! score_class($process_sub_avg_2, 'avg_sub_index') !!}>{{ trans('form/imet/v1/common.assessment.pr7_10')[1] }}
               <div>{{ $process_sub_avg_2 }}</div>
           </td>
           <td colspan="2"></td>
       </tr>
       <tr>
           <td class="bordered">{{  trans('form/imet/v1/common.assessment.pr11_13')[1] }}</td>
           <td {!! score_class($assessment['process']['pr11']) !!}>{{  trans('form/imet/v1/common.assessment.pr11')[1] }}
               <div>{{ $assessment['process']['pr11'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr12']) !!}>{{  trans('form/imet/v1/common.assessment.pr12')[1] }}
               <div>{{ $assessment['process']['pr12'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr13']) !!}>{{  trans('form/imet/v1/common.assessment.pr13')[1] }}
               <div>{{ $assessment['process']['pr13'] }}</div>
           </td>
           <td {!! score_class($process_sub_avg_3, 'avg_sub_index') !!}>{{ trans('form/imet/v1/common.assessment.pr11_13')[1] }}
               <div>{{ $process_sub_avg_3 }}</div>
           </td>
           <td colspan="3"></td>
       </tr>
       <tr>
           <td class="bordered">{{  trans('form/imet/v1/common.assessment.pr14_15')[1] }}</td>
           <td {!! score_class($assessment['process']['pr14']) !!}>{{  trans('form/imet/v1/common.assessment.pr14')[1] }}
               <div>{{ $assessment['process']['pr14'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr15']) !!}>{{  trans('form/imet/v1/common.assessment.pr15')[1] }}
               <div>{{ $assessment['process']['pr15'] }}</div>
           </td>
           <td {!! score_class($process_sub_avg_4, 'avg_sub_index') !!}>{{ trans('form/imet/v1/common.assessment.pr14_15')[1] }}
               <div>{{ $process_sub_avg_4 }}</div>
           </td>
           <td colspan="4"></td>
       </tr>
        <tr>
            <td class="bordered">{{  trans('form/imet/v1/common.assessment.pr16_17')[1] }}</td>
            <td {!! score_class($assessment['process']['pr16']) !!}>{{  trans('form/imet/v1/common.assessment.pr16')[1] }}
                <div>{{ $assessment['process']['pr16'] }}</div>
            </td>
            <td {!! score_class($assessment['process']['pr17']) !!}>{{  trans('form/imet/v1/common.assessment.pr17')[1] }}
                <div>{{ $assessment['process']['pr17'] }}</div>
            </td>
            <td {!! score_class($process_sub_avg_5, 'avg_sub_index') !!}>{{ trans('form/imet/v1/common.assessment.pr16_17')[1] }}
                <div>{{ $process_sub_avg_5 }}</div>
            </td>
            <td colspan="4"></td>
        </tr>
       <tr>
           <td class="bordered">{{  trans('form/imet/v1/common.assessment.pr18_19')[1] }}</td>

           <td {!! score_class($assessment['process']['pr18']) !!}>{{  trans('form/imet/v1/common.assessment.pr18')[1] }}
               <div>{{ $assessment['process']['pr18'] }}</div>
           </td>
           <td {!! score_class($assessment['process']['pr19']) !!}>{{  trans('form/imet/v1/common.assessment.pr19')[1] }}
               <div>{{ $assessment['process']['pr19'] }}</div>
           </td>
           <td {!! score_class($process_sub_avg_6, 'avg_sub_index') !!}>{{ trans('form/imet/v1/common.assessment.pr18_19')[1] }}
               <div>{{ $process_sub_avg_6 }}</div>
           </td>
           <td colspan="4"></td>
       </tr>

       <!-- outputs -->
       <tr>
           <th>@lang('form/imet/v1/common.steps_eval.outputs')</th>
           <td {!! score_class($assessment['outputs']['r1']) !!}>{{  trans('form/imet/v1/common.assessment.r1')[1] }}
               <div>{{ $assessment['outputs']['r1'] }}</div>
           </td>
           <td {!! score_class($assessment['outputs']['r2']) !!}>{{  trans('form/imet/v1/common.assessment.r2')[1] }}
               <div>{{ $assessment['outputs']['r2'] }}</div>
           </td>
           <td {!! score_class($assessment['outputs']['avg_indicator'], 'avg_index') !!}>{{  trans('form/imet/v1/common.indexes.outputs') }}
               <div>{{ $assessment['outputs']['avg_indicator'] }}</div>
           </td>
           <td colspan="5"></td>
       </tr>

       <!-- outcomes -->
       <tr>
           <th>@lang('form/imet/v1/common.steps_eval.outcomes')</th>
           <td {!! score_class($assessment['outcomes']['ei1']) !!}>{{  trans('form/imet/v1/common.assessment.ei1')[1] }}
               <div>{{ $assessment['outcomes']['ei1'] }}</div>
           </td>
           <td {!! score_class($assessment['outcomes']['ei2']) !!}>{{  trans('form/imet/v1/common.assessment.ei2')[1] }}
               <div>{{ $assessment['outcomes']['ei2'] }}</div>
           </td>
           <td {!! score_class($assessment['outcomes']['ei3']) !!}>{{  trans('form/imet/v1/common.assessment.ei3')[1] }}
               <div>{{ $assessment['outcomes']['ei3'] }}</div>
           </td>
           <td {!! score_class($assessment['outcomes']['ei4']) !!}>{{  trans('form/imet/v1/common.assessment.ei4')[1] }}
               <div>{{ $assessment['outcomes']['ei4'] }}</div>
           </td>
           <td {!! score_class($assessment['outcomes']['ei5']) !!}>{{  trans('form/imet/v1/common.assessment.ei5')[1] }}
               <div>{{ $assessment['outcomes']['ei5'] }}</div>
           </td>
           <td {!! score_class($assessment['outcomes']['ei6']) !!}>{{  trans('form/imet/v1/common.assessment.ei6')[1] }}
               <div>{{ $assessment['outcomes']['ei6'] }}</div>
           </td>
           <td {!! score_class($assessment['outcomes']['avg_indicator'], 'avg_index') !!}>{{  trans('form/imet/v1/common.indexes.outcomes') }}
               <div>{{ $assessment['outcomes']['avg_indicator'] }}</div>
           </td>
           <td></td>
       </tr>

</table>
