
import map from './mixins/map.mixin';
import layers_interactivity from "./mixins/layers/interactivity.mixin";
import visible_components from "./mixins/visible_components";
import visible_components_store from "./store_modules/visible_components";


window.AnalyticalPlatformMapDemo = Vue.extend({

    mixins: [
        map,
        layers_interactivity,
        visible_components
    ],

    store: new window.Vuex.Store({
        modules: {
            visible_components: visible_components_store
        }
    }),

    data: function () {
        return {

            Locale: window.Locale,
            csrf: window.Laravel.csrfToken,

            layers: {
                demo: {
                    landscapes_water_transitions: window.WebMapping.Mapbox.Layers.landscapes_water_transitions,
                    landscapes_forest_loss_masked: window.WebMapping.Mapbox.Layers.landscapes_forest_loss_masked,
                    landscapes_forest_mask: window.WebMapping.Mapbox.Layers.landscapes_forest_mask,
                    //lc300_class4_1995: window.WebMapping.Mapbox.Layers.lc300_class4_1995,
                    //lc300_class4_2015: window.WebMapping.Mapbox.Layers.lc300_class4_2015,
                    //lc300_class4_2018: window.WebMapping.Mapbox.Layers.lc300_class4_2018,
                    landscapes_lc300_1995_2015: window.WebMapping.Mapbox.Layers.landscapes_lc300_1995_2015,
                    landscapes_lc300_2015_2018: window.WebMapping.Mapbox.Layers.landscapes_lc300_2015_2018,
                    landscapes_above_ground_carbon: window.WebMapping.Mapbox.Layers.landscapes_above_ground_carbon,
                    landscapes_below_ground_carbon: window.WebMapping.Mapbox.Layers.landscapes_below_ground_carbon,
                    landscapes_soil_organic_carbon: window.WebMapping.Mapbox.Layers.landscapes_soil_organic_carbon,
                    landscapes_total_carbon: window.WebMapping.Mapbox.Layers.landscapes_total_carbon,
                },
                overlays: {
                    comifac_mask: window.WebMapping.Mapbox.Layers.comifac_mask,
                    comifac_eez: window.WebMapping.Mapbox.Layers.comifac_eez,
                    countries: window.WebMapping.Mapbox.Layers.countries,
                    landscapes: window.WebMapping.Mapbox.Layers.landscapes,
                    klc: window.WebMapping.Mapbox.Layers.klc,
                    concessions: window.WebMapping.Mapbox.Layers.concessions,
                    protected_areas: window.WebMapping.Mapbox.Layers.protected_areas
                }
            },

            map_loading: false,

            close_layer_selector_onclick: false
        }
    },

    mounted(){
        this.initMap();
        this.map_loading = false;
    },

    methods: {

    }

});
