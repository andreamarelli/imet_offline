import Base from "@modular-forms/js/apps/Base.js";

import {reactive, ref, watch, toRaw, onMounted, nextTick} from "vue";

import simpleText from "@modular-forms/js/inputs/simple-text.vue";
import simplePassword from "@modular-forms/js/inputs/simple-password.vue";

export default class SettingsApp extends Base {

    constructor(input_data) {

        const options = {
            name: 'SettingsApp',

            props: {
                records: Object,
                module_key: String,
                save_url: String,
            },

            setup(props, context){

                let records = reactive(props.records);
                let records_backup = JSON.parse(JSON.stringify(toRaw(records)));
                let status = ref('init'); // "init" state avoid watch() on records during initialization
                let warning_on_save = null;
                let action_url = '/settings';

                const Payload = window.ModularForms.Helpers.Payload;

                watch(records, (value) => {
                    if (status.value !== 'init' && status.value !== 'changed'){
                        status.value = 'changed';
                    }
                });

                onMounted(() => {
                    status.value = 'idle';
                });

                function resetModule(){
                   replaceRecords(records_backup);
                    nextTick().then(() => {
                        status.value = 'idle';
                    });
                }
                function saveModule(){
                    status.value = 'saving';

                    let data = {
                        records_json: Payload.encode(records),
                        module_key: props.module_key,
                        _method: 'PATCH'
                    }

                    fetch(props.save_url, {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-Token": window.Laravel.csrfToken,
                        },
                        body: JSON.stringify(data),
                    })
                        .then((response) => response.json())
                        .then(function(data){
                            if (data.status === 'success') {
                                replaceRecords(data.records);
                                replaceRecordsBackup(data.records);
                                nextTick().then(() => {
                                    status.value = 'saved';
                                });
                            } else if(data.status === 'validation_error') {
                                status.value = 'error';
                            }
                        })
                        .catch(function (error) {
                            status.value = 'error';
                        });

                }

                function replaceRecords(newRecords){
                    Object.entries(newRecords).forEach(([key, value]) => {
                        records[key] = JSON.parse(JSON.stringify(value));
                    });
                }
                function replaceRecordsBackup(newRecords){
                    Object.entries(newRecords).forEach(([key, value]) => {
                        records_backup[key] = JSON.parse(JSON.stringify(value));
                    });
                }

                return {
                    records,
                    status,
                    warning_on_save,
                    resetModule,
                    saveModule
                }

            }
        }

        return super(options, input_data)
            .component('simpleText', simpleText)
            .component('simplePassword', simplePassword);
    }

}
