BEGIN;

ALTER TABLE imet.context_territorial_reference_context ADD COLUMN "FunctionalHasNoTakeArea" boolean;
ALTER TABLE imet.context_territorial_reference_context RENAME COLUMN "ReferenceEcosystemAreaEstimation" TO "FunctionalKm2";
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN "FunctionalKm" numeric;
ALTER TABLE imet.context_territorial_reference_context RENAME COLUMN "ReferenceEcosystemAreaPopulation" TO "FunctionalPopulation";

ALTER TABLE imet.context_territorial_reference_context RENAME COLUMN "FunctionalArea" TO "BenefitKm2";
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN "BenefitKm" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN "BenefitPopulation" numeric;
ALTER TABLE imet.context_territorial_reference_context RENAME COLUMN "SocioEconomicAspects" TO "BenefitSocioEconomicAspects";

ALTER TABLE imet.context_territorial_reference_context ADD COLUMN "SpillOverKm2" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN "SpillOverKm" numeric;

COMMIT;
