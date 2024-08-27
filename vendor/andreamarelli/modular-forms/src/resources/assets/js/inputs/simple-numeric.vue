<template>

    <input type="text"
           :id=id
           :name=id
           v-model="formattedValue"
           class="field-edit"
           :class="{ 'field-numeric':  numericType!=='code' }"
           autocomplete="off"
           ref="inputElem"
           v-on:autoNumeric:rawValueModified="update"
    />

</template>

<style scoped>
    .field-edit{
        max-width: 180px;
    }
    .field-numeric{
        text-align: right;
    }
</style>

<script setup>

    import {onMounted, ref, computed, onBeforeMount, watch} from "vue";
    import AutoNumeric from "~/autonumeric";

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        numericType: {
            type: String,
            default: 'float'
        },
    });

    const inputValue = defineModel();
    const formattedValue = defineModel('formattedValue');
    const inputElem = ref(null);
    const autoNumericObject = ref(null);
    const autoNumericOptions = computed(() => {

        let options = {
            maximumValue: '100000000000000000',
            emptyInputBehavior: 'null',
        };

        if(props.numericType==='integer'){
            options.minimumValue = '0';
            options.decimalPlaces = 0;
            options.decimalCharacter = ',';
            options.digitGroupSeparator = ' ';
        }
        else if(props.numericType==='code'){
            options.minimumValue = '0';
            options.decimalPlaces = 0;
            options.digitGroupSeparator = '';
        }
        else if(props.numericType==='float' || props.numericType==='numeric'){
            options.decimalCharacter = ',';
            options.digitGroupSeparator = ' ';
        }
        else if(props.numericType==='currency'){
            options.decimalCharacter = ',';
            options.digitGroupSeparator = ' ';
        }

        return options;
    });

    onBeforeMount(() => {
        format(inputValue.value);
    });

    onMounted(() => {
        autoNumericObject.value = new AutoNumeric(inputElem.value, autoNumericOptions.value);
    });

    watch(formattedValue, async (newValue, oldValue) => {
        if(typeof oldValue !== 'undefined'
            && newValue !== oldValue){
            inputValue.value = JSON.parse(JSON.stringify(
                autoNumericObject.value.getNumber()
            ));
        }
    });

    watch(inputValue, async (newValue, oldValue) => {
        newValue = isNaN(newValue) ? null : newValue;
        autoNumericObject.value.set(newValue);
        format(newValue);
    });

    function format(value){
        formattedValue.value = value!==null
            ? JSON.parse(JSON.stringify(value))
            : null;
    }


</script>
