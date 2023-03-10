<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller;
use AndreaMarelli\ImetCore\Models\Imet\Imet as BaseImetForm;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderTrendsThreats;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\ResponsablesInterviewees;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\ResponsablesInterviewers;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Services\Statistics\OEMCStatisticsService;
use AndreaMarelli\ModularForms\Helpers\Type\Chars;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Imet extends BaseImetForm
{
    protected $table = 'imet_oecm.imet_form';

    public const version = 'oecm';

    public static $modules = [

        'general_info' => [
            Modules\Context\ResponsablesInterviewers::class,
            Modules\Context\ResponsablesInterviewees::class,
            Modules\Context\GeneralInfo::class,
            Modules\Context\Governance::class,
            Modules\Context\SpecialStatus::class,
            Modules\Context\Networks::class,
            Modules\Context\Missions::class,
            Modules\Context\Contexts::class,
            Modules\Context\Objectives1::class,
        ],
        'areas' => [
            Modules\Context\GeographicalLocation::class,
            Modules\Context\Areas::class,
            Modules\Context\Objectives2::class,
        ],
        'resources' => [
            Modules\Context\StakeholdersNaturalResources::class,
            Modules\Context\ManagementRelativeImportance::class,
            Modules\Context\ManagementStaff::class,
            Modules\Context\ManagementStaffPartners::class,
            Modules\Context\FinancialResources::class,
            Modules\Context\Equipments::class,
            Modules\Context\Objectives3::class,
        ],
        'key_elements' => [
            Modules\Context\AnimalSpecies::class,
            Modules\Context\VegetalSpecies::class,
            Modules\Context\Habitats::class,
//            Modules\Context\Objectives4::class,
        ],
        'access_and_governance' => [
            Modules\Context\AnalysisStakeholderAccessGovernance::class,
//            Modules\Context\Objectives5::class,
        ],
        'trends_and_threats' => [
            Modules\Context\AnalysisStakeholderTrendsThreats::class,
//            Modules\Context\Objectives6::class,
        ],
    ];


    /**
     * Relation to Encoder (only name)
     *
     * @return HasMany
     */
    public function encoder(): HasMany
    {
        return $this->hasMany(Encoder::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'first_name', 'last_name']);
    }

    /**
     * Relation to ResponsablesInterviewees
     *
     * @return HasMany
     */
    public function responsible_interviewees(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewees::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }

    /**
     * Relation to ResponsablesInterviewers
     *
     * @return HasMany
     */
    public function responsible_interviewers(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewers::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }

    /**
     * Retrieve the IMET assessments list (clean, without statistics):  V1 & v2 merged
     *
     * @param Request $request
     * @param array $relations
     * @param bool $only_allowed_wdpas
     * @return mixed
     */
    public static function get_assessments_list(Request $request, array $relations = [], bool $only_allowed_wdpas = false)
    {
        $allowed_wdpas = $only_allowed_wdpas
            ? Role::allowedWdpas()
            : null;

        return Imet
            ::filterList($request)
            ->with($relations)
            ->where(function ($query) use ($allowed_wdpas) {
                if ($allowed_wdpas !== null) {
                    $query->whereIn('wdpa_id', $allowed_wdpas);
                }
            })
            ->get()
            // Replacement for PostgreSQL unaccent() function
            ->filter(function($item) use ($request){
                if ($request->filled('search')){
                    return Chars::case_and_accent_insensitive_contains($item['name'], $request->input('search'))
                        || Str::contains($item['wdpa_id'], $request->input('search'));
                }
                return true;
            });
    }

    /**
     * Retrieve the IMET assessments list with extra information (ex. responsible, statistics, and duplicates) for INDEX controller
     *
     * @param Request $request
     * @return mixed
     */
    public static function get_assessments_list_with_extras(Request $request)
    {
        $hasDuplicates = static::foundDuplicates();
        $list = static::get_assessments_list($request, ['country', 'encoder', 'responsible_interviewees', 'responsible_interviewers'], true)
            ->map(function ($item)  use ($hasDuplicates) {

                // Add encoders
                $item->encoders_responsibles = [
                    'encoders' => array_values($item->encoder->flatten()->unique()->toArray()),
                    'internal' => array_values($item->responsible_interviewers->flatten()->unique()->toArray()),
                    'external' => array_values($item->responsible_interviewees->flatten()->unique()->toArray()),
                ];

                // Add radar
                $item['assessment_radar'] = OEMCStatisticsService::get_radar_scores($item);

                // Non WDPA
                if (ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
                    $item->wdpa_id = null;
                }

                // Last IMET update
                $item['last_update'] = $item->getLastUpdate();

                // has duplicates
                $item['has_duplicates'] = in_array($item->getKey(), $hasDuplicates);

                return $item;
            })
            ->makeHidden(['encoder', 'responsible_interviewees', 'responsible_interviewers']);

        return $list;
    }

    public static function getResponsibles($form_id, $version): array
    {
        $internal = ResponsablesInterviewers::getNames($form_id);
        $external = ResponsablesInterviewees::getNames($form_id);

        return [
            'encoders' => Encoder::getNames($form_id),
            'internal' => $internal,
            'external' => $external
        ];
    }

    /**
     * Extent parent method: save user as encoder
     *
     * @param $item
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public static function updateModuleAndForm($item, Request $request): array
    {
        $return = parent::updateModuleAndForm($item, $request);
        if ($return['status'] == 'success') {
            (new Controller())->backup($item);
        }

        $user_info = Auth::user()->getInfo();
        unset($user_info['country']);

        Encoder::touchOnFormUpdate($item, $user_info);

        return $return;
    }


}
