<?php
/** @var String $step */
/** @var int $item_id */

?>

@if($step!=='objectives')

    @if($step!=='management_effectiveness')

        <div class="module-container">
            <div class="module-header">
                <div class="module-title">
                    @lang('form/imet/v2/common.steps_eval.management_effectiveness')
                </div>
            </div>
            <div class="module-body" >
                {{-- global --}}
                @include('admin.imet.v2.evaluation.management_effectiveness.global', [
                    'item_id' => $item_id
                ])
                {{-- step --}}
                @include('admin.imet.v2.evaluation.management_effectiveness.step', [
                    'item_id' =>$item_id,
                    'step' => $step
                ])
            </div>
        </div>

    @else

        {{-- global --}}
        <div class="module-container">
            <div class="module-header">
                <div class="module-title">
                    @lang('form/imet/v2/common.steps_eval.management_effectiveness')
                </div>
            </div>
            <div class="module-body" >
                @include('admin.imet.v2.evaluation.management_effectiveness.global', [
                    'item_id' => $item_id
                ])
            </div>
        </div>

        {{-- all steps --}}
        @foreach(['context', 'planning', 'inputs', 'process', 'outputs', 'outcomes'] as $s)
            <div class="module-container">
                <div class="module-header">
                    <div class="module-title">
                        @lang('form/imet/v2/common.steps_eval.'.$s)
                    </div>
                </div>
                <div class="module-body" >
                    @include('admin.imet.v2.evaluation.management_effectiveness.step', [
                        'item_id' =>$item_id,
                        'step' => $s
                    ])
                </div>
            </div>
        @endforeach

    @endif

@endif