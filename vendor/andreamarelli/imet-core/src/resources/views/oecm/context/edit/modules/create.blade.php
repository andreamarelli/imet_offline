<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use Illuminate\Database\Eloquent\Collection;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */
/** @var Controller $controller */   // ATTENTION: not directly passed the parent blade, but anyway available

$vue_record_index = 0;

$vueData['previous_url'] = route($controller::ROUTE_PREFIX . 'retrieve_prev_years');

?>


@foreach($definitions['fields'] as $i=>$field)

    @component('modular-forms::module.components.field_container', [
        'name' => $field['name'],
        'label' => $field['label'] ?? '',
        'label_width' => $definitions['label_width']
    ])

        @if($field['name']==='language')

            <div v-if="show_language">
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $field,
                    'vue_record_index' => $vue_record_index
                ])
            </div>
            <div v-else>
                <span class="toggle">
                    <span role="group" class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-sm act-btn-lighter act-btn-basic"> - </button>
                    </span>
                </span>
            </div>

        @else

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

        @endif

    @endcomponent

@endforeach

{{--  #########  Previous year selector  #########  --}}
<div class="module-row" v-if="retrieving_years || available_years!==null" style="margin: 40px 0px 20px 0;">

    {{--  label  --}}
    <div class="module-row__label text-lg text-primary-800" style="width: 40%;">
        <label for="prev_year_selector">{!! ucfirst(trans('imet-core::common.Create.fields.prefill_prev_year')) !!}
            ?</label>
    </div>

    {{--  loading..  --}}
    <div class="module-row__input" v-if="retrieving_years">
        <i class="fa fa-spinner fa-spin fa-2x text-primary-800"></i>
    </div>

    {{--  selector  --}}
    <div class="module-row__input" v-if="available_years!==null">
        <toggle
                :data-values=JSON.stringify(available_years)
                id="prev_year_selector"
                v-model=prev_year_selection
        ></toggle>
    </div>

</div>



@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.Create(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush


