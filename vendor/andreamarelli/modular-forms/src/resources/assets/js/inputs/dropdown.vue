<template>

    <span>

        <v-select
            :taggable=taggable
            :push-tags=taggable
            :multiple=multiple
            ref="selectElem"
            v-model=selectedValue
            @update:modelValue="onUpdateSelected"
            :options=optionList
        ></v-select>

        <input type="hidden"
               :id=id
               v-model="inputValue"
        />

    </span>


</template>

<script>
    import vSelect from "~/vue-select";

    export default {
        components: {
            'v-select': vSelect
        }
    }
</script>

<script setup>

    import {onBeforeMount, onMounted, ref, watch, computed} from "vue";
    import { useList } from "./composables/list.js";

    const { sortList } = useList({});

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        dataValues: {
            type: String,
            default: '{}',
        },
        taggable: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        }
    });

    const inputValue = defineModel();
    let selectedValue = defineModel('selectedValue', );
    const selectElem = ref(null);
    const optionList = computed(() => {
        return buildOptionList();
    });

    watch(inputValue, (value) => {
        onUpdateInput();
    });

    onBeforeMount(() => {
        selectedValue.value = refreshSelectValue();
    });

    onMounted(() => {
        selectElem.value.onSearchBlurOriginal = selectElem.value.onSearchBlur;
        selectElem.value.onSearchBlur = () => {
            // if taggable, ensure that typed value is selected
            if(props.taggable && selectElem.value.search !== ''){
                let searchValue = {
                    label:  selectElem.value.search,
                    code:  selectElem.value.search
                };
                selectElem.value.select(searchValue);
            }
            // else, apply the standard behaviour
            selectElem.value.onSearchBlurOriginal();
        };
    });

    /**
     * Build the options list
     */
    function buildOptionList() {
        let option_list = JSON.parse(props.dataValues);
        let list = [];
        for(let key in option_list) {
            if((key !== '' && key !== 'null')
                && option_list.hasOwnProperty(key)) {
                list.push(getPair(key));
            }
        }
        // ensure initial selected value is in option list (if added by user)
        if(inputValue!==null && !(inputValue.value in option_list) && !props.multiple){
            list.push(getPair(inputValue.value));
        }
        list = sortList(list);
        return list;
    }

    function refreshSelectValue(){
        let value = inputValue.value;
        if(value!==null){
            if(props.multiple){
                try {
                    value = JSON.parse(value);
                } catch (e) {
                    value = value.split(',');
                }
                return value.map(function(item){
                    return getPair(item);
                });
            }
            else {
                return getPair(value);
            }
        }
        return null;
    }

    function getPair(item){
        let option_list = JSON.parse(props.dataValues);
        return  {
            label: option_list[item] ?? item,
            code: item
        };
    }

    function onUpdateSelected(){
        if(props.multiple){
            inputValue.value = JSON.stringify(selectedValue.value.map(function(item){
                return item.code;
            }));
        }
        else {
            inputValue.value = selectedValue.value!==null
                ? selectedValue.value.code
                : null;
        }
    }

    function onUpdateInput(){
        selectedValue.value = refreshSelectValue();
    }

</script>
