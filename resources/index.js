/* Import packages */
import '@modular-forms/index.js';
import '@imet-core/index.js';

// ##### Import local styles #####
import './index.css';

// Global variables - make them accessible from modules and from blade views
window.Laravel = window.Laravel || {};

// Apps
window.OfflineImet = {}

import SettingsApp from "./js/SettingsApp.js";
window.OfflineImet.SettingsApp = SettingsApp;
