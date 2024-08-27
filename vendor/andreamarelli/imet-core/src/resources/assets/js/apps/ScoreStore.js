import { defineStore } from "~/pinia";

export const useScoreStore = defineStore('score', {

    state: () => ({
        api: {}
    }),

    getters: {
        api_data: (state) => state.api,
    },

    actions: {

        init(api){
            this.api = api;
        },

        refresh(){
            let _this = this;

            // prepare the url
            let url = this.api.version === 'oecm'
                ? window.Routes.scores_oecm
                : window.Routes.scores;
            url = url.replace('__id__', this.api.form_id)

            // fetch the data
            fetch(url, {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": window.Laravel.csrfToken,
                }
            })
                .then((response) => response.json())
                .then(function(data){
                    _this.api = data;
                });

        }
    },
})