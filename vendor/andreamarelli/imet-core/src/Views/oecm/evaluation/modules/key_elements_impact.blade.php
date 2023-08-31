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

    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),


            methods:{

                recordChangedCallback(){
                    let _this = this;
                    console.log('changes', this.records);

                    Object.entries(this.records).forEach(([group_key, group]) => {
                        Object.entries(group).forEach(([record_index, record]) => {
                            _this.records[group_key][record_index]['EffectSH']
                                = _this.calculate_effect(record['StatusSH'],  record['TrendSH']);
                            _this.records[group_key][record_index]['EffectER']
                                = _this.calculate_effect(record['StatusER'],  record['TrendER']);
                        });
                    });
                },

                calculate_effect(status, trend){
                    let effect = null;
                    if(status!==null || trend!==null){
                        // average
                        effect = (
                            (status!==null ? parseFloat(status): 0) +
                            (trend!==null ? parseFloat(trend): 0)
                        ) / (status!==null && trend!==null ? 2 : 1);
                        // rescale scale -100 to 100
                        effect = effect * 100 / 2;
                    }
                    return effect;
                }

            }

        });
    </script>
@endpush
