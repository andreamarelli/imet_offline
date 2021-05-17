export default {

    data() {
        return {
            api_projects_cancel_token: null,
            projects: {
                data: null,
                count: null,
                show: false,
                loading: false,
                show_filters: false,
                filter_domain: null,
                filter_status: null
            }
        }
    },


    computed:{
        filtered_projects: function () {
            let _this = this;
            let list = this.projects.data;
            // sort
            list = _.orderBy(list, 'Acronym', 'asc')
            // filter
            list = list.filter(function (item) {
                if(_this.projects.filter_domain!==null && _this.projects.filter_domain!==''){
                    return item.domains.includes(_this.projects.filter_domain);
                }
                if(_this.projects.filter_status!==null && _this.projects.filter_status!==''){
                    return item.status.includes(_this.projects.filter_status);
                }
                return true;
            });
            return list;
        }
    },

    methods: {

        refreshProjects(){
            let _this = this;

            this.projects.loading = null;
            this.projects.data = null;
            this.projects.count = null;
            this.projects.show = null;

            // Cancel previous API request if still running
            if (this.api_projects_cancel_token !== null) {
                this.api_projects_cancel_token();
            }

            if(this.theme!==null && (
                this.level==='regional'
                || (this.level==='national' && this.site!==null)
                || (this.level==='concessions' && this.site!==null)
                || (this.level==='protected_areas' && this.site!==null)
            )) {

                this.projects.loading = true;

                window.axios({
                    method: 'post',
                    url: window.Laravel.baseUrl + 'api/analysis/projects',
                    data: {
                        _token: _this.csrf,
                        level: _this.level,
                        site: _this.site || null,
                        domain: _this.theme || null,
                    },
                    cancelToken: new window.axios.CancelToken(function executor(c) {
                        _this.api_projects_cancel_token = c;
                    }),
                })
                    .then(function (response) {
                        console.log('Request to projects API executed');
                        if (!_.isEmpty(response.data)) {
                            _this.projects.data = typeof response.data === "string" ? JSON.parse(response.data) : response.data;
                            _this.projects.count = _this.projects.data.length;
                        } else {
                            _this.projects.count = 0;
                        }

                    })
                    .catch(function (error) {
                        if (window.axios.isCancel(error)) {
                            console.log('Request to projects API canceled. No more necessary');
                        } else {
                            console.log(error);
                        }
                    })
                    .finally(function () {
                        _this.projects.loading = false;
                        _this.api_projects_cancel_token = null;
                    });

            }

        },

    }
}