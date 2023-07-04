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
        'proposed_short',
        'proposed_long',
        'impacts',
        'responses',
        'long_term',
        'outcome',
        'annual_targets',
        'intervention1',
        'intervention1_activity',
        'intervention1_other',
        'intervention2',
        'intervention2_activity',
        'intervention2_other',
        'intervention3',
        'intervention3_activity',
        'intervention3_other',
        'group_key'
    ];

    protected static $boolean_fields = [
        'long_term_year1',
        'long_term_year2',
        'long_term_year3',
        'long_term_year4',
        'long_term_year5',
        'outcome_year1',
        'outcome_year2',
        'outcome_year3',
        'outcome_year4',
        'outcome_year5',
        'annual_targets_year1',
        'annual_targets_year2',
        'annual_targets_year3',
        'annual_targets_year4',
        'annual_targets_year5',
        'intervention1_year1',
        'intervention1_year2',
        'intervention1_year3',
        'intervention1_year4',
        'intervention1_year5',
        'intervention1_activity_year1',
        'intervention1_activity_year2',
        'intervention1_activity_year3',
        'intervention1_activity_year4',
        'intervention1_activity_year5',
        'intervention1_other_year1',
        'intervention1_other_year2',
        'intervention1_other_year3',
        'intervention1_other_year4',
        'intervention1_other_year5',
        'intervention2_year1',
        'intervention2_year2',
        'intervention2_year3',
        'intervention2_year4',
        'intervention2_year5',
        'intervention2_activity_year1',
        'intervention2_activity_year2',
        'intervention2_activity_year3',
        'intervention2_activity_year4',
        'intervention2_activity_year5',
        'intervention2_other_year1',
        'intervention2_other_year2',
        'intervention2_other_year3',
        'intervention2_other_year4',
        'intervention2_other_year5',
        'intervention3_year1',
        'intervention3_year2',
        'intervention3_year3',
        'intervention3_year4',
        'intervention3_year5',
        'intervention3_activity_year1',
        'intervention3_activity_year2',
        'intervention3_activity_year3',
        'intervention3_activity_year4',
        'intervention3_activity_year5',
        'intervention3_other_year1',
        'intervention3_other_year2',
        'intervention3_other_year3',
        'intervention3_other_year4',
        'intervention3_other_year5'
        ];

    /**
     * Retrieve report
     *
     * @param $form_id
     * @return array
     */
    public static function getByForm($form_id): array
    {
        $report = Report::where('FormID', $form_id)->get();

        return $report->isEmpty()
            ? [static::getSchema()]
            : $report->toArray();
    }

    public static function getSchema(){
        return array_fill_keys(static::$report_fields, null) + array_fill_keys(static::$boolean_fields, false);
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

        Report::where('FormID', $form_id)->delete();
        foreach ($data as $key => $value) {
            $report = new Report();
            $data[$key]['FormID'] = $form_id;
            $report->fill($data[$key]);
            if ($report->isDirty()) {
                $report->save();
            }
        }
    }
}
