<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\Assessment;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\GeneralInfo;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Areas;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Support\Facades\Lang;
use AndreaMarelli\ImetCore\Models\Imet\v2\Report;

class ReportV2 extends ReportV1
{

    protected static string $report_class = Report::class;
    protected static string $general_info_class = GeneralInfo::class;
    protected static string $areas_class = Areas::class;

    /**
     * @param int $form_id
     * @return array
     */
    protected static function assessment_scores(int $form_id): array
    {
        return V2StatisticsService::get_scores($form_id, 'ALL');
    }

    /**
     * @return array
     */
    protected static function get_labels(): array
    {
        $general_info_labels = trans('imet-core::v2_context.GeneralInfo.fields');
        $steps_eval_labels = trans('imet-core::common.steps_eval');
        $mission_labels = Lang::get('imet-core::v2_context.Missions.fields');
        $assessment_labels = Lang::get('imet-core::analysis_report.assessment');

        unset($general_info_labels['WDPA']);
        unset($steps_eval_labels['objectives']);
        unset($steps_eval_labels['management_effectiveness']);
        unset($steps_eval_labels['general_info']);
        unset($assessment_labels['ctx101']);
        unset($assessment_labels['ctx102']);

        return array_merge($steps_eval_labels, $general_info_labels, $mission_labels, $assessment_labels);
    }

}
