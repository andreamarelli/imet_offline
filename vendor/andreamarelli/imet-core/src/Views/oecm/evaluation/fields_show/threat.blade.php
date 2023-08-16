<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label */

$num_stakeholders = $record['__num_stakeholders'];
$elements = $record['__elements'];
$elements_illegal = $record['__elements_illegal'];

//dd($elements, $elements_illegal);

$list = '';
if($num_stakeholders!==null){
    foreach ($elements_illegal as $e){
        if(count($e)>0){
            $list .= '<b style="color: red;">'.implode(', ', $e).'</b>';
        }
    }
    foreach ($elements as $e){
        $list = $list !== '' ? $list.', ': '';
        if(count($e)>0){
            $list .= implode(', ', $e);
        }
    }
}

?>

<div class="field-preview">
    {{ $value }}
</div>


<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    <div>
        @if($list!=='')
            @lang('imet-core::oecm_evaluation.Threats.stakeholders', ['num' => '<b>'.$num_stakeholders.'</b>'])
            <br />
            Listed elements:
            <ul>
                <li>{!! $list !!}</li>
            </ul>
        @endif
    </div>
</div>