<?php
/** @var String $value */

?>
<label class="radio-inline">
    <input disabled {{ $value=='terrestrial' ? 'checked="checked"' : '' }} type="radio" value="terrestrial" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.terrestrial')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.terrestrial') }}</i></p>

<label class="radio-inline">
    <input disabled {{ $value=='marine_and_coastal' ? 'checked="checked"' : '' }} type="radio" value="marine_and_coastal" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.marine_and_coastal')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.marine_and_coastal') }}</i></p>

<label class="radio-inline">
    <input disabled {{ $value=='oecm_terrestrial' ? 'checked="checked"' : '' }} type="radio" value="oecm_terrestrial" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.oecm_terrestrial')) }}
</label>
<br />
<label class="radio-inline">
    <input disabled {{ $value=='oecm_marine' ? 'checked="checked"' : '' }} type="radio" value="oecm_marine" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.oecm_marine')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.oecm') }}</i></p>

<label class="radio-inline">
    <input disabled {{ $value=='icca_terrestrial' ? 'checked="checked"' : '' }} type="radio" value="icca_terrestrial" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.icca_terrestrial')) }}
</label>
<br />
<label class="radio-inline">
    <input disabled {{ $value=='icca_marine' ? 'checked="checked"' : '' }} type="radio" value="icca_marine" />
    {{ ucfirst(trans('imet-core::v2_lists.PaType.icca_marine')) }}
</label>
<p class="max-w-3xl text-zinc-400 text-sm pl-5 pb-3"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.icca') }}</i></p>

