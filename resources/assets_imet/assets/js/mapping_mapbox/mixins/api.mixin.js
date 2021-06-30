export default {

    data() {
        return {
            api_cancel_token: null,
            api_loading: false,
            card_has_data: false,
            api_data: {
                forest_management: {
                    regional: null,
                    national: null,
                    concessions: null,
                },
                biodiversity: {
                    regional: null,
                    national: null,
                    protected_areas: null,
                },
            },
            visible_hidden_components: []
        }
    },

    mounted(){
        let _this = this;

        // call toggle functions
        window.vueBus.$on('toggle_hidden_component', function (component) {
            _this.toggle_hidden_component(component);
        });
    },

    methods:{

        toggle_hidden_component(component){
            if(this.visible_hidden_components.includes(component)){
                this.visible_hidden_components.splice(this.visible_hidden_components.indexOf(component), 1);
            } else {
                this.visible_hidden_components.push(component);
            }
        },

        is_hidden_component_visible(component){
            return this.visible_hidden_components.includes(component);
        },

        // ##############################################
        // ##########  Retrieve DATA from APIs ##########
        // ##############################################

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

        getAPI(site){
            let _this = this;
            this.site = site || null;

            this.api_loading = true;
            this.card_has_data = false;
            this.selected_card = this.theme + '_' + this.level;
            this.visible_hidden_components = [];

            // set API url
            let url = this.level === 'regional'
                ? 'api/analysis/' + this.theme + '/' + this.level
                : 'api/analysis/' + this.theme + '/' + this.level + '/' + site;

            // set API responseCallback
            let responseCallback = function(response){
                // store response in api_data
                if (_this.level === 'regional') {
                    _this.api_data[_this.theme][_this.level] = response;
                } else {
                    _this.api_data[_this.theme][_this.level] = _this.api_data[_this.theme][_this.level] || {};
                    _this.api_data[_this.theme][_this.level][site] = response;
                }
                // set related cards + button
                Vue.nextTick(function () {
                    _this.selected_card = _this.theme + '_' + _this.level;
                    _this.card_has_data = true;
                    Vue.nextTick(function () {
                        let first_button = document.querySelectorAll('.card-api.card-' + _this.theme + '_' + _this.level + ' .selection:first-of-type')[0];
                        if (first_button) {
                            _this.selected_card_button = first_button.getAttribute('data-card-key');
                        }
                    });
                });
            }

            this.__retrieveAPI(url, responseCallback);

        },

        __retrieveAPI(url, responseCallback){
            let _this = this;

            // Cancel previous API request if still running
            if (this.api_cancel_token !== null) {
                this.api_cancel_token();
            }

            // Check and retrieve cached data (if any)
            let cached = this.getCachedData();
            if(cached!==null){
                console.log('Request to API not executed. Data retrieved from cache.');
                responseCallback(JSON.parse(JSON.stringify(cached)));
                this.finallyCallback();
                return;
            }

            window.axios({
                method: 'post',
                url: window.Laravel.baseUrl + url,
                data: {
                    _token: _this.csrf,
                },
                cancelToken: new window.axios.CancelToken(function executor(c) {
                    _this.api_cancel_token = c;
                }),
            })
                .then(function (response) {
                    console.log('Request to API executed');
                    responseCallback(response.data);
                })
                .catch(function (error) {
                    if (window.axios.isCancel(error)) {
                        console.log('Request to API canceled. No more necessary', error.message);
                    } else {
                        console.log(error);
                    }
                })
                .finally(function () {
                    _this.finallyCallback();
                });
        },

        finallyCallback(){
            this.api_cancel_token = null;
            this.api_loading = false;
            this.removeLayerPopup();
        }

    }
}