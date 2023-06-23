<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


?>

@foreach($definitions['groups'] as $group_key => $group_label)
    <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

    <div id="{{ 'group_table_'.$definitions['module_key'].'_'.$group_key }}">

        {{-- labels  --}}
        <div class="grid_module">
            <div class="text-center"><b>{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</b></div>
            <div></div>
            <div class="text-center"><b>{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</b></div>
            <div class="text-center"><b>{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</b></div>
            <div class="text-center"><b>{{ ucfirst($definitions['fields'][3]['label'] ?? '') }}</b></div>
            <div class="text-center"><b>{{ ucfirst($definitions['fields'][4]['label'] ?? '') }}</b></div>
            <div class="text-center"><b>{{ ucfirst($definitions['fields'][5]['label'] ?? '') }}</b></div>
        </div>

        {{-- records --}}
        <div class="{{ $group_key }}">
            <div class="grid_module"
                 v-for="(item, index) in records['{{ $group_key }}']"
            >

                <div style="grid-row-start: 1; grid-row-end: span 2;">
                    @include('modular-forms::module.edit.field.module-to-vue', [
                        'definitions' => $definitions,
                        'field' => $definitions['fields'][0],
                        'vue_record_index' => 'index',
                        'group_key' => $group_key
                    ])
                    @include('modular-forms::module.edit.field.vue', [
                        'type' => 'hidden',
                        'v_value' => 'item.'.$definitions['primary_key']
                    ])
                </div>

                <div class="text-center"><b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.from_sa')</b></div>
                @for ($i = 1; $i <= 5; $i++)
                    <div>
                        @include('modular-forms::module.edit.field.module-to-vue', [
                           'definitions' => $definitions,
                           'field' => $definitions['fields'][$i],
                           'vue_record_index' => 'index',
                           'group_key' => $group_key
                       ])
                    </div>
                @endfor

                <div class="text-center"><b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.from_external_source')</b></div>
                @for ($i = 6; $i <= 10; $i++)
                    <div>
                        @include('modular-forms::module.edit.field.module-to-vue', [
                           'definitions' => $definitions,
                           'field' => $definitions['fields'][$i],
                           'vue_record_index' => 'index',
                           'group_key' => $group_key
                       ])
                    </div>
                @endfor

            </div>
        </div>

        <br />
        <br />

    </div>

@endforeach

@push('scripts')
    <style>
        .grid_module{
            display: grid;
            grid-template-columns: 170px 130px 122px 122px 120px 120px auto;
            column-gap: 10px;
            row-gap: 10px;
            border-bottom: 1px solid #A3A3A3;   /* $gray-400; */
            padding: 5px;
        }

        .grid_module div{
            align-self: center;
        }
    </style>
@endpush

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
