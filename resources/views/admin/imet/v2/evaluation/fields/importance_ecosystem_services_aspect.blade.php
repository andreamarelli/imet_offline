<?php

/** @var String $v_model */
/** @var String $v_bind_id */
/** @var String $class  */
/** @var String $other [optional] */

$vue_attributes = $v_model . ' ' .$v_bind_id;

?>
<input type="hidden" {!! $vue_attributes !!} class="{!! $class !!}" {!! $other !!} />
<div class="field-disabled">@{{ {!! $v_value !!} }}</div>
<div class="text-left" style="padding: 4px;" v-if="'_rank' in records[index]">
    <b class="green">@{{ '_rank' in records[index] ? records[index]['_rank'].toFixed(2) : '' }}</b>&nbsp;&nbsp;
    <span style="font-size: 0.85em; font-style: italic; ">
        (@lang('form/imet/v2/context.EcosystemServices.fields.Importance'): <b>@{{ records[index]['_Importance'] }}</b>,&nbsp;&nbsp;
        @lang('form/imet/v2/context.EcosystemServices.fields.ImportanceRegional'): <b>@{{ records[index]['_ImportanceRegional'] }}</b>,&nbsp;&nbsp;
        @lang('form/imet/v2/context.EcosystemServices.fields.ImportanceGlobal'): <b>@{{ records[index]['_ImportanceGlobal'] }}</b>)
    </span>
</div>