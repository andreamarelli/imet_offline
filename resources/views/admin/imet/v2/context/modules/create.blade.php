<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = 0;

?>


@foreach($definitions['fields'] as $i=>$field)

    @if($i!=3)

        @component('admin.components.module.components.row', [
                'name' => $field['name'],
                'label' => isset($field['label']) ? $field['label'] : '',
                'label_width' => $definitions['label_width']
            ])

            {{-- input field --}}
            @include('admin.components.module.edit.field.auto_vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

        @endcomponent

    @endif

@endforeach

<div class="module-row" v-if="available_years!==null">

    {{-- label  --}}
    <div class="module-row__label">
        <label for="prev_year_selector">{!! ucfirst(trans('form/imet/v2/common.prefill_prev_year')) !!}</label>
    </div>

    {{-- input field --}}
    <div  class="module-row__input">
        <toggle
            :data-values=JSON.stringify(available_years)
            id="prev_year_selector"
            v-model=prev_year_selection
        ></toggle>
    </div>

</div>

<div class="module-row" v-if="show_language">

    {{-- label  --}}
    <div class="module-row__label">
        <label for="{{ $definitions['fields'][3]['name'] }}">{!! ucfirst($definitions['fields'][3]['label']) !!}</label>
    </div>

    {{-- input field --}}
    <div class="module-row__input">
        @include('admin.components.module.edit.field.auto_vue', [
            'definitions' => $definitions,
            'field' => $definitions['fields'][3],
            'vue_record_index' => $vue_record_index
        ])
    </div>

</div>

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            props: {
                current_year: {
                    type: String,
                    default: null
                },
                current_pa: {
                    type: String,
                    default: null
                },
                available_years: {
                    type: [Array, Object],
                    default: () => null
                },
                prev_year_selection: {
                    type: String,
                    default: null
                },
                show_language:{
                    type: Boolean,
                    default: true
                }
            },

            watch: {
                prev_year_selection(value){
                    if(value===null || value==='no_import'){
                        this.show_language = true;
                    } else {
                        this.show_language = false;
                        this.records[0]['language'] = null;
                    }
                    this.records[0]['prev_year_selection'] = value;
                    this.showSaveBar();
                }
            },

            methods: {

                recordChangedCallback(){
                    if(this.current_pa !== this.records[0]['wdpa_id']
                        || this.current_year !== this.records[0]['Year']){
                        this.prev_year_selection = null;

                        this.current_year = this.records[0]['Year'];
                        this.current_pa = this.records[0]['wdpa_id'];
                        if(this.current_year!==null && this.current_pa!==null){
                            this.retrievePreviousYears();
                        } else if(this.current_year===null && this.current_pa===null) {
                            this.available_years = null;
                        }
                    }
                    this.showSaveBar();
                },

                showSaveBar(){
                    let _this = this;
                    Vue.nextTick(function () {
                        if(_this.current_year!==null && _this.current_pa!==null &&
                            (_this.prev_year_selection!=null
                                || (_this.prev_year_selection===null && _this.available_years===null))){
                            _this.status = 'changed';
                        } else{
                            _this.status = 'init';
                        }
                    });
                },

                retrievePreviousYears(){
                    let _this = this;
                    _this.available_years = null;

                    window.axios({
                        method: 'post',
                        url: '{{ action([\App\Http\Controllers\Imet\ImetControllerV2::class, 'retrieve_prev_years']) }}',
                        data: {
                            _token: window.Laravel.csrfToken,
                            year: _this.records[0]['Year'],
                            wdpa_id: _this.records[0]['wdpa_id']
                        }
                    })
                        .then(function (response) {
                            if(Object.values(response.data).length>0){
                                _this.available_years = response.data;
                                _this.available_years['no_import'] = 'No';
                            } else{
                                _this.available_years = null;
                            }
                            _this.showSaveBar();
                        })
                        .catch(function (response) {
                        })
                        .finally(function (response) {});
                }


            }

        });
    </script>
@endpush


