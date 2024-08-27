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
        (@lang('imet-core::v2_context.MenacesPressions.fields.Impact'): <b>@{{ records[index]['_Impact'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.MenacesPressions.fields.Extension'): <b>@{{ records[index]['_Extension'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.MenacesPressions.fields.Duration'): <b>@{{ records[index]['_Duration'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.MenacesPressions.fields.Trend'): <b>@{{ records[index]['_Trend'] }}</b>,&nbsp;&nbsp;
        @lang('imet-core::v2_context.MenacesPressions.fields.Probability'): <b>@{{ records[index]['_Probability'] }}</b>)
    </span>
</div>
