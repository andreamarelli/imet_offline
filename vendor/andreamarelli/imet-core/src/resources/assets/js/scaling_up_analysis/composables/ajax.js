import {ref} from "vue";

export function useAjax(component_data) {

    let event_parameters = {};
    let scaling_up = null;
    let func_parameter = {};
    let url_parameter = {};
    let data = ref({});
    let loaded_once = ref(false);
    let error_returned = ref(false);
    let timeout = ref(false);
    let error_wrong = false;
    let is_loaded = true;
    const url = component_data.url || '';
    const parameters = component_data.parameters || '';
    const func = component_data.func || null;
    const method = component_data.method || 'Post';
    const lazy_load_parameters = component_data.lazy_load_parameters || false;
    let loaded_at_once = component_data.loaded_at_once || true;
    const stores = component_data.stores || null;
    const success_func = component_data.success || null;
    const error_func = component_data.error || null;

    async function init() {
        if (loaded_once.value === false) {
            initialize_values();
            await load_procedure();
        }
    }

    function initialize_values() {
        event_parameters = !Array.isArray(parameters) ? parameters.split(',').filter(item => item.trim() !== '') : parameters
        func_parameter = func;
        url_parameter = url;
    }

    async function on_event_load(parameters = {}) {
        event_parameters = parameters.parameters ?? parameters;
        func_parameter = parameters.func ?? func;
        url_parameter = parameters.url ?? url;
        await retrieve_data();
    }

    async function load_procedure() {
        if (!func_parameter) {
            return null;
        }
        if (lazy_load_parameters) {
            // emitter('incoming-data', async (parameters) => {
            //     event_parameters = parameters.parameters ?? parameters;
            //     func_parameter = parameters.func ?? func;
            //     url_parameter = parameters.url ?? url;
            //     await retrieve_data();
            // });
        } else {
            await retrieve_data();
        }
    }

    function parameters_man() {
        return event_parameters;
    }

    function conclude(response) {
        is_loaded = false;
        loaded_once.value = true;
    }

    async function retrieve_data() {
        is_loaded = true;
        error_wrong = false;
        const fetchOptions = {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": window.Laravel.csrfToken,
            }
        };

        if (method !== 'GET') {
            fetchOptions.body = JSON.stringify({
                func: func_parameter,
                parameter: parameters_man(),
                scaling_id: stores.BaseStore.get_scaling_up()
            });
        } else {
            url_parameter = url_parameter + '?func=' + func_parameter + '&parameter=' + parameters + '&scaling_id=' + stores.BaseStore.get_scaling_up();
        }

        fetch(url_parameter, fetchOptions)
            .then((response) => response.json())
            .then(function (response) {
                data.value = response;
                conclude();
                success_func(response ,false);
            })
            .catch(function (response) {
                error_func(response);
                conclude();
            });

        return data;
    }

    return {
        loaded_once,
        init,
        is_loaded,
        data,
        error_returned,
        timeout,
        error_wrong,
        on_event_load,
        initialize_values
    }
}
