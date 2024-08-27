 import {computed, readonly, ref, toRaw, unref} from "vue";

export function useDataStatus(component_data) {

    const NOT_APPLICABLE_KEY = 'not_applicable';
    const NOT_AVAILABLE_KEY = 'not_available';

    const not_applicable = ref(false);
    const not_available =  ref(false);

    // variables from component
    const enable_not_applicable = unref(component_data.enable_not_applicable);
    const records = unref(component_data.records);
    const empty_record = unref(component_data.empty_record);

    const isNotApplicable= computed(() => {
        return not_applicable.value;
    });
    const isNotAvailable= computed(() => {
        return not_available.value;
    });

    function refreshDataStatus(){
        if(enable_not_applicable){

            let record = records[0];
            record = Object.assign({}, record);

            if(NOT_APPLICABLE_KEY in record){
                not_applicable.value = record[NOT_APPLICABLE_KEY]===true;
                not_available.value = record[NOT_AVAILABLE_KEY]===true;
            }
        }
    }

    function toggleDataStatus(toggle_key){
        if(toggle_key === NOT_APPLICABLE_KEY){
            not_applicable.value = !not_applicable.value;
            return updateRecords(NOT_APPLICABLE_KEY, not_applicable.value);
        } else if(toggle_key === NOT_AVAILABLE_KEY){
            not_available.value = !not_available.value;
            return updateRecords(NOT_AVAILABLE_KEY, not_available.value);
        }
    }

    function updateRecords(toggle_key, toggle_value){
        records.forEach(function (item, index) {
            if(index === 0){
                records[index] = Object.assign({}, empty_record);
                records[index][toggle_key] = toggle_value === true ? true : null;
            } else {
                delete records[index];
            }
        });
    }


    return {refreshDataStatus, isNotApplicable, isNotAvailable, toggleDataStatus}
 }
