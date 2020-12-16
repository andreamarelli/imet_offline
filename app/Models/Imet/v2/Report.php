<?php

namespace App\Models\Imet\v2;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'imet.imet_report';

    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';

    protected $guarded = [];

    public static function getByForm($form_id)
    {
        $report = Report::where('FormID', $form_id)->first();

        return $report===null
            ? [
                'key_species_comment'=> '',
                'habitats_comment'=> '',
                'climate_change_comment'=> '',
                'ecosystem_services_comment'=> '',
                'threats_comment' => '',
                'analysis'=> '',
                'strengths_swot'=> '',
                'weaknesses_swot'=> '',
                'opportunities_swot'=> '',
                'threats_swot'=> '',
                'recommendations'=> '',
                'priorities'=> '',
                'minimum_budget'=> '',
                'additional_funding'=> '',
            ]
            : $report->toArray();
    }

    public static function updateByForm($form_id, $data)
    {
        $report = Report::where('FormID', $form_id)->first();
        if($report==null){
            $report = new Report();
        }
        $data['FormID'] = $form_id;
        $report->fill($data);
        if($report->isDirty()){
            $report->save();
        }
    }


}
