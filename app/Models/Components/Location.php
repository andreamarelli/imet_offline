<?php

namespace App\Models\Components;


use App\Models\AdministrationLevel;

trait Location
{

    private static $location_relation_name = 'locations';

    /**
     * Filters by location using model's relation (except for administrativeLevels)
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param String $level
     * @param String $site
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereLocation($query, $level, $site = null)
    {
        return $query->whereHas(self::$location_relation_name, function($inner_query) use($level, $site) {
            $inner_query->where('level', $level);
            if($site !== null){
                if($level === 'administrative_location'){
                    $inner_query->where('administrative_location', $site);
                } else {
                    $inner_query->whereRaw('unaccent('.$level.'_location) ilike (\'%\' || unaccent(\''.$site.'\') || \'%\')');
                }
            }
        });
    }

    /**
     * Filter administrative levels by country
     * @param $query
     * @param $country
     * @return mixed
     */
    public function scopeAdminInCountry($query, $country)
    {
        return $query->whereHas(self::$location_relation_name, function($inner_query) use($country) {
            $inner_query->where('level', 'administrativeLevels')
                ->wherein('administrative_location', AdministrationLevel::getIdsByCountry($country));
        });
    }

    /**
     * Analytical Platform: filter by location
     * @param \Illuminate\Database\Query\Builder $query
     * @param $level
     * @param null $site
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeInAnalyticalPlatformLocation($query, $level, $site = null)
    {
        return $query->whereHas(self::$location_relation_name, function($inner_query) use ($level, $site) {
            switch ($level) {
                case 'regional':
                    $inner_query->whereIn('level', [
                        'mondial',
                        'continental',
                        'regional'
                    ]);
                    break;
                case 'national':
                            $inner_query->where('level', 'national')
                                    ->where(function ($inner_query) use ($site) {
                                        $inner_query->where('level', 'national')
                                        ->whereRaw('unaccent("national_location") ilike (\'%\' || unaccent(\'' . $site . '\') || \'%\')');
                                    })->orWhere(function ($inner_query) use ($site){
                            $inner_query->where('level', 'administrativeLevels')
                                ->wherein('administrative_location', AdministrationLevel::getIdsByCountry($site));
                        })
                    ;
                    break;
                case 'protected_areas':
                    $inner_query->where('level', 'ProtectedArea');
                    if($site !== null) {
                        $ofac_id= \App\Models\ProtectedArea\ProtectedArea::getByWdpa($site)->ofac_id ?? $site;
                        if(static::class == "App\Models\Catalogue\Catalogue"){
                            $inner_query->whereRaw('unaccent("protectedarea_location") ilike (\'%\' || unaccent(\'' . $ofac_id . '\') || \'%\')');
                        } else {
                            $inner_query->whereRaw('unaccent("ProtectedArea_location") ilike (\'%\' || unaccent(\'' . $ofac_id . '\') || \'%\')');
                        }

                    }
                    break;
                case 'concessions':
                    $inner_query->where('level', 'Concession');
                    if($site !== null) {
                        if(static::class == "App\Models\Catalogue\Catalogue"){
                            $inner_query->whereRaw('unaccent("concession_location") ilike (\'%\' || unaccent(\'' . $site . '\') || \'%\')');

                        } else {
                            $inner_query->whereRaw('unaccent("Concession_location") ilike (\'%\' || unaccent(\'' . $site . '\') || \'%\')');
                        }
                    }
                    break;
            }
        });
    }

}