<?php

namespace AndreaMarelli\ImetCore\Models\Imet;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Encoder;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\Imet\v1;
use AndreaMarelli\ImetCore\Models\Imet\v2;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Helpers\Type\Chars;
use AndreaMarelli\ModularForms\Models\Form;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function session;

/**
 * Class Imet
 *
 * @property string $Country
 * @property string $FormID
 * @property string $language
 * @property string $name
 * @property string $version
 * @property string $wdpa_id
 * @property string $Year
 *
 */
class Imet extends Form
{
    protected $table = 'imet.imet_form';
    protected $primaryKey = 'FormID';
    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = 'UpdateBy';

    public static $sortBy = 'Year';
    public static $sortDirection = 'desc';

    public static $modules = [];

    /**
     * Relation to Country
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function country(): hasOne
    {
        return $this->hasOne(Country::class, 'iso3', 'Country');
    }

    /**
     * Relation to Encoder (only name)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function encoder()
    {
        return $this->hasMany(Encoder::class, $this->primaryKey, 'FormID')
            ->select(['FormID','first_name', 'last_name'])
            ;
    }

    /**
     * Mutator: ensure to retrieve in lowercase
     * @param $value
     * @return string
     */
    public function getLanguageAttribute($value)
    {
        return strtolower($value);
    }

    /**
     * common search filters with wdpa
     * @param Builder $query
     * @param Request $request
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function scopeCommonSearchWithWdpa(Builder $query, Request $request) : Collection
    {
        $this->commonFilters($query, $request);
        if($request->filled('wdpa')){
            $query->where('wdpa_id', $request->input('wdpa'));
        }
        return $query->get();
    }

    /**
     * common method to use it in various searches queries
     * @param Builder $query
     * @param Request $request
     */
    private function commonFilters(Builder $query, Request $request)
    {
        if($request->filled('country')){
            $query->where('Country', $request->input('country'));
        }
        if($request->filled('year')){
            $query->where('Year', $request->input('year'));
        }
    }

    /**
     * Override scopeFilterList()
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterList(Builder $query, Request $request): Builder
    {
        $query->whereHasPermission();

        // filters
        $this->commonFilters($query, $request);
        if($request->filled('search')){
            $query->whereRaw('unaccent(name) ILIKE unaccent(?)', '%'.$request->input('search').'%')
                ->orWhere('wdpa_id', 'LIKE', '%'.$request->input('search').'%');
        }
        $query->where('version', static::version);

        // sort
        $query
            ->orderBy(static::$sortBy, static::$sortDirection)
            ->orderBy('name', 'desc');

        return $query;
    }

    public function scopeWhereHasPermission($query){

        if(!\is_imet_environment()){
            // TODO
        }
        return $query;
    }

    /**
     * Check and add missing Pa data (country, wdpa_id, pa_name) to form
     */
    public static function checkMissingPaData()
    {
        Imet::where('Country', null)
            ->orWhere('wdpa_id', null)
            ->orWhere('name', null)
            ->get()
            ->map(function ($imet){
                /** @var Imet $imet */
                $pa = ProtectedAreaNonWdpa::isNonWdpa($imet->wdpa_id)
                    ? ProtectedAreaNonWdpa::find($imet->wdpa_id)
                    : ProtectedArea::getByWdpa($imet->wdpa_id);
                $imet->Country = $pa->country;
                $imet->name = $pa->name;
                $imet->save();
            });
    }

    /**
     * Retrieve form language
     * @param $form_id
     * @return mixed
     */
    public static function getLanguage($form_id)
    {
        $session_key = 'imet_language_'.$form_id;
        $language = session($session_key, null);
        if($language===null || $language===""){
            $language = strtolower(static::find($form_id)->language);
            session([$session_key => $language]);
        }
        return $language;
    }

    public static function getResponsibles($form_id, $version): array
    {
        $internal = $version === 'v1'
            ? v1\Modules\Context\ResponsablesInterviewers::getNames($form_id)
            : v2\Modules\Context\ResponsablesInterviewers::getNames($form_id);
        $external = $version === 'v1'
            ? v1\Modules\Context\ResponsablesInterviewees::getNames($form_id)
            : v2\Modules\Context\ResponsablesInterviewees::getNames($form_id);

        return [
            'encoders' => Encoder::getNames($form_id),
            'internal' => $internal,
            'external' => $external
        ];
    }

    public static function getVersion($form_id)
    {
        $form = static::find($form_id);
        return $form ? $form->version : null;
    }

    /**
     * Retrieve the last IMET of the given PA
     *
     * @param $wdpa_id
     * @return mixed|null
     */
    public static function getLast($wdpa_id){
        $form = static::select(['FormID as id', 'version'])
            ->where('wdpa_id', $wdpa_id)
            ->orderBy('Year', 'DESC')
            ->first();
        return $form ? $form->only(['id', 'version']) : null;
    }

    /**
     * Retrieve specific fields and return them in different arrays in an array
     *
     * @param string[] $fields
     * @return array
     */
    public static function getFieldsSplitToArrays(array $fields = ['Country','Year','wdpa_id', 'FormID']){

        $getRecords = static::select($fields)
            ->distinct()
            ->get()
            ->toArray();

        $records = [];
        foreach($getRecords as $key => $field){
            foreach($fields as $k => $f){
                $records[$f][$field[$f]] = $field[$f];
            }
        }

        return $records;
    }

    /**
     * Retrieve an array of distinct values for the given field
     *
     * @param string $field
     * @return array
     */
    private static function getDistinctField(string $field): array
    {
        return static::select($field)
            ->distinct()
            ->orderBy($field)
            ->get()
            ->pluck($field)
            ->toArray();
    }

    /**
     * Retrieve years for existing IMETs
     *
     * @return array
     */
    public static function getAvailableYears(): array
    {
        return static::getDistinctField('Year');
    }

    /**
     * Retrieve protected area data
     *
     * @param $wdpa_id
     * @return \AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa|\AndreaMarelli\ImetCore\Models\ProtectedArea
     */
    public static function getProtectedArea($wdpa_id)
    {
        if(ProtectedAreaNonWdpa::isNonWdpa($wdpa_id)){
            $pa = ProtectedAreaNonWdpa::find($wdpa_id);
            $pa->wdpa_id = $pa->id;
            $pa->Type = null;
            $pa->iucn_category = null;
            $pa->creation_date = $pa->creation_date ?? null;
        } else {
            $pa = ProtectedArea::getByWdpa($wdpa_id);
        }
        return $pa;
    }


    /**
     * Import form from array
     *
     * @param $data
     * @return array
     */
    public static function importForm($data)
    {
        if(!array_key_exists('wdpa_id', $data) || $data['wdpa_id']===null){
            $pa = ProtectedArea::getByGlobalId($data['protected_area_global_id']);
        } else {
            $pa = static::getProtectedArea($data['wdpa_id']);
        }

        unset($data['Type']);
        unset($data['protected_area_global_id']);
        unset($data['imet_version']);
        unset($data['db_version']);
        unset($data['region']);
        unset($data['FormID']);

        $form = new static($data);
        $form->fill($data);
        $form->name = $pa->name;
        $form->wdpa_id = $pa->wdpa_id;
        $form->Country = $pa->country;
        $form->save();
        return $form->getKey();
    }

    /**
     * Extent parent method: save user as encoder
     * @param $item
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public static function updateModuleAndForm($item, Request $request): array
    {
        $return = parent::updateModuleAndForm($item, $request);
        if($return['status'] == 'success'){
            (new Controller)->backup($item);
        }

        $user = Auth::user()
            ->person
            ->only(['first_name', 'last_name', 'organisation', 'function']);

        if(Encoder::where('first_name', $user['first_name'])
                ->where('last_name', $user['last_name'])
                ->where('FormID', $item)
                ->whereDate(static::UPDATED_AT, Carbon::today())
                ->count()===0){
            $encoder =  new Encoder();
            $encoder->fill($user);
            $encoder['FormID'] = $item;
            $encoder->save();
        }

        return $return;
    }

    /**
     * Import all modules from records array
     *
     * @param $records
     * @param $formID
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function importModules($records, $formID, $imet_version = null): array
    {
        $records = static::upgradeModules($records, $imet_version);
        $modules_imported = [];
        /** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule $module_class */
        foreach (static::allModules() as $module_class) {
            if (array_key_exists($module_class::getShortClassName(), $records)) {
                $modules_imported[] = $module_class::getShortClassName();
                foreach ($records[$module_class::getShortClassName()] as $record) {
                    $module_class::importModule($formID, $record);
                }
            }
        }
        return $modules_imported;
    }

    /**
     * Upgrade modules from previous versions
     *
     * @param $data
     * @param null $imet_version
     * @return array
     */
    public static function upgradeModules($data, $imet_version = null): array
    {
        $upgraded_data = [];
        /** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule $module_class */
        foreach (static::allModules() as $module_class) {
            if(array_key_exists($module_class::getShortClassName(), $data)){
                $upgraded_data[$module_class::getShortClassName()]
                    = $module_class::upgradeModuleRecords($data[$module_class::getShortClassName()], $imet_version);
            }
        }
        return $upgraded_data;
    }

    /**
     * Generate a filename for exporting form
     *
     * @param $extension
     * @return string
     */
    public function filename($extension): string
    {
        $name = Chars::clean(Chars::replaceAccents($this->name));
        $now = Carbon::now()->format('Y-m-d');

        $wdpa_id = ProtectedAreaNonWdpa::isNonWdpa($this->wdpa_id) ? '' : '_' . $this->wdpa_id;

        return 'IMET' .
            $wdpa_id  .
            '-' . $this->Year .
            '-' . $name .
            '-' . $this->FormID .
            '_' . $now .
            '.' . $extension;
    }

    /**
     * Get the list of duplicates IMETs (same PA and year)
     *
     * @return bool|array
     */
    public function getDuplicates()
    {
        $query = static::select('FormID')
            ->where($this->getKeyName(), '!=', $this->getKey())
            ->where('version', $this->version)
            ->where('Year', $this->Year)
            ->where('wdpa_id', $this->wdpa_id);
        return $query->get()->pluck('FormID')->toArray();
    }

    /**
     *  Get the list of IMET ids which have duplicates (same PA and year)
     *
     * @return array
     */
    public static function foundDuplicates()
    {
        $haveDuplicates = [];
        static::selectRaw('json_agg("FormID")')
            ->groupBy("Year", "wdpa_id", 'version')
            ->havingRaw('count(*) > ?', [1])
            ->get()
            ->pluck('json_agg')
            ->map(function ($item) use (&$haveDuplicates){
                $haveDuplicates = array_merge($haveDuplicates, json_decode($item));
                return $item;
            });
        return $haveDuplicates;
    }

    /**
     * return array keys of modules
     * @return array
     */
    public static function getModulesKeys() : array
    {
        return array_keys(static::$modules);
    }

}
