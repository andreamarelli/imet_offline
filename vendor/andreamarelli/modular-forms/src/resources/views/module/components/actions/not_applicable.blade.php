<?php
use AndreaMarelli\ModularForms\View\Module\Container;

?>

@if($definitions['enable_not_applicable'])

    {{-- #### Not applicable #### --}}
    <div id="applicable-{{ $definitions['module_key'] }}"
         v-show=!isNotAvailable
         style="display: inline-block; margin-right: 30px;">
        <label for="not_applicable">@lang('modular-forms::common.form.applicable')</label>
        <input type="checkbox"
               :checked=isNotApplicable
               v-on:change="toggleNotApplicable()"
        />
        <tooltip>
            @uclang('modular-forms::common.form.applicable_tooltip')
        </tooltip>
    </div>

    {{-- #### Not avalibale #### --}}
    <div id="available-{{ $definitions['module_key'] }}"
         v-show=!isNotApplicable
         style="display: inline-block; margin-right: 30px;">
        <label for="not_available">@lang('modular-forms::common.form.not_available')</label>
        <input type="checkbox"
               :checked=isNotAvailable
               v-on:change="toggleNotAvailable()"
        />
        <tooltip>
            @uclang('modular-forms::common.form.available_tooltip')
        </tooltip>
    </div>

@endif

