<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$view_groupTable = View::make('admin.components.module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

// Inject Average calculation to "EvaluationScore" column
$view_groupTable = App\Library\Ofac\Module::injectAverageInGroup($view_groupTable, 'group0', 3, 2);
$view_groupTable = App\Library\Ofac\Module::injectAverageInGroup($view_groupTable, 'group1', 3, 2);


?>

{!! $view_groupTable !!}
@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

            computed: {
                averages(){
                    let _this = this;
                    let averages = [];
                    Object.keys(_this.records).forEach(function(group){
                        averages[group] = _this.calculateAverage('EvaluationScore', group);
                    });
                    return averages;
                }
            }

        });
    </script>
@endpush
