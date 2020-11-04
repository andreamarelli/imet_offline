<?php
/** @var String $step */
/** @var int $item_id */

$assessment_step = json_decode(\App\Http\Controllers\Imet\ImetEvalControllerV1::assessment($item_id, $step, true)->getContent());

?>

<div id="assessment_step_{{ $step }}">
    <h5>@lang('form/imet/v1/common.steps_eval.'.$step)</h5>

    <div class="row">
        <div class="col-lg-8 step_indicators">
            {{-- Step related statistics --}}
            <div class="row" v-for="(item, index) in values">
                <div class="col-lg-1 text-center text-uppercase"><b>@{{ labels[index].code }}</b></div>
                <div class="col-lg-4 text-left">@{{ labels[index].title }}</div>
                <div class="col-lg-7 text-left">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped"
                             role="progressbar"
                             :class="[item>0 ? '' : 'progress-bar-negative']"
                             :style="{ width:  Math.abs(item) + '%', backgroundColor: step_color}">
                            <span v-if="item!==null">@{{ item }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 synthetic_indicator">
            {{-- Step synthetic indicator --}}
            <b class="text-uppercase">@lang('form/imet/v1/common.synthetic_indicator')</b>
            <div class="progress">
                <div class="progress-bar progress-bar-striped"
                     role="progressbar"
                     :style="{ width:  Math.abs(api_data.avg_indicator) + '%', backgroundColor: step_color}">
                    <span v-if="synthetic_indicator!==null">@{{ synthetic_indicator }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row" v-if="current_step==='context' || current_step==='process'">
        <br />
        <div class="col-lg-8 step_indicators">
            {{-- Step related statistics --}}
            <div class="row" v-for="(item, index) in intermediate_values">
                <div class="col-lg-1 text-center text-uppercase"><b>@{{ labels[index].code }}</b></div>
                <div class="col-lg-4 text-left">@{{ labels[index].title }}</div>
                <div class="col-lg-7 text-left">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped"
                             role="progressbar"
                             :style="{ width: Math.abs(item) + '%', backgroundColor: step_color}">
                            <span v-if="item!==null">@{{ item }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<style>
    .progress{
        margin: 2px 0;
    }
    .progress-bar{
        color: #000000;
        font-weight: bold;
    }
    .progress-bar-negative{
        display: block;
        float: right;
    }
    .synthetic_indicator{
        font-size: 1.2em;
    }
</style>

<script>

    new Vue({
        el: '#assessment_step_{{ $step }}',

        data: {
            api_data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($assessment_step) !!}'),
            api_labels: null,
            current_step: '{{ $step }}',
            form_id: '{{ $item_id }}',
            step_indexes: [],
            step_indexes_intermediate: [],
            step_color: '#000'
        },

        beforeMount(){
            this.api_labels = this.api_data.labels;
        },

        mounted(){
            let _this = this;
            _this.init_properties();
            window.vueBus.$on('refresh_assessment', function(){
                _this.refresh_values();
            });
        },

        computed: {
            labels(){
                let _this = this;
                let labels = {};
                Object.entries(_this.api_labels).forEach(function (item) {
                    labels[item[0]] = {
                        code: item[1]['code_label'],
                        title: item[1]['title_fr']
                    }
                });
                return labels;
            },
            values(){
                let _this = this;
                let values = {};
                _this.step_indexes.forEach(function (index) {
                    values[index] = _this.get_key_from_api(index);
                });
                return values;
            },
            intermediate_values(){
                let _this = this;
                let values = {};
                if(_this.step_indexes_intermediate.length>0){
                    _this.step_indexes_intermediate.forEach(function (index) {
                        values[index] = _this.get_key_from_api(index);
                    });
                }
                return values;
            },
            synthetic_indicator(){
                return this.get_key_from_api('avg_indicator');
            }
        },

        methods: {

            init_properties: function(){
                let _this = this;
                switch(_this.current_step) {
                    case 'context':
                        _this.step_indexes = ['c1', 'c2', 'c3'];
                        _this.step_indexes_intermediate = ['c11', 'c12', 'c13', 'c14', 'c15', 'c16'];
                        _this.step_color = '#FFFF00';
                        break;
                    case 'planning':
                        _this.step_indexes = ['p1', 'p2', 'p3', 'p4', 'p5', 'p6'];
                        _this.step_color = '#BFBFBF';
                        break;
                    case 'inputs':
                        _this.step_indexes = ['i1', 'i2', 'i3', 'i4', 'i5'];
                        _this.step_color = '#FFC000';
                        break;
                    case 'process':
                        _this.step_indexes = [
                            'pr1', 'pr2', 'pr3', 'pr4', 'pr5', 'pr6', 'pr7', 'pr8', 'pr9', 'pr10',
                            'pr11', 'pr12', 'pr13', 'pr14', 'pr15', 'pr16', 'pr17', 'pr18', 'pr19'
                        ];
                        _this.step_indexes_intermediate = ['pr1_6', 'pr7_10', 'pr11_13', 'pr14_15', 'pr16_17', 'pr18_19'];
                        _this.step_color = '#00B0F0';
                        break;
                    case 'outputs':
                        _this.step_indexes = ['r1', 'r2'];
                        _this.step_color = '#92D050';
                        break;
                    case 'outcomes':
                        _this.step_indexes = ['ei1', 'ei2', 'ei3', 'ei4', 'ei5', 'ei6'];
                        _this.step_color = '#00B050';
                        break;
                }
            },

            get_key_from_api(key){
                return this.api_data.hasOwnProperty(key) && this.api_data[key]!==null
                    ? this.api_data[key].toFixed(1)
                    : null;
            },

            refresh_values: function(){
                let _this = this;

                $.ajax({
                    url: window.Laravel.baseUrl + 'api/imet/assessment/'+_this.form_id+'/'+_this.current_step,
                    type: "GET",
                    dataType: "json"
                })
                    .done(function (response) {
                        _this.api_data = response;
                    });

            }
        }

    });

</script>
