export default {
    inject: ['stores'],
    props: {
        url: {
            type: String,
            default: ''
        },
        parameters: {
            type: String,
            default: ''
        },
        func: {
            type: String,
            default: () => null
        },
        method: {
            type: String,
            default: 'Post'
        },
        lazy_load_parameters: {
            type: Boolean,
            default: false
        },
        loaded_at_once: {
            type: Boolean,
            default: true
        }
    },
    watch: {
        loaded_at_once: {
            deep: true,
            handler() {

                this.init();
            }
        }
    },
    data: function () {
        return {
            event_parameters: {},
            scaling_up: null,
            func_parameter: {},
            url_parameter: {},
            show_loader: false,
            loaded_once: false,
            error_returned: false,
            timeout: false,
            error_wrong: false
        }
    },
    async mounted() {
        if (this.loaded_at_once === true) {
            await this.init();
        }
    },
    computed: {},
    methods: {
        init: async function () {
            if (this.loaded_once === false) {
                this.initialize_values();
                await this.load_procedure();
            }
        },
        initialize_values: function () {
            this.event_parameters = !Array.isArray(this.parameters) ? this.parameters.split(',') : this.parameters
            this.func_parameter = this.func;
            this.url_parameter = this.url;
        },
        load_procedure: async function () {
            if(!this.func_parameter){
                return null;
            }
            if (this.lazy_load_parameters) {
                this.$root.$on('incoming-data', async (parameters) => {
                    this.event_parameters = parameters.parameters ?? this.parameters;
                    this.func_parameter = parameters.func ?? this.func;
                    this.url_parameter = parameters.url ?? this.url;
                    await this.retrieve_data();
                });
            } else {
                await this.retrieve_data();
            }
        },
        parameters_man: function () {
            return this.event_parameters;

        },
        error: function (response) {
            console.log(response);
            if (!response.response)
                this.error_wrong = true;
            else if (response.status === false){
                this.timeout = true;
            }
            else if (response.code === 'ECONNABORTED')
                this.timeout = true;
            else if (response.response.status === 500)
                this.error_wrong = true;
        },
        finally: function (response) {
            this.show_loader = false;
            this.loaded_once = true;
        },
        success: function (response) {
            throw new Error('Not Implemented ')
        },
        retrieve_data: async function () {
            let _this = this;
            this.show_loader = true;
            this.error_wrong = false;

           fetch(this.url_parameter, {
               method: this.method,
               headers: {
                   "Content-Type": "application/json",
                   "X-CSRF-Token": window.Laravel.csrfToken,
               },
               body: JSON.stringify({
                   func: this.func_parameter,
                   parameter: this.parameters_man(),
                   scaling_id: this.stores.BaseStore.get_scaling_up()
               })
           })
               .then((response) => response.json())
               .then(function(data) {
                   _this.success(data);
                   _this.finally();
               })
               .catch(function(error) {
                   _this.error(error);
                   _this.finally();
            });

        }
    }
}
