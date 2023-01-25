export default {
    props: {
        url: {
            type: String,
            default: ''
        },
        parameters: {
            type: String,
            default: ''
        },
        method: {
            type: String,
            default: 'Post'
        }
    },
    data: function () {
        return {
            show_loader: false,
            loaded_once: false,
            error_returned: false,
            timeout: false,
            error_wrong: false
        }
    },
    async mounted() {
        await this.init();
    },
    methods: {
        init: async function () {
            if (this.loaded_once === false) {
                await this.load_procedure();
            }
        },
        load_procedure: async function () {
            await this.retrieve_data();
        },
        error: function (response) {
            if (!response.response)
                this.error_wrong = true;
            else if (response.status === false) {
                this.timeout = true;
            } else if (response.code === 'ECONNABORTED')
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
            try {
                const data = {
                    _token: window.Laravel.csrfToken
                }
                let url = this.url;
                if (this.method === 'GET') {
                    url = `${url}?${this.parameters}`;
                } else {

                    data['parameters'] = this.parameters;
                }

                this.show_loader = true;
                const response = await window.axios({
                    method: this.method,
                    url: url,
                    data,
                    timeout: 3 * 10000,
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                });
                this.success(response.data);
            } catch (error) {

                this.error(error);
            } finally {
                this.finally();
            }


        }
    }
}
