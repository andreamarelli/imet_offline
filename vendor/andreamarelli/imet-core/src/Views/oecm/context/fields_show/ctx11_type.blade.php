<div class="field-preview">

    @if($value==='terrestrial')
        {{ trans('imet-core::oecm_lists.PaType.terrestrial') }}
    @elseif($value==='marine_and_coastal')
        {{ trans('imet-core::oecm_lists.PaType.marine_and_coastal') }}
    @elseif($value==='mixed')
        {{ trans('imet-core::oecm_lists.PaType.mixed') }}
    @endif

</div>