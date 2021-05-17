
import map from './mixins/map.mixin';
import library from './mixins/library.mixin';
import projects from './mixins/projects.mixin';
import api from './mixins/api.mixin';

import utils from './mixins/utils/utils.mixin';
import choropleth from './mixins/utils/choropleth.mixin';

import layers_interactivity from './mixins/layers/interactivity.mixin';
import visible_components from "./mixins/visible_components";
import visible_components_store from "./store_modules/visible_components";

window.AnalyticalPlatform = Vue.extend({

    mixins: [
        map,
        library,
        projects,
        api,
        utils,
        layers_interactivity,
        choropleth,
        visible_components
    ],

    store: new window.Vuex.Store({
        modules: {
            visible_components: visible_components_store
        }
    }),

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
            if(this.theme==='convergence_plan'){
                this.level = 'regional';
                this.getAPI();
            }
        },
        level: function(){
            this.site = null;
            this.reset();
            this.refresh();
            if(this.level==='regional'){
                this.getAPI();
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
            this.refreshExclusiveLayers();
            this.refreshThematicLayer();
            this.refreshInteractiveLayers();
            this.refreshLibrary();
            this.refreshProjects();
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
            let _this = this;
            this.library.show = false;
            this.projects.show = false;
            if(this.selected_card_button!==null){
                $('.collapse').collapse('hide'); // necessary 'cause there's a conflict between bootstrap4 and VueJS in accordion body
            }

            this.selected_card_button = null;
            Vue.nextTick(function () {
                if(_this.selected_card_button!==button){
                    _this.selected_card_button = button;
                }
            });
        },

    }

});
