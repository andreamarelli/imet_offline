<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

class ThreatsBiodiversity extends Modules\Component\ImetModule_Eval {

    protected $table = 'imet_oecm.eval_threats_biodiversity';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C3.1.1';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.title');
        $this->module_fields = [
            ['name' => 'Criteria',  'type' => 'disabled',                           'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Criteria')],
            ['name' => 'Threats',   'type' => 'dropdown_multiple-ImetOECM_Threats', 'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Threats')],
            ['name' => 'Note',      'type' => 'text-area',                          'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Note')],
        ];



        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group2'),
        ];

        $this->module_info = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.module_info');

        parent::__construct($attributes);
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        // Inject additional predefined values (last 3 groups) retrieved from CTX
        $predefined_values = [
            'field' => 'Criteria',
            'values' => [],
        ];

        $predefined_values['values']['group0'] =
            Modules\Context\AnimalSpecies::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['species']);
                })
                ->pluck('species')
                ->map(function ($item) {
                    return Str::contains($item, '|')
                        ? Animal::getScientificName($item)
                        : $item;
                })
                ->toArray();

        $predefined_values['values']['group1'] =
            Modules\Context\VegetalSpecies::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['species']);
                })
                ->pluck('species')
                ->toArray();

        $predefined_values['values']['group2'] =
            Modules\Context\Habitats::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['EcosystemType']);
                })
                ->pluck('EcosystemType')
                ->map(function ($item) {
                    $labels = SelectionList::getList('ImetOECM_Habitats');
                    return array_key_exists($item, $labels) ?
                        $labels[$item]
                        : null;
                })
                ->toArray();

        return parent::arrange_records($predefined_values, $records, $empty_record);
    }


}