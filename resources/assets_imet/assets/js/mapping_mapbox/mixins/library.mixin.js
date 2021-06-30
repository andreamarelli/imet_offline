export default {

    data() {
        return {
            api_library_cancel_token: null,
            library: {
                data: null,
                count: null,
                show: false,
                loading: false,
                show_filters: false,
                filter_domain: null
            }
        }
    },

    computed:{
        filtered_library: function () {
            let _this = this;
            let list = this.library.data;
            // sort
            list = _.orderBy(list, 'title', 'asc')
            // filter
            list = list.filter(function (item) {
                if(_this.library.filter_domain!==null && _this.library.filter_domain!==''){
                    return item.domains.includes(_this.library.filter_domain);
                }
                return true;
            });
            return list;
        }
    },

    methods: {

        refreshLibrary(){
            let _this = this;

            this.library.loading = false;
            this.library.data = null;
            this.library.count = null;
            this.library.show = null;

            // Cancel previous API request if still running
            if (this.api_library_cancel_token !== null) {
                this.api_library_cancel_token();
            }

            if(this.theme!==null && (
                this.level==='regional'
                || (this.level==='national' && this.site!==null)
                || (this.level==='concessions' && this.site!==null)
                || (this.level==='protected_areas' && this.site!==null)
            )) {

                this.library.loading = true;

                window.axios({
                    method: 'post',
                    url: window.Laravel.baseUrl + 'api/analysis/library',
                    data: {
                        _token: _this.csrf,
                        level: _this.level,
                        site: _this.site || null,
                        domain: _this.theme || null,
                    },
                    cancelToken: new window.axios.CancelToken(function executor(c) {
                        _this.api_library_cancel_token = c;
                    }),
                })
                    .then(function (response) {
                        console.log('Request to library API executed');
                        if (!_.isEmpty(response.data)) {
                            _this.library.data = typeof response.data === "string" ? JSON.parse(response.data) : response.data;
                            _this.library.count = _this.library.data.length;

                        } else {
                            _this.library.count = 0;
                        }
                    })
                    .catch(function (error) {
                        if (window.axios.isCancel(error)) {
                            console.log('Request to library API canceled. No more necessary');
                        } else {
                            console.log(error);
                        }
                    })
                    .finally(function () {
                        _this.library.loading = false;
                        _this.api_library_cancel_token = null;
                    });
            }
        }

    }
}