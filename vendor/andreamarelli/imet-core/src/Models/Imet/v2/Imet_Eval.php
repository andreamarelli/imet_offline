<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2;


class Imet_Eval extends Imet{

    public static $modules = [
        'context' => [
            Modules\Evaluation\ImportanceClassification::class,
            Modules\Evaluation\ObjectivesClassification::class,
            Modules\Evaluation\ImportanceSpecies::class,
            Modules\Evaluation\ObjectivesSpecies::class,
            Modules\Evaluation\ImportanceHabitats::class,
            Modules\Evaluation\ObjectivesHabitats::class,
            Modules\Evaluation\ImportanceClimateChange::class,
            Modules\Evaluation\ObjectivesClimateChange::class,
            Modules\Evaluation\ImportanceEcosystemServices::class,
            Modules\Evaluation\ObjectivesEcosystemServices::class,
            Modules\Evaluation\SupportsAndConstraints::class,
            Modules\Evaluation\ObjectivesSupportsAndConstraints::class,
            Modules\Evaluation\Menaces::class,
            Modules\Evaluation\ObjectivesMenaces::class
        ],
        'planning' => [
            Modules\Evaluation\RegulationsAdequacy::class,
            Modules\Evaluation\DesignAdequacy::class,
            Modules\Evaluation\BoundaryLevel::class,
            Modules\Evaluation\ManagementPlan::class,
            Modules\Evaluation\WorkPlan::class,
            Modules\Evaluation\Objectives::class,
            Modules\Evaluation\ObjectivesPlanification::class
        ],
        'inputs' => [
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\Staff::class,
            Modules\Evaluation\BudgetAdequacy::class,
            Modules\Evaluation\BudgetSecurization::class,
            Modules\Evaluation\ManagementEquipmentAdequacy::class,
            Modules\Evaluation\ObjectivesIntrants::class
        ],
        'process' => [
            Modules\Evaluation\StaffCompetence::class,
            Modules\Evaluation\HRmanagementPolitics::class,
            Modules\Evaluation\HRmanagementSystems::class,
            Modules\Evaluation\GovernanceLeadership::class,
            Modules\Evaluation\AdministrativeManagement::class,
            Modules\Evaluation\EquipmentMaintenance::class,
            Modules\Evaluation\ManagementActivities::class,
            Modules\Evaluation\LawEnforcementImplementation::class,
            Modules\Evaluation\IntelligenceImplementation::class,
            Modules\Evaluation\StakeholderCooperation::class,
            Modules\Evaluation\AssistanceActivities::class,
            Modules\Evaluation\EnvironmentalEducation::class,
            Modules\Evaluation\VisitorsManagement::class,
            Modules\Evaluation\VisitorsImpact::class,
            Modules\Evaluation\NaturalResourcesMonitoring::class,
            Modules\Evaluation\ResearchAndMonitoring::class,
            Modules\Evaluation\ClimateChangeMonitoring::class,
            Modules\Evaluation\EcosystemServices::class,
            Modules\Evaluation\ObjectivesProcessus::class
        ],
        'outputs' => [
            Modules\Evaluation\WorkProgramImplementation::class,
            Modules\Evaluation\AchievedResults::class,
            Modules\Evaluation\AreaDomination::class
        ],
        'outcomes' => [
            Modules\Evaluation\AchievedObjectives::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\LifeQualityImpact::class,
        ],
        'objectives' => [
            Modules\Evaluation\ObjectivesClassification::class,
            Modules\Evaluation\ObjectivesSpecies::class,
            Modules\Evaluation\ObjectivesHabitats::class,
            Modules\Evaluation\ObjectivesClimateChange::class,
            Modules\Evaluation\ObjectivesEcosystemServices::class,
            Modules\Evaluation\ObjectivesSupportsAndConstraints::class,
            Modules\Evaluation\ObjectivesMenaces::class,
            Modules\Evaluation\ObjectivesPlanification::class,
            Modules\Evaluation\ObjectivesIntrants::class,
            Modules\Evaluation\ObjectivesProcessus::class,
        ],
        'management_effectiveness' => [

        ],
    ];

}
