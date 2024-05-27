<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class BoundaryLevel extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_boundary_level_v2';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public static $rules = [
        'Boundaries'       => 'required'
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P3';
        $this->module_title = trans('imet-core::v2_evaluation.BoundaryLevel.title');
        $this->module_fields = [
            ['name' => 'Adequacy',          'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.Adequacy')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.Comments')],
        ];

        $this->module_common_fields =[
            ['name' => 'Boundaries',            'type' => 'imet-core::rating-0to6',        'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.Boundaries')],
            ['name' => 'BoundariesComments',    'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.BoundaryLevel.fields.BoundariesComments')],
        ];

        $this->predefined_values = [
            'field' => 'Adequacy',
            'values' => trans('imet-core::v2_evaluation.BoundaryLevel.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.BoundaryLevel.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.BoundaryLevel.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.BoundaryLevel.ratingLegend');

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Boundaries marked by specific marks (e.g. buoys, signs, posts, beacons, fences, etc.)',
     'Clearly demarcated, unambiguous and therefore easily interpreted boundaries (e.g., signs, posts, markers, fences, buoys, etc.)');
        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Adéquation des limites marquées par des marques spécifiques (p. ex. panneaux, poteaux, balises, clôtures, etc.)',
     'Limites clairement délimitées, non ambiguës et donc faciles à interpréter (p. ex. panneaux, poteaux, balises, clôtures, bouées, etc.)');
        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Limites demarcados por marcas específicas (por exemplo, sinais, postes, balizas, vedações, etc.)',
     'Limites claramente demarcados, inequívocos e, portanto, facilmente interpretados (por exemplo, sinais, postes, marcadores, cercas, bóias, etc.)');
        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Límites marcados por marcas específicas (por ejemplo, señales, postes, balizas, vallas, etc.)',
     'Límites claramente demarcados, inequívocos y, por lo tanto, fáciles de interpretar (por ejemplo, señales, postes, marcadores, cercas, boyas, etc.)');

        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Collaboration in the demarcation of boundaries',
     'Collaboration approach including national agencies and relevant stakeholders in the demarcation of boundaries');
        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Collaboration des parties prenantes à la démarcation des frontières',
     'Approche de collaboration incluant les agences nationales et les parties prenantes concernées dans la démarcation des frontières');
        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Colaboração na demarcação dos limites',
     'Abordagem de colaboração, incluindo agências nacionais e partes interessadas relevantes na demarcação dos limites');
        $record = static::replacePredefinedValue($record,
         'Adequacy',
     'Colaboración en la demarcación de fronteras',
     'Enfoque de colaboración que incluye agencias nacionales y partes interesadas relevantes en la demarcación de fronteras');

        return $record;
    }

    public static function get_marine_predefined(): array
    {
        $predefined = (new static())->predefined_values['values'];
        return [
            $predefined[12],
            $predefined[13]
        ];
    }



}
