<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\AssistanceActivities;
use Illuminate\Support\Facades\View;

$vue_data['marine_predefined'] = AssistanceActivities::get_marine_predefined();
$vue_data['terrestrial_predefined'] = AssistanceActivities::get_terrestrial_predefined();

$view = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::TERRESTRIAL, $view, "is_terrestrial(item['Activity'])");
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view, "is_marine(item['Activity'])");

?>

{!! $view !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##cont
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {
                is_marine(value){
                    return this.marine_predefined.includes(value);
                },
                is_terrestrial(value){
                    return this.terrestrial_predefined.includes(value);
                }
            }

        });
    </script>
@endpush