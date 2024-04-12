<?php

namespace AndreaMarelli\ImetCore\Services\Assessment;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
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
    private static function getAsModel(Imet|ImetV1|ImetV2|int|string $imet): Imet
    {
        return (is_int($imet) or is_string($imet))
            ? Imet::find($imet)
            : $imet;
    }

    /**
     * Retrieve IMET info and scores
     */
    public static function getAssessment(Imet|ImetV1|ImetV2|int|string $imet, $step = _Scores::RADAR_SCORES): array
    {
        $imet = static::getAsModel($imet);
        $scores = $step === _Scores::ALL_SCORES
            ? ImetScores::get_all($imet)
            : (
                $step == _Scores::RADAR_SCORES
                    ? ImetScores::get_radar($imet)
                    : ImetScores::get_step($imet, $step)
            );
        return array_merge(
            [
                'formid' => $imet->getKey(),
                'wdpa_id' => $imet->wdpa_id,
                'iso3' => $imet->Country,
                'name' => $imet->name,
                'version' => $imet->version,
                'labels' => static::get_indicators_labels($imet->version),
            ],
            $scores
        );
    }

    /**
     * Retrieve the last IMET of the given WDPA (return only ID and version)
     */
    public static function getLast($wdpa_id): ?Imet
    {
        return Imet::where('wdpa_id', $wdpa_id)
            ->orderBy('Year', 'DESC')
            ->first();
    }

    /**
     * Retrieve the last IMET of the given PA
     */
    public static function getAvailableYears($wdpa_id): Collection
    {
        return Imet
            ::where('wdpa_id', $wdpa_id)
            ->orderBy('Year','DESC')
            ->get();
    }

    /**
     * Retrieve the number of assessment and the related WDPA IDs for the given country
     */
    public static function getAssessmentByCountry($country, bool $with_scores = true): array
    {
        return Imet::select(['FormID', 'wdpa_id', 'Country', 'Year', 'name', 'language', 'version'])
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