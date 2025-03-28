<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1;

use AndreaMarelli\ImetCore\Models\Imet\Encoder;
use AndreaMarelli\ImetCore\Models\Imet\Imet as BaseImetForm;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\ResponsablesInterviewees;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\ResponsablesInterviewers;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Imet extends BaseImetForm
{
    public const version = 'v1';

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
            Modules\Context\ControlLevel::class,
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
            Modules\Context\NonSustainableUsage::class,
            Modules\Context\Objectives4::class,
        ],
        'threats'               => [
            Modules\Context\MenacesPressions::class,
            Modules\Context\Objectives5::class,
        ],
        'climate'               => [
            Modules\Context\ClimateChangeImportanceElements::class,
            Modules\Context\ClimateChange::class,
            Modules\Context\Objectives6::class,
        ],
        'ecosystem_services'    => [
            Modules\Context\EcosystemServices::class,
            Modules\Context\EcosystemServicesTendance::class,
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsible_interviewees(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewees::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }

    /**
     * Relation to ResponsablesInterviewers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsible_interviewers(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewers::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }

}
