<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */



?>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="terrestrial" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.terrestrial')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.terrestrial') }}</i></p>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="marine_and_coastal" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.marine_and_coastal')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.marine_and_coastal') }}</i></p>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="oecm_terrestrial" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.oecm_terrestrial')) }}
</label>
<br />
<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="oecm_marine" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.oecm_marine')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.oecm') }}</i></p>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="icca_terrestrial" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.icca_terrestrial')) }}
</label>
<br />
<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="icca_marine" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.icca_marine')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.icca') }}</i></p>

