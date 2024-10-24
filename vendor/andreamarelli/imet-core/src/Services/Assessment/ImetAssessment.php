<?php

namespace AndreaMarelli\ImetCore\Services\Assessment;

use AndreaMarelli\ImetCore\Models\Imet\v1\Imet as ImetV1;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet as ImetV2;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use AndreaMarelli\ImetCore\Services\Scores\Labels;
use Illuminate\Database\Eloquent\Collection;

class ImetAssessment
{
    use Labels;

    /**
     * Ensure to return IMET model
     */
    private static function getAsModel(ImetV1|ImetV2|int|string $imet): ImetV1|ImetV2
    {
        if(is_int($imet) or is_string($imet)) {
            $imet_model = ImetV2::find($imet);
            return $imet_model->version===ImetV2::version
                ? $imet_model
                : ImetV1::find($imet);
        }
        return $imet;
    }

    /**
     * Retrieve IMET info and scores
     */
    public static function getAssessment(ImetV1|ImetV2|int|string $imet, $step = _Scores::RADAR_SCORES, $with_labels = true): array
    {
        $imet = static::getAsModel($imet);
        $scores = $step === _Scores::ALL_SCORES
            ? ImetScores::get_all($imet)
            : (
                $step == _Scores::RADAR_SCORES
                    ? ImetScores::get_radar($imet)
                    : ImetScores::get_step($imet, $step)
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

    /**
     * Retrieve the last IMET of the given WDPA (return only ID and version)
     */
    public static function getLast($wdpa_id): ?ImetV2
    {
        return ImetV2::where('wdpa_id', $wdpa_id)
            ->orderBy('Year', 'DESC')
            ->first();
    }

    /**
     * Retrieve the last IMET of the given PA
     */
    public static function getAvailableYears($wdpa_id): Collection
    {
        return ImetV2
            ::where('wdpa_id', $wdpa_id)
            ->orderBy('Year','DESC')
            ->get();
    }

    /**
     * Retrieve the number of assessment and the related WDPA IDs for the given country
     */
    public static function getAssessmentByCountry($country, bool $with_scores = true): array
    {
        return ImetV2::select(['FormID', 'wdpa_id', 'Country', 'Year', 'name', 'language', 'version'])
            ->where('Country', $country)
            ->orderBy('Year', 'DESC')
            ->get()
            ->map(function ($item) use($with_scores) {
                if($with_scores) {
                    $item['scores'] = ImetScores::get_radar($item, true);
                }
                return $item;
            })
            ->toArray();
    }

}