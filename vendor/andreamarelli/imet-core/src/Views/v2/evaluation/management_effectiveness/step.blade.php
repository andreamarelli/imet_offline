<?php

use AndreaMarelli\ImetCore\Services\Assessment\ImetAssessment;

/** @var String $step */
/** @var int $item_id */

$assessment_step = ImetAssessment::getAssessment($item_id, $step);

?>


<div id="assessment_step_{{ $step }}" class="assessment_step">
    <h5>@lang('imet-core::common.steps_eval.'.$step)</h5>


    @if($step=='context')

        {{-- C11->C15 statistics --}}
        <div style="margin-bottom: 20px;">
            <div v-for="(item, index) in intermediate_values">
                @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100', 'values' => 'intermediate_values'])
            </div>
        </div>

        {{-- C1->C3 statistics --}}
        <div style="margin-bottom: 30px;">
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100', 'values' => 'values', 'index' => 'c1'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_100', 'values' => 'values', 'index' => 'c2'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_0', 'values' => 'values', 'index' => 'c3'])</div>
        </div>

    @elseif($step=='process')

        {{-- Step related statistics --}}
        <div style="margin-bottom: 20px;">
            <div v-for="(item, index) in values">
                @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100_full_width', 'values' => 'values'])
            </div>
        </div>

        <div style="margin-bottom: 30px;">
            <div id="imet_process_radar" style="height: 250px;"></div>
        </div>

    @elseif($step=='outcomes')

        {{-- Step related statistics --}}
        <div style="margin-bottom: 20px;">
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100', 'values' => 'values', 'index' => 'oc1'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_100', 'values' => 'values', 'index' => 'oc2'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_100', 'values' => 'values', 'index' => 'oc3'])</div>
        </div>

    @else

        {{-- Step related statistics --}}
        <div style="margin-bottom: 30px;">
            <div v-for="(item, index) in values">
                @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100_full_width', 'values' => 'values'])
            </div>
        </div>

    @endif

    {{-- Step synthetic indicator --}}
    <div style="padding-top: 20px; border-top: 1px solid #aaa;">
        <div>
            @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100_full_width', 'synthetic_indicator' => true])
        </div>
    </div>

</div>


<script>

    new Vue({
        el: '#assessment_step_{{ $step }}',

        data: {
            api_data: @json($assessment_step),
            api_labels: null,
            current_step: '{{ $step }}',
            form_id: '{{ $item_id }}',
            step_indexes: [],
            step_indexes_intermediate: [],
            step_color: '#000',
            chart: null
        },

        beforeMount() {
            this.api_labels = this.api_data.labels;
        },

        mounted() {
            let _this = this;
            _this.init_properties();

            if (_this.current_step === 'process') {
                _this.chart = echarts.init(document.getElementById('imet_process_radar'));
                if (_this.chart !== null) {
                    _this.chart.setOption(_this.get_radar_options());
                }
            }

            window.vueBus.$on('refresh_assessment', function () {
                _this.refresh_values();
            });
        },

        computed: {
            labels() {
                let _this = this;
                let labels = {};
                if (this.api_labels !== null) {
                    Object.entries(_this.api_labels).forEach(function (item) {
                        labels[item[0]] = {
                            code: item[1]['code_label'],
                            title: item[1]['title_' + Locale.getLocale()],
                            min: 0,
                            max: 100
                        };
                        if (labels[item[0]].code === 'C2' || labels[item[0]].code === 'C3') {
                            labels[item[0]].min = -100;
                        }
                    });
                }
                return labels;
            },
            values() {
                let _this = this;
                let values = {};
                _this.step_indexes.forEach(function (index) {
                    values[index] = _this.get_key_from_api(index);
                });
                return values;
            },
            intermediate_values() {
                let _this = this;
                let values = {};
                if (_this.step_indexes_intermediate.length > 0) {
                    _this.step_indexes_intermediate.forEach(function (index) {
                        values[index] = _this.get_key_from_api(index);
                    });
                }
                return values;
            },
            synthetic_indicator() {
                return this.get_key_from_api('avg_indicator');
            }
        },

        methods: {

            init_properties: function () {
                let _this = this;
                switch (_this.current_step) {
                    case 'context':
                        _this.step_indexes = ['c1', 'c2', 'c3'];
                        _this.step_indexes_intermediate = ['c11', 'c12', 'c13', 'c14', 'c15'];
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
                            'pr11', 'pr12', 'pr13', 'pr14', 'pr15', 'pr16', 'pr17', 'pr18'
                        ];
                        _this.step_indexes_intermediate = ['pr1_6', 'pr7_9', 'pr10_12', 'pr13_14', 'pr15_16', 'pr17_18'];
                        _this.step_color = '#00B0F0';
                        break;
                    case 'outputs':
                        _this.step_indexes = ['op1', 'op2', 'op3', 'op4'];
                        _this.step_color = '#92D050';
                        break;
                    case 'outcomes':
                        _this.step_indexes = ['oc1', 'oc2', 'oc3'];
                        _this.step_color = '#00B050';
                        break;
                }
            },

            get_key_from_api(key) {
                return this.api_data.hasOwnProperty(key) && this.api_data[key] !== null
                    ? this.api_data[key].toFixed(1)
                    : null;
            },

            refresh_values: function () {
                let _this = this;

                window.axios({
                    url: '{{ route('imet_core::api::assessment', ['item' => '__id__', 'step' => '__step__']) }}'
                        .replace('__id__', _this.form_id)
                        .replace('__step__', _this.current_step),
                    method: "get",
                })
                    .then(function (response) {
                        _this.api_data = response.data;
                        if (_this.chart !== null) {
                            _this.chart.setOption(_this.get_radar_options());
                        }
                    });

            },

            get_radar_options: function () {
                let _this = this;

                let values = Object.values(this.intermediate_values).reverse();

                let indicator = [];
                Object.keys(this.intermediate_values).reverse().forEach(function (code) {
                    indicator.push({text: _this.labels[code].title, max: 100});
                });

                return {
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: [_this.api_data.name]
                    },
                    radar: {
                        indicator: indicator,
                        radius: 80,
                        startAngle: 150,
                        center: ['50%', '55%'],
                        name: {
                            textStyle: {
                                color: '#111'
                            }
                        },
                    },

                    series: [
                        {
                            type: 'radar',
                            data: [
                                {
                                    value: values,
                                    itemStyle: {
                                        color: '#7CB5EC'
                                    },
                                    areaStyle: {
                                        color: '#7CB5EC',
                                        opacity: 0.4,
                                    },
                                    symbolSize: 6,
                                    name: _this.api_data.name,
                                    label: {
                                        normal: {
                                            fontWeight: 'bold',
                                            color: '#222',
                                            show: true,
                                            formatter: function (params) {
                                                return params.value;
                                            }
                                        }
                                    }
                                }
                            ]
                        }
                    ]
                };
            }
        }

    });

</script>
