<?php

namespace AndreaMarelli\ImetCore\Services\Assessment;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet as ImetOecm;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\OecmScores;
use AndreaMarelli\ImetCore\Services\Scores\Labels;

class OecmAssessment
{
    use Labels;

    /**
     * Ensure to return IMET model
     */
    private static function getAsModel(ImetOecm|int|string $imet): ImetOecm
    {
        return (is_int($imet) or is_string($imet))
            ? ImetOecm::find($imet)
            : $imet;
    }

    public static function getAssessment(ImetOecm|int|string $imet, $step = _Scores::RADAR_SCORES, $with_labels = true): array
    {
        $imet = static::getAsModel($imet);
        $scores = $step === _Scores::ALL_SCORES
            ? OecmScores::get_all($imet)
            : (
                $step == _Scores::RADAR_SCORES
                    ? OecmScores::get_radar($imet)
                    : OecmScores::get_step($imet, $step)
            );

        $result = [
            'form_id' => $imet->getKey(),
            'wdpa_id' => $imet->wdpa_id,
            'iso3' => $imet->Country,
            'name' => $imet->name,
            'version' => $imet->version,
            'scores' => $scores
        ];

        return $with_labels
            ? array_merge($result, ['labels' => static::get_scores_labels($imet->version)])
            : $result;
    }

}