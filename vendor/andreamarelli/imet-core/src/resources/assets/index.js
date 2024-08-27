// Import stylesheets
import "./index.css";

// Global variables - make them accessible from modules and from blade views
window.Laravel = window.Laravel || {};
window.ImetCore = {};

// ############################################
// ##########  Helpers & Components  ##########
// ############################################
window.ImetCore.Helpers = {};
window.ImetCore.Components = {};


// ############################################
// #################  MAPBOX  #################
// ############################################
import mapboxgl from '~/mapbox-gl';
window.mapboxgl = mapboxgl;
window.mapboxgl.accessToken = import.meta.env.MAPBOX_ACCESS_TOKEN;

import BiopamaWDPA from "./js/helpers/biopamaWDPA.js";
window.ImetCore.Helpers.BiopamaWDPA = BiopamaWDPA;


// ############################################
// ##################  Apps  ##################
// ############################################
window.ImetCore.Apps = {};

import BaseImet from "./js/apps/Base.js"; // Extend Base from ModularForms
window.ImetCore.Apps.Base = BaseImet;

import FormListImet from "./js/apps/FormList.js";  // Extend FormList from ModularForms
window.ImetCore.Apps.FormList = FormListImet;

import ModuleImet from "./js/apps/Module.js";  // Extend FormList from ModularForms
window.ImetCore.Apps.Module = ModuleImet;

import AssessmentScores from "./js/apps/AssessmentScores.js";
window.ImetCore.Apps.AssessmentScores = AssessmentScores;


// ############################################
// #############  Custom Modules  #############
// ############################################
window.ImetCore.Apps.Modules = {
    ImetV1: {
        context: {},
        evaluation: {}
    },
    ImetV2: {
        context: {},
        evaluation: {}
    },
    Oecm: {
        context: {},
        evaluation: {}
    }
}

import Create from "./js/apps/Modules/ImetV2/Create";
window.ImetCore.Apps.Modules.ImetV2.Create = Create;

import CreateNonWDPA from "./js/apps/Modules/ImetV2/CreateNonWDPA";
window.ImetCore.Apps.Modules.ImetV2.CreateNonWDPA = CreateNonWDPA;

import CreateOecm from "./js/apps/Modules/ImetV2/Create";
window.ImetCore.Apps.Modules.Oecm.Create = CreateOecm;

import CreateNonWDPAOecm from "./js/apps/Modules/ImetV2/CreateNonWDPA";
window.ImetCore.Apps.Modules.Oecm.CreateNonWDPA = CreateNonWDPAOecm;

// ##### ImetV1 - context #####

import {default as AreasV1} from "./js/apps/Modules/ImetV1/context/Areas";
window.ImetCore.Apps.Modules.ImetV1.context.Areas = AreasV1;

import ControlLevel from "./js/apps/Modules/ImetV1/context/ControlLevel";
window.ImetCore.Apps.Modules.ImetV1.context.ControlLevel = ControlLevel;

import {default as ManagementStaffV1} from "./js/apps/Modules/ImetV1/context/ManagementStaff";
window.ImetCore.Apps.Modules.ImetV1.context.ManagementStaff = ManagementStaffV1;

import {default as FinancialResourcesV1} from "./js/apps/Modules/ImetV1/context/FinancialResources";
window.ImetCore.Apps.Modules.ImetV1.context.FinancialResources = FinancialResourcesV1;

import {default as FinancialAvailableResourcesV1} from "./js/apps/Modules/ImetV1/context/FinancialAvailableResources";
window.ImetCore.Apps.Modules.ImetV1.context.FinancialAvailableResources = FinancialAvailableResourcesV1;

import {default as FinancialResourcesBudgetLinesV1} from "./js/apps/Modules/ImetV1/context/FinancialResourcesBudgetLines";
window.ImetCore.Apps.Modules.ImetV1.context.FinancialResourcesBudgetLines = FinancialResourcesBudgetLinesV1;

import {default as EquipmentsV1} from "./js/apps/Modules/ImetV1/context/Equipments";
window.ImetCore.Apps.Modules.ImetV1.context.Equipments = EquipmentsV1;

import {default as MenacesPressionsV1} from "./js/apps/Modules/ImetV1/context/MenacesPressions";
window.ImetCore.Apps.Modules.ImetV1.context.MenacesPressions = MenacesPressionsV1;

import {default as EcosystemServicesV1} from "./js/apps/Modules/ImetV1/context/EcosystemServices";
window.ImetCore.Apps.Modules.ImetV1.context.EcosystemServices = EcosystemServicesV1;

// ##### ImetV1 - evaluation  #####

import Menaces from "./js/apps/Modules/ImetV1/evaluation/Menaces";
window.ImetCore.Apps.Modules.ImetV1.evaluation.Menaces = Menaces;

import InformationAvailability from "./js/apps/Modules/ImetV1/evaluation/InformationAvailability";
window.ImetCore.Apps.Modules.ImetV1.evaluation.InformationAvailability = InformationAvailability;

import DesignatedValuesConservation from "./js/apps/Modules/ImetV1/evaluation/DesignatedValuesConservation";
window.ImetCore.Apps.Modules.ImetV1.evaluation.DesignatedValuesConservation = DesignatedValuesConservation;

import DesignatedValuesConservationTendency from "./js/apps/Modules/ImetV1/evaluation/DesignatedValuesConservationTendency";
window.ImetCore.Apps.Modules.ImetV1.evaluation.DesignatedValuesConservationTendency = DesignatedValuesConservationTendency;

// ##### ImetV2 - context #####

import GeographicalLocation from "./js/apps/Modules/ImetV2/context/GeographicalLocation";
window.ImetCore.Apps.Modules.ImetV2.context.GeographicalLocation = GeographicalLocation;

import Areas from "./js/apps/Modules/ImetV2/context/Areas";
window.ImetCore.Apps.Modules.ImetV2.context.Areas = Areas;

import Sectors from "./js/apps/Modules/ImetV2/context/Sectors";
window.ImetCore.Apps.Modules.ImetV2.context.Sectors = Sectors;

import ManagementStaff from "./js/apps/Modules/ImetV2/context/ManagementStaff";
window.ImetCore.Apps.Modules.ImetV2.context.ManagementStaff = ManagementStaff;

import FinancialResources from "./js/apps/Modules/ImetV2/context/FinancialResources";
window.ImetCore.Apps.Modules.ImetV2.context.FinancialResources = FinancialResources;

import FinancialAvailableResources from "./js/apps/Modules/ImetV2/context/FinancialAvailableResources";
window.ImetCore.Apps.Modules.ImetV2.context.FinancialAvailableResources = FinancialAvailableResources;

import FinancialResourcesBudgetLines from "./js/apps/Modules/ImetV2/context/FinancialResourcesBudgetLines";
window.ImetCore.Apps.Modules.ImetV2.context.FinancialResourcesBudgetLines = FinancialResourcesBudgetLines;

import Equipments from "./js/apps/Modules/ImetV2/context/Equipments";
window.ImetCore.Apps.Modules.ImetV2.context.Equipments = Equipments;

import MenacesPressions from "./js/apps/Modules/ImetV2/context/MenacesPressions";
window.ImetCore.Apps.Modules.ImetV2.context.MenacesPressions = MenacesPressions;

import EcosystemServices from "./js/apps/Modules/ImetV2/context/EcosystemServices";
window.ImetCore.Apps.Modules.ImetV2.context.EcosystemServices = EcosystemServices;

// ##### ImetV2 - evaluation #####

import RegulationsAdequacy from "./js/apps/Modules/ImetV2/evaluation/RegulationsAdequacy";
window.ImetCore.Apps.Modules.ImetV2.evaluation.RegulationsAdequacy = RegulationsAdequacy;

import DesignAdequacy from "./js/apps/Modules/ImetV2/evaluation/DesignAdequacy";
window.ImetCore.Apps.Modules.ImetV2.evaluation.DesignAdequacy = DesignAdequacy;

import BoundaryLevel from "./js/apps/Modules/ImetV2/evaluation/BoundaryLevel";
window.ImetCore.Apps.Modules.ImetV2.evaluation.BoundaryLevel = BoundaryLevel;

import ManagementPlan from "./js/apps/Modules/ImetV2/evaluation/ManagementPlan";
window.ImetCore.Apps.Modules.ImetV2.evaluation.ManagementPlan = ManagementPlan;

import WorkPlan from "./js/apps/Modules/ImetV2/evaluation/WorkPlan";
window.ImetCore.Apps.Modules.ImetV2.evaluation.WorkPlan = WorkPlan;

import AssistanceActivities from "./js/apps/Modules/ImetV2/evaluation/AssistanceActivities";
window.ImetCore.Apps.Modules.ImetV2.evaluation.AssistanceActivities = AssistanceActivities;

import LifeQualityImpact from "./js/apps/Modules/ImetV2/evaluation/LifeQualityImpact";
window.ImetCore.Apps.Modules.ImetV2.evaluation.LifeQualityImpact = LifeQualityImpact;

// ##### OECM - context #####

import Governance from "./js/apps/Modules/Oecm/context/Governance";
window.ImetCore.Apps.Modules.Oecm.context.Governance = Governance;

import { default as AreasOecm } from "./js/apps/Modules/Oecm/context/Areas";
window.ImetCore.Apps.Modules.Oecm.context.Areas = AreasOecm;

import ManagementRelativeImportance from "./js/apps/Modules/Oecm/context/ManagementRelativeImportance";
window.ImetCore.Apps.Modules.Oecm.context.ManagementRelativeImportance = ManagementRelativeImportance;

import ManagementStaffOecm from "./js/apps/Modules/Oecm/context/ManagementStaff";
window.ImetCore.Apps.Modules.Oecm.context.ManagementStaff = ManagementStaffOecm;

import AnalysisStakeholderSummary from "./js/apps/Modules/Oecm/context/AnalysisStakeholderSummary";
window.ImetCore.Apps.Modules.Oecm.context.AnalysisStakeholderSummary = AnalysisStakeholderSummary;

import AnalysisStakeholder from "./js/apps/Modules/Oecm/context/AnalysisStakeholder";
window.ImetCore.Apps.Modules.Oecm.context.AnalysisStakeholder = AnalysisStakeholder;

// ##### OECM - evaluation #####

import Threats from "./js/apps/Modules/Oecm/evaluation/Threats";
window.ImetCore.Apps.Modules.Oecm.evaluation.Threats = Threats;

import KeyElements from "./js/apps/Modules/Oecm/evaluation/KeyElements";
window.ImetCore.Apps.Modules.Oecm.evaluation.KeyElements = KeyElements;

import KeyElementsImpact from "./js/apps/Modules/Oecm/evaluation/KeyElementsImpact";
window.ImetCore.Apps.Modules.Oecm.evaluation.KeyElementsImpact = KeyElementsImpact;

import LifeQualityImpactOecm from "./js/apps/Modules/Oecm/evaluation/LifeQualityImpact";
window.ImetCore.Apps.Modules.Oecm.evaluation.LifeQualityImpact = LifeQualityImpactOecm;

// TODO: Below are OLD imports: need to be reviewed/removed

// // Templates
// Vue.component("dopa_chart_bar",                 require("./js/templates/dopa/chart_bar.vue").default);
// Vue.component("dopa_indicators_table",          require("./js/templates/dopa/indicators_table.vue").default);
// Vue.component("dopa_radar",                     require("./js/templates/dopa/chart_radar.vue").default);
// window.ImetCore.Dopa = {
//     "chart_bar": require("./js/templates/dopa/chart_bar.vue").default,
//     "chart_doughnut": require("./js/templates/dopa/chart_doughnut.vue").default
// };
// Vue.component("imet_encoders_responsibles",     require("./js/templates/imet_encoders_responsibles.vue").default);
// Vue.component("imet_score_bar",              require("./js/templates/imet_score_bar.vue").default);
// Vue.component("imet_radar",                     require("./js/templates/imet_radar.vue").default);
// Vue.component("imet_bar_chart",                 require("./js/templates/imet_bar_chart.vue").default);

// // Report
// Vue.component("table_input",                    require("./js/report/table_input.vue").default);
// Vue.component("roadmap",                    require("./js/report/roadmap.vue").default);
// Vue.component("objectives",                    require("./js/report/objectives.vue").default);
//
// // Components for IMET scaling up
// require("./js/scaling_up_analysis/components.js");
