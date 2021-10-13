<template>

    <simple-text
        class="simple-date"
        v-model=inputValue
        :id=id
        :name=id
        disable-auto-complete=true
    ></simple-text>

</template>

<style lang="scss" scoped>

    .simple-date input{
        width: 100px;
        max-width: 100px;
        text-align: center;
        cursor: pointer;
    }

</style>

<script>


    import simple_text from './simple-text.vue';

    export default {

        components: {
            simple_text
        },

        mixins: [
            window.ModularForms.MixinsVue.values
        ],


        props: {
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
        },

        data(){
            return {
                Locale: window.Locale,
                inputValue: this.value,
            }
        },

        watch: {
            inputValue(value){
                this.emitValue(value);
            }
        },

        mounted(){

            let _this = this;
            let $elem = $(this.$el).find('input');
            let textComponent = this.$children[0];

            let options = {
                language: window.Locale.getLocale(),
                clearBtn: true,
                autoclose: true,
            };

            if(_this.dateType==='day'){
                options.format = "yyyy-mm-dd";
                options.todayHighlight = true;
                options.startDate = _this.startDate!==null ? _this.startDate : -Infinity;
                options.endDate = _this.endDate!==null ? _this.endDate : Infinity;

            } else if(_this.dateType==='year'){
                options.format = "yyyy";
                options.startView = "years";
                options.minViewMode = "years";
                options.maxViewMode = "years";
                options.startDate = _this.startDate!==null ? _this.startDate.substring(0,4) : -Infinity;
                options.endDate = _this.endDate!==null ? _this.endDate.substring(0,4) : Infinity;
            }
            $($elem).datepicker(options)
                .on('changeDate', function(){
                    textComponent.inputValue = $(this).val();
                })
                .on('keydown', function(evt){
                    evt.preventDefault();
                });

        },

        methods: {

        }

    }
</script>
