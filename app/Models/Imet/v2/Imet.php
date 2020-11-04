<?php

namespace App\Models\Imet\v2;

use App\Models\Imet\Utils\ProtectedArea;
use App\Models\Imet\v2\Modules\Context\FinancialAvailableResources;
use App\Models\Imet\v2\Modules\Context\FinancialResourcesBudgetLines;
use App\Models\Imet\v2\Modules\Context\FinancialResourcesPartners;
use Illuminate\Http\Request;


class Imet extends \App\Models\Imet\Imet
{
    public const version = 'v2';
    public const imet_version = 'v2.0.9';
    public const db_version = 'v2.1.2';

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
            Modules\Context\Objectives1::class
        ],
        'areas'                 => [
            Modules\Context\GeographicalLocation::class,
            Modules\Context\Areas::class,
            Modules\Context\Sectors::class,
            Modules\Context\TerritorialReferenceContext::class,
            Modules\Context\Objectives2::class,
        ],
        'resources'             => [
            Modules\Context\ManagementStaff::class,
            Modules\Context\ManagementStaffPartners::class,
            Modules\Context\ManagementStaffCommunities::class,
            Modules\Context\FinancialResources::class,
            Modules\Context\FinancialAvailableResources::class,
            Modules\Context\FinancialResourcesBudgetLines::class,
            Modules\Context\FinancialResourcesPartners::class,
            Modules\Context\Equipments::class,
            Modules\Context\Objectives3::class,
        ],
        'key_elements'          => [
            Modules\Context\AnimalSpecies::class,
            Modules\Context\VegetalSpecies::class,
            Modules\Context\Habitats::class,
            Modules\Context\HabitatsMarine::class,
            Modules\Context\LandCover::class,
            Modules\Context\Objectives4::class,
        ],
        'threats'               => [
            Modules\Context\MenacesPressions::class,
            Modules\Context\Objectives5::class,
        ],
        'climate'               => [
            Modules\Context\ClimateChange::class,
            Modules\Context\Objectives6::class,
        ],
        'ecosystem_services'    => [
            Modules\Context\EcosystemServices::class,
            Modules\Context\Objectives7::class,
        ],
        'objectives'            => [
            Modules\Context\Objectives1::class,
            Modules\Context\Objectives2::class,
            Modules\Context\Objectives3::class,
            Modules\Context\Objectives4::class,
            Modules\Context\Objectives5::class,
            Modules\Context\Objectives6::class,
            Modules\Context\Objectives7::class,
        ]
    ];

    /**
     * Override parent scopeFilterList()
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterList($query, Request $request)
    {
        $query
            ->where('version', static::version)
            ->orderBy('Year', 'desc')
            ->orderBy('wdpa_id', 'desc');

        return $query;
    }


    /**
     * Get IMET available years for the given PA
     * @param $wdpa_id
     * @return mixed
     */
    public static function getYears($wdpa_id)
    {
        return (new static())
            ->where('wdpa_id', $wdpa_id)
            ->orderBy('Year','DESC')
            ->get();
    }

    /**
     * Upgrade modules from previous versions
     *
     * @param $data
     * @param bool $v1_to_v2
     * @param null $imet_version
     * @param null $db_version
     * @return array
     * @throws \ReflectionException
     */
    public static function upgradeModules($data, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        if(array_key_exists('FinancialResources', $data)){
            $data = FinancialAvailableResources::copyCurrencyFromCTX213($data);
            $data = FinancialResourcesBudgetLines::copyCurrencyFromCTX213($data);
            $data = FinancialResourcesPartners::copyCurrencyFromCTX213($data);
        }

        $upgraded_data = [];
        /** @var \App\Models\Imet\v2\Modules\Component\ImetModule $module_class */
        foreach (static::allModules() as $module_class) {
            if(array_key_exists($module_class::getShortClassName(), $data)){
                $upgraded_data[$module_class::getShortClassName()]
                    = $module_class::upgradeModuleRecords($data[$module_class::getShortClassName()], $v1_to_v2, $imet_version, $db_version);
            }
        }
        return $upgraded_data;
    }

    /**
     * Override: upgrade records before importing
     *
     * @param $data
     * @param $formID
     * @param bool $v1_to_v2
     * @param null $imet_version
     * @param null $db_version
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public static function importModules($data, $formID, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        $data = static::upgradeModules($data, $v1_to_v2, $imet_version, $db_version);
        parent::importModules($data, $formID);
    }


}
