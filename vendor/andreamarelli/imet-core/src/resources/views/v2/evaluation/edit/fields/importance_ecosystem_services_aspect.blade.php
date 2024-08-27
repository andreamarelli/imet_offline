<?php

/** @var String $v_value */
/** @var String $v_id */
/** @var String $class  */
/** @var String $other [optional] */

$vue_attributes = \AndreaMarelli\ModularForms\Helpers\DOM::vueAttributes($v_id, $v_value);

?>
<input type="hidden" {!! $vue_attributes !!} {!! $class !!} {!! $other !!} />
<div class="field-preview field-disabled">@{{ {!! $v_value !!} }}</div>
<div class="text-left" style="padding: 4px;" v-if="'_rank' in records[index]">
    <b class="highlight">@{{ '_rank' in records[index] ? records[index]['_rank'].toFixed(2) : '' }}</b>&nbsp;&nbsp;
    <span style="font-size: 0.85em; font-style: italic; ">
        (@lang('imet-core::v2_context.EcosystemServices.fields.Importance'): <b>@{{ records[index]['_Importance'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.EcosystemServices.fields.ImportanceRegional'): <b>@{{ records[index]['_ImportanceRegional'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.EcosystemServices.fields.ImportanceGlobal'): <b>@{{ records[index]['_ImportanceGlobal'] }}</b>)
    </span>
</div>
