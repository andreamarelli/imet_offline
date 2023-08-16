<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$threats = trans('imet-core::oecm_lists.Threats');
$vue_data['threats'] = $threats;

?>

<div>
    @foreach($threats as $threat_key => $threat_label)
        <div class="histogram-row">
            <div class="histogram-row__title text-left">{{ $threat_label }}</div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                <b v-html="threat_stats['{{ $threat_key }}'] || '-'"></b>
            </div>
            <div class="histogram-row__progress-bar"  v-if="threat_stats['{{ $threat_key }}']!==null">
                <div class="histogram-row__progress-bar__limit-left">-100%</div>
                <div class="histogram-row__progress-bar__bar">
                    <div class="progress">
                        <div role="progressbar"
                             class="progress-bar progress-bar-striped  progress-bar-negative"
                             :style="'width: ' + Math.abs(threat_stats['{{ $threat_key }}']) + '%; background-color: #87c89b !important;'">
                            <span v-html="'-' +threat_stats['{{ $threat_key }}']"></span>
                        </div>
                    </div>
                </div>
                <div class="histogram-row__progress-bar__limit-right">0%</div>
            </div>
        </div>

    @endforeach
</div>

@include('modular-forms::module.edit.type.table', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            computed:{

                threat_stats(){
                    let _this = this;
                    let stats = {};

                    Object.entries(_this.threats).forEach(([key, value]) => {
                        let stat = null;

                        _this.records.forEach(function(record){
                            if(record['__threat_key'] === key){
                                let prod = 1
                                    * (record['Impact']!==null ? 4-record['Impact'] : 1)
                                    * (record['Extension']!==null ? 4-record['Extension'] : 1)
                                    * (record['Duration']!==null ? 4-record['Duration'] : 1)
                                    * (record['Trend']!==null ?(5/2 - record['Trend']*3/4) : 1)
                                    * (record['Probability']!==null ? 4-record['Probability'] : 1);
                                let count = 1
                                    * (record['Impact']!==null ? 1 : 0)
                                    * (record['Extension']!==null ? 1 : 0)
                                    * (record['Duration']!==null ? 1 : 0)
                                    * (record['Trend']!==null ? 1 : 0)
                                    * (record['Probability']!==null ? 1 : 0);

                                let score = count>0
                                    ? (4 - Math.pow(prod, 1/count))
                                    : null;

                                score = score!==null
                                    ? ((0 - score) * 100 / 3).toFixed(2)
                                    : null;

                                stats[key] = score;
                            }
                        })

                    });


                    return stats;
                }
            },

            methods:{

                __get_index(element_id){
                    return element_id.replace(this.module_key, '').replace('Value', '').replaceAll('_', '');
                },

                threats_elements(element_id){
                    let index =  this.__get_index(element_id);

                    let num_stakeholders = this.records[index]['__num_stakeholders'];
                    let elements = this.records[index]['__elements'];
                    let elements_illegal = this.records[index]['__elements_illegal'];

                    let label = '';
                    if(num_stakeholders!==null){
                        label =
                            Locale.getLabel('imet-core::oecm_evaluation.Threats.stakeholders', {'num': '<b>' + num_stakeholders + '</b>'})
                            + '<br />'
                            + 'Listed elements: <ul>';
                        let list = '';

                        for (const [_, elem] of Object.entries(elements_illegal)) {
                            if(elem.length>0){
                                list += '<b style="color: red;">' + elem.join(', ') + '</b>';
                            }
                        }
                        for (const [_, elem] of Object.entries(elements)) {
                            if(elem.length>0){
                                if (list !== ''){
                                    list += ', ';
                                }
                                list += elem.join(', ');
                            }
                        }
                        if (list !== ''){
                            label += '<li>' + list + '</li>';
                        }
                        label += '</ul>';
                    }
                    return label;
                }

            }

        });
    </script>
@endpush
