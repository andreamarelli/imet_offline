<template>

    <span class="checkbox" v-if="boolean || booleanNumeric">
        <input type="checkbox"
               :name=id
               :id="'bool-check_' + id"
               :checked=isChecked
               v-on:change="checkChange()"
        /><label :for="'bool-check_' + id"></label>
    </span>

    <span class="checkbox list" :class="inline ? 'inline' : ''" v-else>
        <span v-for="option in list">
           <input type="checkbox"
                  :name=id
                  :id="'check_' + option.value + '_' + id"
                  :checked="isOptionChecked(option.value)"
                  v-on:change="checkChange(option.value)"
           /><label :for="'check_' + option.value + '_' + id">{{ option.label }}</label>
        </span>

    </span>

</template>

<script setup>

    import {computed, onBeforeMount, ref} from "vue";
    import {useList} from "./composables/list.js";

    const {sortList} = useList({});

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        dataValues: {
            type: String,
            default: '{}',
        },
        boolean: {
            type: Boolean,
            default: false
        },
        booleanNumeric: {
            type: Boolean,
            default: false
        },
        inline: {
            type: Boolean,
            default: true
        }
    });

    const inputValue = defineModel();
    let list = ref([]);

    onBeforeMount(() => {
        initializeOptions();
    });

    const isChecked = computed(() => {
        return checkValue(inputValue.value);
    });

    function initializeOptions() {
        if(!props.boolean && !props.booleanNumeric) {
            let option_list = JSON.parse(props.dataValues);
            for(let key in option_list) {
                if(key !== '_'&& key !== 'null' && option_list.hasOwnProperty(key)) {
                    list.value.push({
                        'label': option_list[key],
                        'value': key
                    });
                }
            }
        }
    }

    function checkChange(optionValue){
        if(props.boolean){
            inputValue.value = !inputValue.value;
        } else if(props.booleanNumeric){
            inputValue.value = inputValue.value===1 ? 0 : 1;
        } else {
            let selected_list = window.ModularForms.Helpers.Common.isValidJSON(inputValue.value)
                ? JSON.parse(inputValue.value)
                : [];
            if(selected_list.includes(optionValue)){
                selected_list = selected_list.filter(item => item !== optionValue);
            } else {
                selected_list.push(optionValue);
            }
            inputValue.value = JSON.stringify(selected_list);
        }
    }

    function checkValue(value){
        if(props.boolean){
            return value===true;
        } else if(props.booleanNumeric){
            return value===1;
        }
    }

    function isOptionChecked (value){
        return window.ModularForms.Helpers.Common.isValidJSON(inputValue.value)
            ? JSON.parse(inputValue.value).includes(value)
            : false;
    }

</script>
