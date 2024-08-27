<template>
    <div>

        <span ref="ratingOptions" class="rating-container">
            <span v-for="(item, index) in list">

                <span class="rating field-edit"
                      v-on:click="updateRating(item['value'])"
                      v-on:mouseover=setHover
                      v-on:mouseout=setHover
                      v-bind:class="[item['value']==='-99' ? 'ratingNa' : 'ratingNum', setActive(item['value'])]"
                      v-bind:rate="item['value']"
                >{{ item['label'] }}</span>

                <tooltip>
                    {{ tooltipLabel(index) }}
                </tooltip>
            </span>

        </span>

        <input type="hidden"
           :id=id
           v-model="inputValue"
        />

    </div>
</template>

<script setup>

import {computed, ref} from "vue";

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        ratingType: String,
        legend: {
            type: Array,
            default: () => null
        },
    });

    const ratingOptions = ref(null);

    const list = computed(() => {
        return buildOptionList();
    });

    const inputValue = defineModel();

    function buildOptionList(){
        let list = [];
        let ratingType = props.ratingType;
        if(ratingType.includes("WithNA")){
            list.push({'value': '-99', 'label': 'N/A'});
            ratingType = ratingType.replace("WithNA", "")
        }
        ratingType = ratingType.replace("Minus", "-");
        let [min, max] = ratingType.split("to");
        for(let i = min; i <= max; i++){
            list.push({'value': i, 'label': i});
        }
        return list
    }

    function setActive(value){
        let applyClass = __applyClass(value, inputValue.value);
        return (applyClass) ? 'active' : '';
    }

    function __applyClass(localValue, globalValue){
        if(localValue!=='-99' && parseFloat(localValue) <= parseFloat(globalValue)){
            return true
        } else if(localValue==='-99' && globalValue==='-99'){
            return true
        }
        return false;
    }

    function setHover(evt) {
        let hoverValue = evt.target.getAttribute('rate')
        let ratingItems = ratingOptions.value.querySelectorAll('.rating');
        for (let item of ratingItems.values()) {
            let value = item.getAttribute('rate');
            let applyClass = __applyClass(value, hoverValue);
            if (applyClass && evt.type === 'mouseover') {
                item.classList.add('hover');
            } else {
                item.classList.remove('hover');
            }
        }
    }

    function updateRating(value){
        if(inputValue.value!==null && (value.toString() === inputValue.value.toString())){
            value = null;
        }
        inputValue.value = value;
        let ratingItems = ratingOptions.value.querySelectorAll('.rating');
        for(let item of ratingItems.values()) {
            item.classList.remove('hover');
        }
    }

    function tooltipLabel(index){
        if(props.legend!=null){
            if(props.legend.hasOwnProperty(index)){
                return props.legend[index].charAt(0).toUpperCase() + props.legend[index].slice(1);
            }
        }
        return '';
    }


</script>
