// Import stylesheets
import "./index.css";

// Global variables - make them accessible from modules and from blade views
window.Laravel = window.Laravel || {};
window.ModularForms = {};
window.ModularFormsVendor = window.ModularFormsVendor || {};

// #############################################
// ###########  Helpers & Components  ###########
// #############################################
window.ModularForms.Helpers = window.ModularForms.Helpers || {};
window.ModularForms.Components = window.ModularForms.Components || {};

import Locale from "./js/helpers/locale.js";
window.ModularForms.Helpers.Locale = Locale;

import Animation from "./js/helpers/animation.js";
window.ModularForms.Helpers.Animation = Animation;

import Common from "./js/helpers/common.js";
window.ModularForms.Helpers.Common = Common;

import Cookie from "./js/helpers/cookie.js";
window.ModularForms.Helpers.Cookie = Cookie;

import Payload from "./js/helpers/payload.js";
window.ModularForms.Helpers.Payload = Payload;

// make selectorDialog component available for project custom selectors
import selectorDialog from "./js/inputs/components/selector-dialog.vue";
window.ModularForms.Components.selectorDialog = selectorDialog;

// ############################################
// ##################  Apps  ##################
// ############################################
window.ModularForms.Apps = window.ModularForms.Apps || {};

import Base from "./js/apps/Base.js";
window.ModularForms.Apps.Base = Base;

import FormList from "./js/apps/FormList.js";
window.ModularForms.Apps.FormList = FormList;

import FormErrors from "./js/apps/FormErrors.js";
window.ModularForms.Apps.FormErrors = FormErrors;

import Module from "./js/apps/Module.js";
window.ModularForms.Apps.Module = Module;

// ############################################
// ##############  Local assets  ##############
// ############################################

import Accordion from "./js/components/accordion.js";
window.ModularForms.Accordion = Accordion;


// #############################################
// ##############  Static assets  ##############
// #############################################

// Flags
import "~/flag-icons"
