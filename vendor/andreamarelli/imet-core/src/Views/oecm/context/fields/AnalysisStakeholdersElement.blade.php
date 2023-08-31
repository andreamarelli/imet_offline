<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */

use \AndreaMarelli\ModularForms\Helpers\DOM;

$re = '/records\[\'([\w\d]+)\'\]\[index\].Element/m';
preg_match_all($re, $v_value, $matches);
$group = $matches[1][0];

?>

@if(intval(str_replace('group', '', $group))<=10)
    @php
        $list = trans('imet-core::oecm_context.AnalysisStakeholders.lists.' . $group);
        $list = array_combine($list, $list);
    @endphp
    <dropdown
        data-values='@json($list)'
        {!! DOM::vueAttributes($id, $v_value) !!}
        {!! DOM::rulesAttribute($rules) !!}
    ></dropdown>
@else
    <simple-textarea
        :disabled="records['{{ $group }}'][index]['__predefined']"
        {!! DOM::vueAttributes($id, $v_value) !!}
        {!! DOM::rulesAttribute($rules) !!}
    ></simple-textarea>
@endif




