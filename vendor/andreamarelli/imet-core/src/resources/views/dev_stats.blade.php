<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\Imet $assessments_v1 */
/** @var \AndreaMarelli\ImetCore\Models\Imet\Imet $assessments_v2 */
/** @var array $v1_stats_from_db */
/** @var array $v1_stats_from_php */
/** @var array $v2_stats_from_db */
/** @var array $v2_stats_from_php */

$steps = ['radar', 'context', 'planning', 'inputs', 'process', 'outputs', 'outcomes'];

?>
@extends('modular-forms::layouts.print')


@section('body')

<div style="margin: 20px 40px;">

@isset($assessments_v1)
    <h1>IMET v1</h1>
    <table class="striped">
        <thead>
            <tr>
                <th>assessment ID</th>
                @foreach($steps as $step)
                    <th>{{ $step }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($assessments_v1 as $id)
            <tr>
                <td>{{ $id }}</td>
                @foreach($steps as $step)
                    <td>
                        @if(array_key_exists($step, $v1_stats_from_db))
                            <div style="display: flex; align-items: flex-start; justify-content: flex-start; column-gap: 20px;">
                                <div>
                                    <div><b>INDICATOR</b></div>
                                    @foreach($v1_stats_from_db[$step][$id] as $key=>$value)
                                        <div><b>{{ $key }}</b></div>
                                    @endforeach
                                </div>
                                <div>
                                    <div><b>DB</b></div>
                                    @foreach($v1_stats_from_db[$step][$id] as $key=>$value)
                                        <div>{{ $value ?? '-' }}</div>
                                    @endforeach
                                </div>
                                <div>
                                    <div><b>PHP</b></div>
                                    @foreach($v1_stats_from_php[$step][$id] as $key=>$value)
                                        <div>
                                            @if($v1_stats_from_db[$step][$id][$key] === $value)
                                                <i class="fas fa-check-circle" style="color: green;"></i>
                                            @else
                                                <i class="fas fa-times-circle" style="color: red;"></i>
                                            @endif
                                            {{ $value ?? '-' }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endisset
@isset($assessments_v2)
    <h1>IMET v2</h1>
    <table class="striped">
        <thead>
            <tr>
                <th>assessment ID</th>
                @foreach($steps as $step)
                    <th>{{ $step }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($assessments_v2 as $id)
            <tr>
                <td>{{ $id }}</td>
                @foreach($steps as $step)
                    <td>
                        @if(array_key_exists($step, $v2_stats_from_db))
                            <div style="display: flex; align-items:stretch; justify-content: flex-start; column-gap: 20px;">
                                <div>
                                    <div><b>INDICATOR</b></div>
                                    @foreach($v2_stats_from_db[$step][$id] as $key=>$value)
                                        <div><b>{{ $key }}</b></div>
                                    @endforeach
                                </div>
                                <div>
                                    <div><b>DB</b></div>
                                    @foreach($v2_stats_from_db[$step][$id] as $key=>$value)
                                        <div>{{ $value ?? '-' }}</div>
                                    @endforeach
                                </div>
                                <div>
                                    <div><b>PHP</b></div>
                                    @foreach($v2_stats_from_php[$step][$id] as $key=>$value)
                                        <div>
                                            @if($v2_stats_from_db[$step][$id][$key] === $value)
                                                <i class="fas fa-check-circle" style="color: green;"></i>
                                            @else
                                                <i class="fas fa-times-circle" style="color: red;"></i>
                                            @endif
                                            {{ $value ?? '-' }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endisset

</div>
@endsection