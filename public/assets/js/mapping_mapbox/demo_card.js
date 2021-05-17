import visible_components from "./mixins/visible_components";
import visible_components_store from "./store_modules/visible_components";


window.AnalyticalPlatformCardDemo = Vue.extend({

    mixins: [
        visible_components
    ],

    store: new window.Vuex.Store({
        modules: {
            visible_components: visible_components_store
        }
    }),

    data: function () {
        return {
            // specific for DEMO
            api_loading: false,
            api_errors: false,
            api_done: false,
            no_cache: false,

            // as for window.AnalyticalPlatform
            Locale: window.Locale,
            selected_card_button: null,
            selected_card_tab: null,
            card_has_data: false,
            api_cancel_token: null,
            api_data: {}
        }
    },

    methods:{

        layerIsOnMap(arg){
            return false;
        },

        // specific for DEMO
        load_demo_api(site){

            let _this = this;
            this.site = site;

            this.api_done = false;
            this.api_errors = false;
            this.api_loading = false;

            let url = this.level === 'regional'
                ? 'api/analysis/' + this.theme + '/' + this.level
                : 'api/analysis/' + this.theme + '/' + this.level + '/' + site;

            // Cancel previous API request if still running
            if (this.api_cancel_token !== null) {
                this.api_cancel_token();
            }

            this.api_loading = true;
            this.card_has_data = false;

            window.axios({
                method: 'post',
                url: window.Laravel.baseUrl + url,
                data: {
                    _token: window.Laravel.csrfToken,
                    no_cache: _this.no_cache
                },
                cancelToken: new window.axios.CancelToken(function executor(c) {
                    _this.api_cancel_token = c;
                }),
            })
                .then(function (response) {
                    console.log('Request to API executed');
                    _this.responseCallback(response.data);
                    _this.api_done = true;
                })
                .catch(function (error) {
                    if (window.axios.isCancel(error)) {
                        console.log('Request to API canceled. No more necessary', error.message);
                    } else {
                        console.log(error);
                        _this.api_errors = true;
                    }
                })
                .finally(function () {
                    _this.finallyCallback();
                });

        },

        responseCallback(response){
            console.log(response);
            this.api_data[this.theme] = this.api_data[this.theme] || [];
            this.api_data[this.theme][this.level] = this.api_data[this.theme][this.level] || [];
            if(this.level === 'regional'){
                this.api_data[this.theme][this.level] = response;
            } else {
                this.api_data[this.theme][this.level][this.site] = this.api_data[this.theme][this.level][this.site] || [];
                this.api_data[this.theme][this.level][this.site] = response;
            }
            this.card_has_data = true;
        },
        finallyCallback(){
            this.api_loading = false;
        },


        // as for window.AnalyticalPlatform
        showCardButton(button) {
            if (this.selected_card_button !== button) {
                this.selected_card_button = button;
            } else {
                this.selected_card_button = null;
            }
        },

        getCachedData() {
            if(this.level!=='local'){
                if(this.level==='regional'){
                    return this.api_data[this.theme][this.level];
                } else if(this.site!==null
                    && this.api_data[this.theme][this.level] !== null
                    && this.api_data[this.theme][this.level].hasOwnProperty(this.site)
                ){
                    return this.api_data[this.theme][this.level][this.site];
                }
            }
            return null;
        },

        getDataAttribute(attribute_path){
            let data = this.getCachedData();
            if(data!==null){
                // return data[attribute_path];
                let deepFind = function(data, attribute_path){
                    let paths = attribute_path.split('.');
                    let current = data;
                    for (let i=0; i<paths.length; ++i) {
                        if (!current.hasOwnProperty(paths[i])) {
                            return null;
                        } else {
                            current = current[paths[i]];
                        }
                    }
                    return current;
                };
                return deepFind(data, attribute_path)
            }
            return null;
        },

    }

});
