<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\RegulationsAdequacy;
use Illuminate\Support\Facades\View;

$vue_data['marine_predefined'] = RegulationsAdequacy::get_marine_predefined();
$view = View::make('modular-forms::module.edit.type.table', compact(['collection', 'vue_data', 'definitions']))->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view, "is_marine(item['Regulation'])");

?>

{!! $view !!}


@push('scripts')
    <script>
        // ## Initialize Module controller ##cont
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {
                is_marine(value){
                    return this.marine_predefined.includes(value);
                }
            }

        });
    </script>
@endpush
