<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = 0;

?>


@foreach($definitions['fields'] as $i=>$field)

    @component('admin.components.module.components.row', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])

        @if($field['name']==='language')

            <div v-if="show_language">
                @include('admin.components.module.edit.field.auto_vue', [
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
            @include('admin.components.module.edit.field.auto_vue', [
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
    <div class="module-row__label text-lg green_dark" style="width: 40%;" >
        <label for="prev_year_selector">{!! ucfirst(trans('form/imet/v2/context.Create.fields.prefill_prev_year')) !!} ?</label>
    </div>

    {{--  loading..  --}}
    <div  class="module-row__input" v-if="retrieving_years">
        <i class="fa fa-spinner fa-spin fa-2x green_dark"></i>
    </div>

    {{--  selector  --}}
    <div  class="module-row__input" v-if="available_years!==null">
        <toggle
            :data-values=JSON.stringify(available_years)
            id="prev_year_selector"
            v-model=prev_year_selection
        ></toggle>
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
                },
                retrieving_years:{
                    type: Boolean,
                    default: false
                }
            },
            watch: {
                prev_year_selection(value){
                    if(value===null || value==='no_import'){
                        this.show_language = true;
                    } else {
                        this.show_language = false;
                    }
                    let record =  this.records[0];
                    record['prev_year_selection'] = value;
                    this.$set(this.records, 0, record);
                },
                records: {
                    handler: async function () {
                        await this.recordChangedCallback();
                        if (this.status !== 'init') {
                            let _this = this;
                            _this.status = (_this.status !== 'changed') ? 'changed' : _this.status;
                            _this.__sync_common_fields();
                        }
                    },
                    deep: true
                }
            },

            methods: {

                async recordChangedCallback(){
                    // empty prev_year_selection if wdpa or year changes
                    if(this.current_pa !== this.records[0]['wdpa_id'] &&
                        this.current_year !== this.records[0]['Year']
                    ){
                        this.prev_year_selection = null;
                        this.available_years = null;
                    }

                    // retrieve prev_year_selection
                    if(![null, ""].includes(this.records[0]['wdpa_id']) &&
                        ![null, ""].includes(this.records[0]['Year']) &&
                        (this.current_pa !== this.records[0]['wdpa_id'] ||
                            this.current_year !== this.records[0]['Year'])
                    ){
                        try {
                            const response = await this.retrievePreviousYears();
                            this.retrieving_years = false;
                            if (Object.values(response.data).length > 0) {
                                this.parseAvailableYears(response.data);
                            } else {
                                this.available_years = null;
                            }
                        }
                        catch(e){
                            this.retrieving_years = false;
                            this.available_years = null;
                        }
                    }


                    // show SAVE bar only when all fields have been selected
                    if(![null, ""].includes(this.records[0]['Year']) &&
                        ![null, ""].includes(this.records[0]['wdpa_id']) &&
                        (
                            (this.prev_year_selection==='no_import' && this.records[0]['language']!==null) ||
                            (this.prev_year_selection!=='no_import' && this.prev_year_selection!==null) ||
                            (this.available_years === null && this.records[0]['language']!==null)
                        )
                    ){
                        this.status = 'idle';
                    } else {
                        this.status = 'init';
                    }

                    // store selections
                    this.current_pa = this.records[0]['wdpa_id'];
                    this.current_year = this.records[0]['Year'];
                },

               resetModuleCallback(){
                    this.reset_status = 'init';
               },

                async retrievePreviousYears(){
                    let _this = this;
                    _this.available_years = null;
                    _this.retrieving_years = true;

                    return window.axios({
                        method: 'post',
                        url: '{{ action([\App\Http\Controllers\Imet\ImetControllerV2::class, 'retrieve_prev_years']) }}',
                        data: {
                            _token: window.Laravel.csrfToken,
                            year: _this.records[0]['Year'],
                            wdpa_id: _this.records[0]['wdpa_id']
                        }
                    })
                },

                parseAvailableYears(data){
                    let _this = this;
                    this.available_years = data;
                    this.available_years['no_import'] = 'No';

                    let years = Object.values(this.available_years);
                    let duplicates = this.foundDuplicates(years);
                    Object.keys(this.available_years).forEach(function(key){
                        if(duplicates.includes(_this.available_years[key])){
                            _this.available_years[key] = _this.available_years[key] + ' (IMET #' + key + ')';
                        }

                    });


                    console.log(this.available_years);
                },

                foundDuplicates(list){
                    let sorted_arr = list.slice().sort();
                    let results = [];
                    for (let i = 0; i < sorted_arr.length - 1; i++) {
                        if (sorted_arr[i + 1] === sorted_arr[i]) {
                            results.push(sorted_arr[i]);
                        }
                    }
                    return results;
                }


            }

        });
    </script>
@endpush


