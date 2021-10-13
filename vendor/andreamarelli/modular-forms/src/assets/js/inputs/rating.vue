<template>
    <div>

        <span ref="ratingOptions" class="rating-container">
            <span class="rating field-edit"
                  v-for="(item, index) in list"
                  v-on:click="updateRating(item['value'])"
                  v-on:mouseover=setHover
                  v-on:mouseout=setHover
                  v-bind:class="[item['value']==='-99' ? 'ratingNa' : 'ratingNum', setActive(item['value'])]"
                  v-bind:rate="item['value']"
                  data-toggle="tooltip" data-placement="top" :title=tooltipLabel(index)
                >{{ item['label'] }}</span>
        </span>

        <input type="hidden"
            v-bind:id="id"
            v-bind:value="value"
        />

    </div>
</template>

<script>

    export default {

        mixins: [
            window.ModularForms.MixinsVue.values
        ],

        props: {
            ratingType: String,
            legend: {
                type: Array,
                default: () => null
            },
        },

        computed: {
            list(){
                return this.buildOptionList();
            }
        },

        methods: {

            buildOptionList: function (){
                let list = [];
                let ratingType = this.ratingType;
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
            },

            updateRating: function (value){
                if(this.value!==null && (value.toString() === this.value.toString())){
                    value = null;
                }
                this.emitValue(value);
            },

            setActive: function(value){
                let applyClass = this.__applyClass(value, this.value);
                return (applyClass) ? 'active' : '';
            },

            setHover: function (evt) {
                let _this = this;
                let hoverValue = evt.target.getAttribute('rate')
                let ratingOptions = this.$refs.ratingOptions.childNodes
                for(let item of ratingOptions.values()) {
                    let value = item.getAttribute('rate');
                    let applyClass = _this.__applyClass(value, hoverValue);
                    if (applyClass && evt.type === 'mouseover') {
                        item.classList.add('hover');
                    } else {
                        item.classList.remove('hover');
                    }
                }
            },

            __applyClass: function(localValue, globalValue){
                if(localValue!=='-99' && parseFloat(localValue) <= parseFloat(globalValue)){
                    return true
                } else if(localValue==='-99' && globalValue==='-99'){
                    return true
                }
                return false;
            },

            tooltipLabel(index){
                if(this.legend!=null){
                    if(this.legend.hasOwnProperty(index)){
                        return _.upperFirst(this.legend[index]);
                    }
                }
                return ''
            }
        }
    }
</script>
