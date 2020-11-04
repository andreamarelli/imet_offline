<?php

namespace App\Models\ProtectedArea;

use App\Library\Utils\Geo\PostGisToGeoJSON;
use App\Models\Components\Form;
use App\Models\Components\Geom;
use App\Models\ProtectedArea\Modules\Wdpa;
use Illuminate\Http\Request;


class ProtectedArea extends Form
{
    use Geom;
    use PostGisToGeoJSON;

    public static $modules = [
//        Modules\GeneralInfo::class,
//        Modules\Wdpa::class
    ];

    protected $table = 'KnowledgeBase.protected_areas_wdpa';
    protected $primaryKey = 'ofac_id';

    public const LABEL = 'name';
    public const EXPORT = [
        'ofac_id',
        'wdpa_id',
        'name',
        'country',
        'iucn_category',
        'designation',
        'status',
        'status_year',
        'governance_type',
        'governance_type_fr',
        'management_authority',
        'management_plan',
        'reported_area',
        'reported_marine_area'
    ];

    protected static $sortBy = 'name';

    /**
     * Get Name by ID
     * @param $id
     * @return \Illuminate\Support\HigherOrderCollectionProxy|mixed|null
     */
    public static function getName($id)
    {
        $item = static::find($id);
        return empty($item) ? null : $item->{static::LABEL};

    }

    /**
     * Override scopeFilterList(): retrieve according to request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterList($query, Request $request)
    {
        $conditions = [];
        if($request->filled('country')){
            $conditions[] = ['country', '=', $request->input('country')];
        }
        if($request->filled('iucncat')){
            $conditions[] = ['iucn_category', '=', $request->input('iucncat')];
        }

        return empty($conditions)
            ? $query
            : $query->where($conditions);
    }

    /**
     * Retrieve a restricted list
     * @param $country
     * @return mixed
     */
    public static function byCountry($country)
    {
        return static::selectionList('PAIRS',
            static::where('country', $country)->get()
        );
    }

    /**
     * Get by WDPA id
     * @param $wdpa
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getByWdpa($wdpa)
    {
        return static::where('wdpa_id', $wdpa)
            ->first();
    }

    /**
     * Get centroid coordinates
     * @param $id
     * @return array|null
     */
    public static function getMapCenter($id)
    {
        return static::getCentroidLatLon($id, 'id', 'KnowledgeBase.protected_area_centroids');
    }

    /**
     * Retrieve an array for selection lists (with WDPA as id)
     * @return array
     */
    public static function selectionWdpaList()
    {
        return static::all()
            ->sortBy(static::LABEL, SORT_NATURAL|SORT_FLAG_CASE)
            ->pluck(static::LABEL, 'wdpa_id')
            ->toArray();
    }

}
