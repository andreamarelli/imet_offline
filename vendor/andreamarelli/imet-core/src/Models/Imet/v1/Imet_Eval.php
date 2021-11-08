<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1;


class Imet_Eval extends Imet{

    public static $modules = [
        'context' => [
            Modules\Evaluation\ImportanceGovernance::class,
            Modules\Evaluation\ObjectivesGovernance::class,
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
            Modules\Evaluation\ProtectionActivities::class,
            Modules\Evaluation\Control::class,
            Modules\Evaluation\LawEnforcement::class,
            Modules\Evaluation\Implications::class,
            Modules\Evaluation\AssistanceActivities::class,
            Modules\Evaluation\ActorsRelations::class,
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
            Modules\Evaluation\AchievedResults::class
        ],
        'outcomes' => [
            Modules\Evaluation\AchievedObjectives::class,
            Modules\Evaluation\DesignatedValuesConservation::class,
            Modules\Evaluation\DesignatedValuesConservationTendency::class,
            Modules\Evaluation\LocalCommunitiesImpact::class,
            Modules\Evaluation\ClimateChangeImpact::class,
            Modules\Evaluation\EcosystemServicesImpact::class
        ],
        'management_effectiveness' => [

        ],
    ];

}
