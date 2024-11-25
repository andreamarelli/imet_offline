<template>

    <input type="text"
           :id=id
           :name=id
           v-model=inputValue
           class="field-edit field-date"
           readonly
    />

</template>

<style scoped>

    .field-date{
        width: 120px;
        max-width: 120px;
        text-align: center;
        cursor: pointer;
    }

</style>

<script setup>

    import {onMounted} from "vue";

    import AirDatepicker from "~/air-datepicker";
    import AirDatepicker_locale_en from "~/air-datepicker/locale/en";
    import AirDatepicker_locale_fr from "~/air-datepicker/locale/fr";
    import AirDatepicker_locale_sp from "~/air-datepicker/locale/es";
    import AirDatepicker_locale_pt from "~/air-datepicker/locale/pt";

    const AirDatepicker_locale = {
        'en': AirDatepicker_locale_en,
        'fr': AirDatepicker_locale_fr,
        'sp': AirDatepicker_locale_sp,
        'pt': AirDatepicker_locale_pt
    };

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        dateType: {
            type: String,
            default: 'day'
        },
        startDate: {
            type: String,
            default: null
        },
        endDate: {
            type: String,
            default: null
        }
    });

    const inputValue = defineModel();

    onMounted(() => {

        let options = {
            locale: AirDatepicker_locale[window.ModularForms.Helpers.Locale.getLocale()],
            autoClose: true,
            toggleSelected: false,
            onSelect({date, formattedDate, datepicker}){
                inputValue.value = formattedDate
            },
            buttons: ['clear']
        };

        if(props.startDate!==null){
            options.minDate = props.startDate;
        }
        if(props.endDate!==null){
            options.maxDate = props.endDate;
        }

        if(props.dateType === 'day'){
            options.dateFormat = "yyyy-MM-dd";
            if(typeof inputValue.value !== 'undefined' && inputValue.value !== null){
                options.selectedDates = [inputValue.value];
            }
        } else if(props.dateType === 'year'){
            options.dateFormat = "yyyy";
            options.view = "years";
            options.minView = "years";
            if(typeof inputValue.value !== 'undefined' && inputValue.value !== null) {
                options.selectedDates = [inputValue.value + '-01-01'];
            }
        }

        new AirDatepicker('#' + props.id, options);
    })

</script>
