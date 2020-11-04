<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ActorsRelations extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_actors_relations';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR13';
        $this->module_title = trans('form/imet/v1/evaluation.ActorsRelations.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ActorsRelations.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.ActorsRelations.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.ActorsRelations.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ActorsRelations.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => trans('form/imet/v1/evaluation.ActorsRelations.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.ActorsRelations.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.ActorsRelations.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.ActorsRelations.ratingLegend');

        parent::__construct($attributes);
     
    }
}