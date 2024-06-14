<?php

namespace AndreaMarelli\ImetCore\Services\Scores;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet as ImetV1;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet as ImetV2;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\Functions\V1ToV2Scores;
use AndreaMarelli\ImetCore\Services\Scores\Functions\V2Scores;
use AndreaMarelli\ImetCore\Services\Scores\Functions\V1Scores;

class ImetScores
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
     * Ensure to return IMET id
     */
    private static function getAsId(Imet|ImetV1|ImetV2|int|string $imet): int
    {
        return  (is_int($imet) or is_string($imet))
            ? (int) $imet
            : $imet->getKey();
    }

    /**
     * Retrieve IMET assessment's scores (all)
     */
    public static function get_all(Imet|ImetV1|ImetV2|int|string $imet): array
    {
        $imet = static::getAsModel($imet);
        return $imet->version === Imet::IMET_V1
            ? V1ToV2Scores::get_scores($imet->getKey())
            : V2Scores::get_scores($imet->getKey());
    }

    /**
     * Retrieve IMET assessment's radar scores
     */
    public static function get_radar(Imet|ImetV1|ImetV2|int|string $imet, bool $with_abbreviations = false): array
    {
        $imet = static::getAsModel($imet);
        $scores = static::get_all($imet)[_Scores::RADAR_SCORES];

        // use abbreviations instead of keys
        if ($with_abbreviations) {
            $labels = static::labels($imet->version, true);
            unset($scores['imet_index']);
            return array_combine($labels, $scores);
        } else {
            return $scores;
        }
    }

    /**
     * Retrieve IMET assessment's given step scores
     */
    public static function get_step(Imet|ImetV1|ImetV2|int|string $imet, string $step): array
    {
        return static::get_all($imet)[$step];
    }

    /**
     * Retrieve the global IMET assessment score
     */
    public static function get_score(Imet|ImetV1|ImetV2|int|string $imet): array
    {
        return static::get_radar($imet)['imet_index'];
    }

    /**
     * Refresh scores (override cache)
     */
    public static function refresh_scores(Imet|ImetV1|ImetV2|int|string $imet): array
    {
        $imet = static::getAsModel($imet);
        return $imet->version === Imet::IMET_V1
            ? V1ToV2Scores::get_scores($imet->getKey(), true)
            : V2Scores::get_scores($imet->getKey(), true);
    }

    /**
     * Retrieve the radar labels
     */
    public static function labels(string $version = null, bool $only_abbreviations = false): array
    {
        return static::get_labels($version, $only_abbreviations);
    }

    /**
     * Retrieve the indicators labels
     */
    public static function indicators_labels(string $version = null, bool $only_abbreviations = false): array
    {
        return static::get_indicators_labels($version);
    }

}
