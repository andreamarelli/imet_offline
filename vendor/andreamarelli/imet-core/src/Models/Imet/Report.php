<?php

namespace AndreaMarelli\ImetCore\Models\Imet;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * @var string[]
     */
    protected $table = 'imet.imet_report';

    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';

    protected $guarded = [];

    protected static $report_fields = [
        'key_species_comment',
        'habitats_comment',
        'climate_change_comment',
        'ecosystem_services_comment',
        'threats_comment' ,
        'analysis',
        'strengths_swot',
        'weaknesses_swot',
        'opportunities_swot',
        'threats_swot',
        'recommendations',
        'priorities',
        'minimum_budget',
        'additional_funding',
    ];

    /**
     * Retrieve report
     *
     * @param $form_id
     * @return array
     */
    public static function getByForm($form_id): array
    {
        $report = static::where('FormID', $form_id)->first();

        if($report===null){
            $report = array_fill_keys(static::$report_fields, "");
        } else {
            $report = array_map(function($item) {
                if($item === null){
                    return "";
                }
                return $item;
            },$report->toArray());
        }

        return $report;
    }

    /**
     * Update report
     *
     * @param $form_id
     * @param $data
     * @return void
     */
    public static function updateByForm($form_id, $data)
    {
        $report = static::where('FormID', $form_id)->first();
        if($report==null){
            $report = new Report();
        }
        $data['FormID'] = $form_id;
        $report->fill($data);
        if($report->isDirty()){
            $report->save();
        }
    }

    /**
     * Export report (for JSON export)
     *
     * @param $form_id
     * @return mixed
     */
    public static function export($form_id)
    {
        return static::where('FormID', $form_id)
            ->get()
            ->makeHidden(['id', 'FormID'])
            ->toArray()[0]
            ?? array_fill_keys(static::$report_fields, null);
    }

    /**
     * Import report (from JSON export)
     *
     * @param $form_id
     * @param $data
     * @return void
     */
    public static function import($form_id, $data)
    {
        $report = new static();
        $data['FormID'] = $form_id;
        $report->fill($data);
        $report->save();
    }

}
