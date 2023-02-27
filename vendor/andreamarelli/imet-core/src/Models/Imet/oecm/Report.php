<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm;

use \AndreaMarelli\ImetCore\Models\Imet\Report as BaseReportModel;

class Report extends BaseReportModel
{
    /**
     * @var string[]
     */
    protected $table = 'imet_oecm.imet_report';

    protected static $report_fields = [
        'key_elements_comment',
        'strengths_swot',
        'weaknesses_swot',
        'opportunities_swot',
        'threats_swot',
        'priorities',
        'minimum_budget',
        'additional_funding',
        'previous_state',
        'impacts',
        'responses',
        'outcome_year1',
        'outcome_year2',
        'outcome_year3',
        'outcome_year4',
        'outcome_year5',
        'intervention1_activity1_year1',
        'intervention1_activity1_year2',
        'intervention1_activity1_year3',
        'intervention1_activity1_year4',
        'intervention1_activity1_year5',
        'intervention1_activity2_year1',
        'intervention1_activity2_year2',
        'intervention1_activity2_year3',
        'intervention1_activity2_year4',
        'intervention1_activity2_year5',
        'intervention1_other_year1',
        'intervention1_other_year2',
        'intervention1_other_year3',
        'intervention1_other_year4',
        'intervention1_other_year5',
        'intervention2_activity1_year1',
        'intervention2_activity1_year2',
        'intervention2_activity1_year3',
        'intervention2_activity1_year4',
        'intervention2_activity1_year5',
        'intervention2_activity2_year1',
        'intervention2_activity2_year2',
        'intervention2_activity2_year3',
        'intervention2_activity2_year4',
        'intervention2_activity2_year5',
        'intervention2_other_year1',
        'intervention2_other_year2',
        'intervention2_other_year3',
        'intervention2_other_year4',
        'intervention2_other_year5'
    ];

    /**
     * Retrieve report
     *
     * @param $form_id
     * @return array
     */
    public static function getByForm($form_id): array
    {
        $report = Report::where('FormID', $form_id)->first();
        return $report === null
            ? array_fill_keys(static::$report_fields, null)
            : $report->toArray();
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
