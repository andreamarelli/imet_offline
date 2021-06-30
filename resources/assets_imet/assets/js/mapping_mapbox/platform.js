
import map from './mixins/map.mixin';
import library from './mixins/library.mixin';
import projects from './mixins/projects.mixin';
import api from './mixins/api.mixin';

import utils from './mixins/utils/utils.mixin';
import choropleth from './mixins/utils/choropleth.mixin';

import layers_interactivity from './mixins/layers/interactivity.mixin';
import data_driven_layers from './mixins/layers/data_driven.mixin';


window.WebMapping.Mapbox.Platform = Vue.extend({

    mixins: [
        map,
        library,
        projects,
        api,
        utils,
        layers_interactivity,
        data_driven_layers,
        choropleth
    ],

    created(){
        this.theme = this.theme==='' ? null : this.theme;
        this.level = this.level==='' ? null : this.level;
        this.site = this.site==='' ? null : this.site;
    },

    data: function () {
        return {

            Locale: window.Locale,
            csrf: window.Laravel.csrfToken,

            zoomBBoxPadding: 75, // in pixels

            layers: {
                backgrounds: {
                    comifac: window.WebMapping.Mapbox.Layers.comifac,
                    spotvgt: window.WebMapping.Mapbox.Layers.spotvgt,
                    modis: window.WebMapping.Mapbox.Layers.modis,
                    srtm: window.WebMapping.Mapbox.Layers.srtm,
                    glc2000: window.WebMapping.Mapbox.Layers.glc2000,
                    congo_basin_vegetation_map: window.WebMapping.Mapbox.Layers.congo_basin_vegetation_map,
                    total_carbon: window.WebMapping.Mapbox.Layers.total_carbon,
                },
                dopa_resources: {
                    land_cover: window.WebMapping.Mapbox.Layers.land_cover,
                    land_cover_change: window.WebMapping.Mapbox.Layers.land_cover_change,
                    land_fragmentation: window.WebMapping.Mapbox.Layers.land_fragmentation,
                    land_degradation: window.WebMapping.Mapbox.Layers.land_degradation,
                    soil_organic_carbon: window.WebMapping.Mapbox.Layers.soil_organic_carbon,
                    above_ground_carbon: window.WebMapping.Mapbox.Layers.above_ground_carbon,
                },
                external_resources: {
                    tree_cover: window.WebMapping.Mapbox.Layers.tree_cover,
                    intact_forest: window.WebMapping.Mapbox.Layers.intact_forest,
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

            // UI selections
            selected_card: false,
            selected_card_button: null,
        }
    },

    watch: {
        theme: function(){
            this.reset();
            this.level = null;
            this.site = null;
            this.refresh();
        },
        level: function(){
            this.site = null;
            this.reset();
            this.refresh();
            if(this.level==='regional'){
                this.getAPI();
            }
            if(this.level==='concessions' || this.level==='protected_areas'){
                this.addLayer(this.level, 'overlays');
            }
        },
        site: function (value) {
            this.reset();
            this.refresh();
            if(this.level==='national' || this.site!==null){
                this.getAPI(this.site);
            }
        }
    },

    mounted(){
        this.initMap();
        this.refreshLibrary();
        this.refreshProjects();
        this.map_loading = false;
        this.api_loading = false;
    },

    methods: {

        reset(){
            // console.log('level changed |', 'theme: '+this.theme, ', level: '+this.level, ', site: '+this.site);
            this.show_layer_selector = false;
            this.removeLayerPopup();
            this.selected_card = null;
            this.selected_card_button = null;
        },

        refresh(){
            if (this.level==='regional') {
                this.zoomToBBox(this.extents['comifac']);
            } else if(this.level==='national' && this.site!==null) {
                this.zoomToBBox(this.extents[this.level][this.site]);
            }
            this.refreshInteractiveLayers();
            this.refreshLibrary();
            this.refreshProjects();
        },


        // #######################################################
        // ######  Manage dynamic layers' interactivity  #########
        // #######################################################

        refreshInteractiveLayers(){
            // countries
            this.showPopup('countries');
            this.mouseOver('countries');
            this.hoverOnRelatedLayer('countries', 'comifac_eez', 'iso3', 'ISO_Ter1');
            this.setMask('countries',
                (this.level==='national' && this.site!==null),
                'iso3',
                this.site
            );
            // eez
            this.mouseOver('comifac_eez');
            this.hoverOnRelatedLayer('comifac_eez', 'countries', 'ISO_Ter1', 'iso3');
            this.setMask('comifac_eez',
                (this.level==='national' && this.site!==null),
                'ISO_Ter1',
                this.site
            );
            // landscapes
            this.showPopup('landscapes');
            this.mouseOver('landscapes');
            // klc
            this.showPopup('klc');
            this.mouseOver('klc');
            // protected_areas
            this.showPopup('protected_areas');
            this.mouseOver('protected_areas');
            this.setHighlight('protected_areas',
                (this.level==='national' && this.site!==null),
                'country',
                this.site
            );
            // concessions
            this.showPopup('concessions');
            this.mouseOver('concessions');
            this.setHighlight('concessions',
                (this.level==='national' && this.site!==null),
                'country',
                this.site
            );
        },


        // ##############################################
        // ###############  Manage cards  ###############
        // ##############################################

        toggleLayersSelector(){
            this.show_layer_selector = !this.show_layer_selector;
            if(this.show_layer_selector){
                this.library.show = false;
                this.projects.show = false;
            }
        },

        toggleLibrary(){
            this.library.show = !this.library.show;
            if(this.library.show){
                this.show_layer_selector = false;
                this.projects.show = false;
            }
        },

        toggleProjects(){
            this.projects.show = !this.projects.show;
            if(this.projects.show){
                this.show_layer_selector = false;
                this.library.show = false;
            }
        },

        showCardButton(button) {
            this.library.show = false;
            this.projects.show = false;
            if(this.selected_card_button!==null){
                $('.collapse').collapse('hide'); // necessary 'cause there's a conflict between bootstrap4 and VueJS in accordion body
            }
            if(this.selected_card_button!==button){
                this.selected_card_button = button;
            } else {
                this.selected_card_button = null;
            }
        },

    }

});
