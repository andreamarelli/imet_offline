import {nextTick, readonly, toRaw, unref, ref} from "vue";

export function useSave(component_data) {

    // variables from component
    let records = component_data.records;
    let records_backup = component_data.records_backup;
    const status = component_data.status;
    const form_id = component_data.form_id;
    const module_key = component_data.module_key;
    const action_url = component_data.action_url;
    let error_messages = ref([]);
    const refreshDataStatus = component_data.refreshDataStatus;
    const ensureAteLeastOneRecordPerGroup = component_data.ensureAteLeastOneRecordPerGroup;

    /**
     * Replace records iteratively with given records
     */
    function replaceRecords(newRecords) {
        // remove everything from records
        records.forEach(function (record, index) {
            delete records[index];
        });
        // add back new records
        newRecords.forEach(function (record, index) {
            records[index] = JSON.parse(JSON.stringify(newRecords[index]));
        });
    }

    /**
     * Replace records_backup with given records
     */
    function replaceRecordsBackup(newRecords) {
        // remove everything from records
        records_backup.forEach(function (record, index) {
            delete records_backup[index];
        });
        // add back new records
        newRecords.forEach(function (record, index) {
            records_backup[index] = JSON.parse(JSON.stringify(newRecords[index]));
        });
    }


    function resetModule(){
        replaceRecords(component_data.records_backup);
        refreshDataStatus();
        ensureAteLeastOneRecordPerGroup();
        nextTick().then(() => {
            status.value = 'idle';
            component_data.emitter.emit('moduleReset', { module_key: module_key });
        });
    }

    function saveModule(){

        status.value = 'saving';

        let data = {
            records_json: window.ModularForms.Helpers.Payload.encode(Object.values(records)),
            form_id: form_id,
            module_key: module_key,
        };
        if(form_id !== null){
            data._method = 'PATCH';
        }

        fetch(action_url, {
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

                    // On create redirect to edit view
                    if(form_id == null){
                        window.location.href = data.edit_url;
                    } else {
                        replaceRecords(data.records);
                        replaceRecordsBackup(data.records);
                        refreshDataStatus();
                        ensureAteLeastOneRecordPerGroup();
                        component_data.last_update = component_data.last_update || {'date': null};
                        component_data.last_update.date = data.last_update.date;
                        if(window.Laravel.FormErrors){
                            window.Laravel.FormErrors.refreshErrors(data.form_errors);
                        }
                        nextTick().then(() => {
                            status.value = 'saved';
                            component_data.emitter.emit('moduleSaved', data);
                        });
                    }
                } else if(data.status === 'validation_error') {
                    setErrorStatus(data);
                }

            })
            .catch(function (error) {
                setErrorStatus(error);
                component_data.emitter.emit('moduleFail', { module_key: module_key, error: error });
            });
    }

    function setErrorStatus(data){
        status.value = 'error';
        // remove all error messages
        error_messages.value = [];
        // add errors from response
        if(data.hasOwnProperty('errors')){
            Object.keys(data['errors']).forEach(function (field) {
                data['errors'][field].forEach(function (message) {
                    error_messages.value.push(message);
                });
            });
        }
    }

    return{
        resetModule,
        saveModule,
        error_messages
    }
}
