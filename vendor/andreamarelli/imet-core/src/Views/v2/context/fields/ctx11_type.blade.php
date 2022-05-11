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
    {{ trans('imet-core::v2_lists.PaType.terrestrial') }}
</label>
<p class="type_desc gray-400 text-sm"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.terrestrial') }}</i></p>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="marine_and_coastal" />
    {{ trans('imet-core::v2_lists.PaType.marine_and_coastal') }}
</label>
<p class="type_desc gray-400 text-sm"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.marine_and_coastal') }}</i></p>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="oecm_terrestrial" />
    {{ trans('imet-core::v2_lists.PaType.oecm_terrestrial') }}
</label>
<br />
<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="oecm_marine" />
    {{ trans('imet-core::v2_lists.PaType.oecm_marine') }}
</label>
<p class="type_desc gray-400 text-sm"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.oecm') }}</i></p>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="icca_terrestrial" />
    {{ trans('imet-core::v2_lists.PaType.icca_terrestrial') }}
</label>
<br />
<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="icca_marine" />
    {{ trans('imet-core::v2_lists.PaType.icca_marine') }}
</label>
<p class="type_desc gray-400 text-sm"><i>{{ trans('imet-core::v2_context.GeneralInfo.type_info.icca') }}</i></p>


@push('scripts')
    <style>
        .type_desc{
            max-width: 800px;
        }
    </style>
@endpush

