<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AchievedObjectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AdministrativeManagement;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AssistanceActivities;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\BoundaryLevel;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\BudgetAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\BudgetSecurization;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\CapacityAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElementsImpact;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\DesignAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\InformationAvailability;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementEquipmentAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EmpowermentGovernance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EnvironmentalEducation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EquipmentMaintenance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\LawEnforcementImplementation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\LifeQualityImpact;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementActivities;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementGovernance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementPlan;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\NaturalResourcesMonitoring;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Objectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesContext;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesIntrants;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesPlanification;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesProcessus;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\RegulationsAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StakeholderCooperation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraintsIntegration;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Threats;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ThreatsBiodiversity;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ThreatsIntegration;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\VisitorsManagement;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkPlan;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StaffCompetence;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\HRmanagementPolitics;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkProgramImplementation;

class Imet_Eval extends Imet
{

    public static $modules = [
        'context' => [
            Designation::class,
            SupportsAndConstraints::class,
            SupportsAndConstraintsIntegration::class,
            ThreatsBiodiversity::class,
            Threats::class,             // histogram
                                        //   + score scale from -100 to 0
            ThreatsIntegration::class,  // sort ranking
            KeyElements::class,         // Formula: DONE
            ObjectivesContext::class
        ],
        'planning' => [
            RegulationsAdequacy::class,
            DesignAdequacy::class,
            BoundaryLevel::class,
            ManagementPlan::class,
            WorkPlan::class,
            Objectives::class,
            ObjectivesPlanification::class
        ],
        'inputs' => [
            InformationAvailability::class,
            CapacityAdequacy::class,
            BudgetAdequacy::class,
            BudgetSecurization::class,
            ManagementEquipmentAdequacy::class,
            ObjectivesIntrants::class
        ],
        'process' => [
            StaffCompetence::class,
            HRmanagementPolitics::class,
            EmpowermentGovernance::class,
            AdministrativeManagement::class,
            EquipmentMaintenance::class,
            ManagementActivities::class,
            NaturalResourcesMonitoring::class,
            LawEnforcementImplementation::class,
            StakeholderCooperation::class,
            AssistanceActivities::class,
            EnvironmentalEducation::class,
            VisitorsManagement::class,
            ObjectivesProcessus::class,

        ],
        'outputs' => [
            WorkProgramImplementation::class,
            ManagementGovernance::class
        ],
        'outcomes' => [
            AchievedObjectives::class,
            KeyElementsImpact::class,       // No formula yet
            LifeQualityImpact::class,
        ],
        'objectives' => [
            ObjectivesContext::class,
            ObjectivesPlanification::class,
            ObjectivesIntrants::class,
            ObjectivesProcessus::class,

        ],
        'management_effectiveness' => [],
    ];

}
