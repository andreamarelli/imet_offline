import {watch, ref, unref} from "vue";

export function useLoadFromPrevious(component_data) {

    const records = unref(component_data.records);
    const previous_url = component_data.previous_url;

    const show_language = ref(true);
    const available_years = ref(null);
    const prev_year_selection = ref(null);
    const retrieving_years = ref(false);
    const current_year = ref(records[0]['Year']);
    const current_pa = ref(records[0]['wdpa_id']);

    watch(prev_year_selection, (value) => {
        show_language.value = value === null || value === 'no_import';
        records[0]['prev_year_selection'] = value;
    });

    function validateRecord(){

        let status;

        // empty prev_year_selection if wdpa or year changes
        if(current_year.value !== records[0]['Year'] &&
            current_pa.value !== records[0]['wdpa_id']){
            prev_year_selection.value = null;
            available_years.value = null;
        }

        // retrieve prev_year_selection
        if (![null, ""].includes(records[0]['wdpa_id']) &&
            ![null, ""].includes(records[0]['Year']) &&
            (current_pa.value !== records[0]['wdpa_id'] ||
                current_year.value !== records[0]['Year'])
        ){
            try{
                retrievePreviousYears();
            } catch (e){
                retrieving_years.value = false;
                available_years.value = null;
            }
        }

        // show SAVE bar only when all fields have been selected
        if (![null, ""].includes(records[0]['Year']) &&
            ![null, ""].includes(records[0]['wdpa_id']) &&
            (
                (prev_year_selection.value === 'no_import' && records[0]['language'] !== null) ||
                (prev_year_selection.value !== 'no_import' && prev_year_selection.value !== null) ||
                (available_years.value === null && records[0]['language'] !== null)
            )
        ) {
            status = 'idle';
        } else {
            status = 'init';
        }
        status = (status !== 'init' && status !== 'changed') ? 'changed' : status;

        // store selections
        current_pa.value = records[0]['wdpa_id'];
        current_year.value = records[0]['Year'];

        return status;

    }

    function retrievePreviousYears() {
        available_years.value = null;
        retrieving_years.value = true;

        fetch(previous_url, {
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": window.Laravel.csrfToken,
            },
            body: JSON.stringify({
                year: records[0]['Year'],
                wdpa_id: records[0]['wdpa_id']
            })
        })
            .then((response) => response.json())
            .then(function(data) {
                retrieving_years.value = false;
                if(Object.values(data).length > 0) {
                    parseAvailableYears(data);
                } else {
                    available_years.value = null;
                }
            })
    }

    function parseAvailableYears(data) {
        available_years.value = data;
        available_years.value['no_import'] = 'No';
        let years = Object.values(available_years.value);
        let duplicates = foundDuplicates(years);
        Object.keys(available_years.value).forEach(function (key) {
            if (duplicates.includes(available_years.value[key])) {
                available_years.value[key] = available_years.value[key] + ' (IMET #' + key + ')';
            }
        });
    }

    function foundDuplicates(list) {
        let sorted_arr = list.slice().sort();
        let results = [];
        for (let i = 0; i < sorted_arr.length - 1; i++) {
            if (sorted_arr[i + 1] === sorted_arr[i]) {
                results.push(sorted_arr[i]);
            }
        }
        return results;
    }

    return {
        show_language,
        retrieving_years,
        available_years,
        validateRecord,
        prev_year_selection
    };

}